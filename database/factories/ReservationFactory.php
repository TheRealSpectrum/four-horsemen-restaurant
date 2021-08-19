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
            "active" => false,
            "event_type" => $this->faker->randomElement([
                "",
                "",
                "",
                "",
                "",
                "afterparty",
            ]),
        ];
    }

    public function beforeNow(): self
    {
        return $this->state(function (array $attributes) {
            $date = $this->faker->dateTimeBetween("-2 hours", "-10 minutes");
            $dateEnd = clone $date;
            $dateEnd->add(new \DateInterval("PT1H"));

            return [
                "date_start" => $date,
                "date_end" => $dateEnd,
                "active" => $this->faker->randomElement([
                    true,
                    true,
                    true,
                    false,
                ]),
            ];
        });
    }
}
