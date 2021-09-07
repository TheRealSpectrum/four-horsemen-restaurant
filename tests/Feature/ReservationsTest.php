<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

use App\Models\{Reservation, Table, User};

final class ReservationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_index(): void
    {
        $response = $this->get("/reservations");

        $response->assertRedirect("/login");
    }

    public function test_guest_is_redirected_from_create(): void
    {
        $response = $this->get("/reservation/new");

        $response->assertRedirect("/login");
    }

    public function test_guest_is_redirected_from_edit(): void
    {
        $response = $this->get("/agenda");

        $response->assertRedirect("/login");
    }

    public function test_guest_is_redirected_from_store(): void
    {
        $response = $this->post("/reservation/store");

        $response->assertRedirect("/login");
    }

    public function test_guest_is_redirected_from_update(): void
    {
        $response = $this->patch("/update");

        $response->assertRedirect("/login");
    }

    public function test_authenticated_user_can_access_index(): void
    {
        $user = User::factory()->create();

        $response = $this->withSession(["banned" => false])
            ->actingAs($user)
            ->get("/reservations");

        $response->assertOk();
    }

    public function test_authenticated_user_can_access_create(): void
    {
        $user = User::factory()->create();

        $response = $this->withSession(["banned" => false])
            ->actingAs($user)
            ->get("/reservation/new");

        $response->assertOk();
    }

    public function test_authenticated_user_can_access_edit(): void
    {
        $user = User::factory()->create();

        $response = $this->withSession(["banned" => false])
            ->actingAs($user)
            ->get("/agenda");

        $response->assertOk();
    }

    public function test_authenticated_user_can_store_reservation(): void
    {
        $this->assertDatabaseCount("reservations", 0);
        $user = User::factory()->create();
        $tableId = Table::factory()->create()->id;

        $response = $this->withSession(["banned" => false])
            ->actingAs($user)
            ->post("/reservation/store", [
                "name" => "Guest Name",
                "phone_number" => "+31612345678",
                "guest_count" => "4",
                "date" => "3021-09-25", // Test will break when I'm dead, so not a problem.
                "time" => "13:00",
                "endTime" => "60",
                "event_type" => "afterparty",
                "notes" => "Including service dog",
                "table" => (string) $tableId,
            ]);

        $response->assertRedirect("/reservation");
        $this->assertDatabaseCount("reservations", 1);
    }

    public function test_authenticated_user_can_update_reservation(): void
    {
        $this->assertDatabaseCount("reservations", 0);
        $user = User::factory()->create();
        $newTableId = Table::factory()->create()->id;
        $oldTable = Table::factory()->create();
        $reservation = Reservation::factory()->create();
        $reservation->tables()->attach($oldTable);

        $this->assertDatabaseCount("reservations", 1);

        $response = $this->withSession(["banned" => false])
            ->actingAs($user)
            ->patch("/update", [
                "id" => $reservation->id,
                "name" => "Guest Name",
                "phone_number" => "+31612345678",
                "guest_count" => "4",
                "date" => "3021-09-25", // Test will break when I'm dead, so not a problem.
                "time" => "13:00",
                "endTime" => "60",
                "event_type" => "birthday",
                "notes" => "Including service dog",
                "table" => (string) $newTableId,
            ]);

        $response->assertRedirect("/agenda");
        $this->assertDatabaseCount("reservations", 1);
    }

    public function test_invalid_data_in_store_request_results_in_redirect_back_and_does_not_create_models(): void
    {
        $this->assertDatabaseCount("reservations", 0);
        $user = User::factory()->create();
        $tableId = Table::factory()->create()->id;

        foreach (
            [
                "name" => "a",
                "phone_number" => "+3162345",
                "phone_number" => "+316qwertyui",
                "guest_count" => "0",
                "guest_count" => "56f",
                "date" => "1999-01-01",
                // "endTime" => "text",
                // "endTime" => "-10",
                // "table" => "0",
                // "table" => "text",
            ]
            as $key => $value
        ) {
            $response = $this->withSession(["banned" => false])
                ->actingAs($user)
                ->post(
                    "/reservation/store",
                    array_merge(
                        [
                            "name" => "Guest Name",
                            "phone_number" => "+31612345678",
                            "guest_count" => "4",
                            "date" => "3021-09-25", // Test will break when I'm dead, so not a problem.
                            "time" => "13:00",
                            "endTime" => "60",
                            "event_type" => "afterparty",
                            "notes" => "Including service dog",
                            "table" => (string) $tableId,
                        ],
                        [$key => $value]
                    )
                );

            $response->assertRedirect("/reservation/new");
        }

        $this->assertDatabaseCount("reservations", 0);
    }
}
