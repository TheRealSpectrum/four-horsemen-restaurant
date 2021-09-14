<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

abstract class ManagementController extends Controller
{
    public function index(): View
    {
        return view("management.index");
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
        return view("management.edit");
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    public function destroy($id): RedirectResponse
    {
        //
    }

    private string $managementName;
}
