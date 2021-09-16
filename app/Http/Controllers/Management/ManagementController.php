<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Management\ManagementColumn;
use App\Management\Builder as ManagementBuilder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class ManagementController extends Controller
{
    public function index(): View
    {
        $this->managementInitWrapper();
        $models = $this->GetModelBuilder()
            ->orderBy("name")
            ->get();

        return view("management.index", [
            "managementName" => $this->managementName,
            "managementParameterName" => $this->managementParameterName,
            "models" => $models,
            "builder" => $this->builder,
        ]);
    }

    public function create(): View
    {
        $this->managementInitWrapper();
        return view("management.create", [
            "managementName" => $this->managementName,
            "columns" => $this->registeredColumns,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->managementInitWrapper();

        $validationRules = [];
        foreach ($this->registeredColumns as $column) {
            $validationRules[$column->name] = $column->validationRules;
        }

        $validated = $request->validate($validationRules);

        $model = $this->CreateModel();
        $model->fill($validated);
        $model->save();

        return redirect()->route("management.$this->managementName.show", [
            $this->managementParameterName => $model->id,
        ]);
    }

    public function show($id): view
    {
        $this->managementInitWrapper();
        $model = $this->GetModelBuilder()
            ->where("id", $id)
            ->firstOrFail();

        return view("management.show", [
            "managementName" => $this->managementName,
            "managementParameterName" => $this->managementParameterName,
            "columns" => $this->registeredColumns,
            "model" => $model,
        ]);
    }

    public function edit($id): view
    {
        $this->managementInitWrapper();
        $model = $this->GetModelBuilder()
            ->where("id", $id)
            ->firstOrFail();

        return view("management.edit", [
            "managementName" => $this->managementName,
            "managementParameterName" => $this->managementParameterName,
            "columns" => $this->registeredColumns,
            "model" => $model,
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->managementInitWrapper();

        $validationRules = [];
        foreach ($this->registeredColumns as $column) {
            $validationRules[$column->name] = $column->validationRules;
        }

        $validated = $request->validate($validationRules);

        $model = $this->GetModelBuilder()
            ->where("id", $id)
            ->firstOrFail();

        $model->fill($validated);
        $model->save();

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

    abstract protected function managementInit(
        ManagementBuilder $builder
    ): void;

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
