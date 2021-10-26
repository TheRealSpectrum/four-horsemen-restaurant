<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Management\ManagementColumn;
use App\Management\Builder as ManagementBuilder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

const PAGINATION_PER_PAGE = 12;

abstract class ManagementController extends Controller
{
    public function index(Request $request): View
    {
        $this->managementInitWrapper();

        $columns = $this->editInline
            ? $this->builder->inlineColumns
            : $this->builder->columns;

        $possibleOrderColumns = new Collection();

        foreach ($columns as $column) {
            if ($column->shouldSort) {
                $possibleOrderColumns->push($column->column);
            }
        }

        $orderByColumn = $request->input("sort", $this->defaultOrderColumn);
        if (!$possibleOrderColumns->contains($orderByColumn)) {
            $orderByColumn = $this->defaultOrderColumn;
        }

        $orderDirection =
            $request->input("sort-desc", "0") === "1" ? "desc" : "asc";

        $models = $this->GetModelBuilder()
            ->orderBy($orderByColumn, $orderDirection)
            ->paginate(PAGINATION_PER_PAGE);

        $rows = new Collection();
        foreach ($models as $model) {
            $nextRow = new Collection();
            foreach ($columns as $column) {
                $nextRow->push($column->map($model));
            }
            $rows->push([
                "id" => $model->id,
                "columns" => $nextRow->toArray(),
            ]);
        }

        $columnNames = $columns->pluck("column");
        $columnInputTypes = $this->editInline
            ? $columns->pluck("inputType")
            : new Collection();

        $modelsRemaining = $models->total();
        $pageAfterCreate = 1;
        while ($modelsRemaining >= PAGINATION_PER_PAGE) {
            ++$pageAfterCreate;
            $modelsRemaining -= PAGINATION_PER_PAGE;
        }

        return view("management.index", [
            "managementName" => $this->managementName,
            "managementParameterName" => $this->managementParameterName,
            "models" => $models,
            "rows" => str_replace("\"", "'", json_encode($rows->toArray())),
            "builder" => $this->builder,
            "editInline" => $this->editInline,
            "columnNames" => str_replace(
                "\"",
                "'",
                json_encode($columnNames->toArray())
            ),
            "columnInputTypes" => str_replace(
                "\"",
                "'",
                json_encode($columnInputTypes->toArray())
            ),
            "pageAfterCreate" => $pageAfterCreate,
        ]);
    }

    public function create(): View
    {
        $this->managementInitWrapper();
        return view("management.create", [
            "managementName" => $this->managementName,
            "builder" => $this->builder,
        ]);
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $this->managementInitWrapper();
        $validated = [];

        if ($this->editInline) {
            foreach ($this->builder->inlineColumns as $column) {
                $validated[$column->column] = $column->defaultValue();
            }
        } else {
            $validationRules = [];
            foreach ($this->builder->changersStore as $changer) {
                $validationRules[$changer->column] = $changer->validation;
            }

            $validated = $this->transformStore(
                $request->validate($validationRules)
            );
        }

        $model = null;

        DB::transaction(function () use (&$model, $validated, $request) {
            $model = $this->CreateModel();
            $model->fill($validated);
            $model->save();

            foreach ($this->builder->manyChangersStore as $changer) {
                for ($i = 0; $request->has("$changer->prefix-id-$i"); ++$i) {
                    $id = $request->get("$changer->prefix-id-$i");
                    $properties = [];
                    foreach ($changer->properties as $name) {
                        if (!$request->has("$changer->prefix-$name-$i")) {
                            abort(400);
                        }

                        $properties[$name] = $request->get(
                            "$changer->prefix-$name-$i"
                        );
                    }

                    $changer->linkToModel($model, $id, $properties);
                }
            }
        });

        if ($this->editInline) {
            if ($request->expectsJson()) {
                return response()->json(["success" => true]);
            }
            return redirect()->route("management.$this->managementName.index");
        }

        return redirect()->route("management.$this->managementName.show", [
            $this->managementParameterName => $model->id,
        ]);
    }

    public function show($id): View
    {
        $this->managementInitWrapper();
        $model = $this->GetModelBuilder()
            ->where("id", $id)
            ->firstOrFail();

        return view("management.show", [
            "managementName" => $this->managementName,
            "managementParameterName" => $this->managementParameterName,
            "model" => $model,
            "builder" => $this->builder,
        ]);
    }

    public function edit($id): View
    {
        $this->managementInitWrapper();
        $model = $this->queryEdit(
            $this->GetModelBuilder()->where("id", $id)
        )->firstOrFail();

        return view("management.edit", [
            "managementName" => $this->managementName,
            "managementParameterName" => $this->managementParameterName,
            "model" => $model,
            "builder" => $this->builder,
        ]);
    }

    public function update(Request $request, $id): RedirectResponse|JsonResponse
    {
        $this->managementInitWrapper();

        $validationRules = [];
        foreach ($this->builder->changersUpdate as $changer) {
            $validationRules[$changer->column] = $changer->validation;
        }

        $validated = $this->transformUpdate(
            $request->validate($validationRules)
        );

        $builder = $this->GetModelBuilder()->where("id", $id);

        foreach ($this->builder->manyChangersUpdate as $changer) {
            $builder = $builder->with($changer->relation);
        }

        $model = $builder->firstOrFail();

        DB::transaction(function () use ($model, $validated, $request) {
            $model->fill($validated);
            $model->save();

            foreach ($this->builder->manyChangersUpdate as $changer) {
                $changer->detachAll($model);

                for ($i = 0; $request->has("$changer->prefix-id-$i"); ++$i) {
                    $id = $request->get("$changer->prefix-id-$i");
                    $properties = [];
                    foreach ($changer->properties as $name) {
                        if (!$request->has("$changer->prefix-$name-$i")) {
                            abort(400);
                        }

                        $properties[$name] = $request->get(
                            "$changer->prefix-$name-$i"
                        );
                    }

                    $changer->linkToModel($model, $id, $properties);
                }
            }
        });

        if ($this->editInline) {
            if ($request->expectsJson()) {
                return response()->json(["success" => true]);
            }
            return redirect()->route("management.$this->managementName.index");
        }

        return redirect()->route("management.$this->managementName.show", [
            $this->managementParameterName => $model->id,
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        $model = $this->GetModelBuilder()
            ->where("id", $id)
            ->firstOrFail();

        $model->delete();
        return redirect()->route("management.$this->managementName.index");
    }

    protected string $managementModel = "";
    protected string $managementName = "";
    protected string $managementParameterName = "";
    protected string $defaultOrderColumn = "name";
    protected bool $editInline = false;

    abstract protected function managementInit(
        ManagementBuilder $builder
    ): void;

    protected function transformStore(array $validated): array
    {
        return $validated;
    }

    protected function transformUpdate(array $validated): array
    {
        return $validated;
    }

    protected function queryEdit(Builder $builder): Builder
    {
        return $builder;
    }

    private function managementInitWrapper()
    {
        $this->builder = new ManagementBuilder();
        $this->managementInit($this->builder);
    }

    private function GetModelBuilder(): Builder
    {
        return (new \ReflectionClass($this->managementModel))
            ->getMethod("query")
            ->invoke(null);
    }

    private function CreateModel(array $filledColumns = []): Model
    {
        return (new \ReflectionClass($this->managementModel))->newInstance();
    }

    private ManagementBuilder $builder;
}
