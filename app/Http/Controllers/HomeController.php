<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        return redirect()->route("auth.login");
    }
}
