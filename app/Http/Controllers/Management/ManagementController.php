<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

abstract class ManagementController extends Controller
{
    public function index(): View
    {
        $models = $this->GetModelBuilder()
            ->orderBy("name")
            ->get();

        return view("management.index", [
            "models" => $models,
        ]);
    }

    public function create(): View
    {
        return view("management.create");
    }

    public function store(Request $request): RedirectResponse
    {
    }

    public function show($id): view
    {
        return view("management.show");
    }

    public function edit($id): view
    {
        $model = $this->GetModelBuilder()
            ->where("id", $id)
            ->firstOrFail();

        return view("management.edit", ["model" => $model]);
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

    private function GetModelBuilder(): Builder
    {
        return (new \ReflectionClass($this->managementModel))
            ->getMethod("query")
            ->invoke(null);
    }
}
