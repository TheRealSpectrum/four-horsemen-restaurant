<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Reservation extends Model
{
    use HasFactory;

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
