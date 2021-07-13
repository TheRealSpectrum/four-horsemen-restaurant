<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    public function storedWithUnit(): string
    {
        return $this->stored . $this->unit;
    }

    protected $fillable = ["name", "unit", "stored", "stored_min"];
}
