<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

final class Reservation extends Model
{
    use HasFactory;

    public static function formatCollectionForJavascript(
        Collection $reservations
    ) {
        $result = "{";

        $reservations->each(function (Reservation $reservation) use (&$result) {
            $isActive = $reservation->active ? "true" : "false";

            // prettier-ignore
            $result .= <<<JSON
                        "$reservation->id": {
                            "name": "$reservation->name",
                            "guestCount": $reservation->guest_count,
                            "date_start": "{$reservation->date_start->format("Y-m-d")}",
                            "time_start": "{$reservation->date_start->format("H:i")}",
                            "active": $isActive,
                            "eventType": "$reservation->event_type"
                        },
                        JSON;
        });
        $result = substr($result, 0, -1);

        $result .= "}";

        return str_replace("\n", "", $result);
    }

    public function tables(): BelongsToMany
    {
        return $this->belongsToMany(Table::class);
    }

    protected $fillable = [
        "name",
        "guest_count",
        "date_start",
        "date_end",
        "active",
        "event_type",
    ];

    protected $casts = [
        "date_start" => "datetime",
        "date_end" => "datetime",
    ];
}
