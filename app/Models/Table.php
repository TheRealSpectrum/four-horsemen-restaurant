<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Table extends Model
{
    use HasFactory;

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class);
    }

    protected $fillable = ["id", "seat_count"];
}
