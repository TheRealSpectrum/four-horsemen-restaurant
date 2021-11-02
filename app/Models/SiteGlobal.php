<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteGlobal extends Model
{
    use HasFactory;

    public function markupDishesFactor(): float
    {
        return $this->markup_dishes / 100;
    }

    public function markupDrinksFactor(): float
    {
        return $this->markup_drinks / 100;
    }

    protected $fillable = ["markup_dishes", "markup_drinks"];
}
