<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
    BelongsToMany,
    HasMany,
    HasOne
};

class Order extends Model
{
    use HasFactory;

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class)
            ->with("dishes")
            ->where("type", "normal");
    }

    public function firstOpenCourse(): HasOne
    {
        return $this->hasOne(Course::class)
            ->with("dishes")
            ->where("type", "normal")
            ->where("done", false);
    }

    /**
     * @deprecated use drinksV2 instead, this will not work.
     */
    public function drinks(): HasMany
    {
        return $this->hasMany(Course::class)
            ->with("dishes")
            ->where("type", "drinks");
    }

    public function coursesAndDrinks(): HasMany
    {
        return $this->hasMany(Course::class)->with("dishes");
    }

    public function drinksV2(): BelongsToMany
    {
        return $this->belongsToMany(Drink::class)
            ->withPivot("amount")
            ->using(OrderDrink::class);
    }
}
