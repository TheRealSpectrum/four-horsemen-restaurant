<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

use App\Models\User;

final class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_sees_login(): void
    {
        $this->get("/login")->assertOk();
    }

    public function test_authenticated_user_is_redirected_to_root(): void
    {
        $user = User::factory()->create();
        $this->withSession(["banned" => false])
            ->actingAs($user)
            ->get("/login")
            ->assertRedirect("/reservations");
    }

    public function test_user_can_authenticate(): void
    {
        $user = User::factory()->create([
            "name" => "Admin",
            "email" => "admin@example.com",
        ]);

        $this->post("/login", [
            "email" => "admin@example.com",
            "password" => "password",
        ])->assertRedirect("/reservations");

        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_authenticate_with_incorrect_credentials(): void
    {
        $user = User::factory()->create([
            "name" => "Admin",
            "email" => "admin@example.com",
        ]);

        $incorrectCredentials = [
            ["aadmin@example.com", "password"],
            ["ad.min@example.com", "password"],
            ["amdin@example.com", "password"],
            ["admin@example.com", "Password"],
            ["admin@example.com", "pasword"],
            ["admin@example.com", "password."],
        ];

        foreach ($incorrectCredentials as $credential) {
            $this->post("/login", [
                "email" => $credential[0],
                "password" => $credential[1],
            ])->assertSessionHasErrors(["email"]);
            $this->assertGuest();
        }
    }

    public function test_user_is_redirected_on_logout(): void
    {
        $this->post("/logout")->assertRedirect("/login");
        $this->assertGuest();
    }

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();

        $this->withSession(["banned" => false])
            ->actingAs($user)
            ->get("/login")
            ->assertRedirect("/reservations");

        $this->assertAuthenticatedAs($user);

        $this->withSession(["banned" => false])
            ->actingAs($user)
            ->post("/logout")
            ->assertRedirect("/login");

        $this->assertGuest();
    }
}
