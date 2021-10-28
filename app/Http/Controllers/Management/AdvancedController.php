<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

final class AdvancedController extends Controller
{
    public function index(): View
    {
        return view("management.advanced.index");
    }

    public function update(Request $request, $id): JsonResponse
    {
        return response()->json();
    }
}
