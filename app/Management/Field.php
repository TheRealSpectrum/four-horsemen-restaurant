<?php

namespace App\Management;

use Illuminate\Database\Eloquent\Model;

final class Field
{
    public function __construct(
        string $column,
        string $type,
        string $label,
        callable $map,
        callable $mapInput
    ) {
        $this->column = $column;
        $this->type = $type;
        $this->label = $label;
        $this->mapCallback = $map;
        $this->mapInputCallback = $mapInput;
    }

    public function map(Model $model): string
    {
        return ($this->mapCallback)($model);
    }

    public function mapInput(Model $model): string
    {
        return ($this->mapInputCallback)($model);
    }

    public string $column;
    public string $type;
    public string $label;

    private $mapCallback;
    private $mapInputCallback;
}
