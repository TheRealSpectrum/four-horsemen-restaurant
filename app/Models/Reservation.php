<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Reservation extends Model
{
    use HasFactory;

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
