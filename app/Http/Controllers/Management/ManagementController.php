<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Management\ManagementColumn;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

abstract class ManagementController extends Controller
{
    public function index(): View
    {
        $this->managementInitWrapper();
        $models = $this->GetModelBuilder()
            ->orderBy("name")
            ->get();

        return view("management.index", [
            "models" => $models,
            "columns" => $this->registeredColumns,
        ]);
    }

    public function create(): View
    {
        return view("management.create", [
            "managementName" => $this->managementName,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->route("management.$this->managementName.index");
    }

    public function show($id): view
    {
        $model = $this->GetModelBuilder()
            ->where("id", $id)
            ->firstOrFail();

        return view("management.show", [
            "model" => $model,
        ]);
    }

    public function edit($id): view
    {
        $model = $this->GetModelBuilder()
            ->where("id", $id)
            ->firstOrFail();

        return view("management.edit", [
            "model" => $model,
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    public function destroy($id): RedirectResponse
    {
        //
    }

    protected string $managementModel = "";
    protected string $managementName = "";

    abstract protected function managementInit(): void;

    protected function RegisterColumn(
        string $name,
        string $display,
        string $type,
        array $validationRules = [],
        bool $showInIndex = true
    ): self {
        $this->registeredColumns->push(
            new ManagementColumn(
                $name,
                $display,
                $type,
                $validationRules,
                $showInIndex
            )
        );
        return $this;
    }

    private function managementInitWrapper()
    {
        $this->registeredColumns = new Collection();
        $this->managementInit();
    }

    private function GetModelBuilder(): Builder
    {
        return (new \ReflectionClass($this->managementModel))
            ->getMethod("query")
            ->invoke(null);
    }

    private Collection $registeredColumns;
}
