<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class AuthController extends Controller
{
    public function login(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route("reservations.index");
        }
        return view("auth.login");
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route("reservations.index");
        }

        return back()
            ->withInput($request->only("email"))
            ->withErrors([
                "email" => __("auth.failed"),
            ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route("auth.login");
    }
}
