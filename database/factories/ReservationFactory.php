<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween("+1 hour", "+4 days");
        $dateEnd = clone $date;
        $dateEnd->add(new \DateInterval("PT1H"));

        return [
            "name" => $this->faker->name(),
            "guest_count" => $this->faker->numberBetween(1, 6),
            "date_start" => $date,
            "date_end" => $dateEnd,
            "active" => true,
            "event_type" => "",
        ];
    }
}
