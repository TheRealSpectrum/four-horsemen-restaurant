<?php

namespace App\Management;

use Illuminate\Database\Eloquent\Model;

final class Field
{
    public function __construct(
        string $column,
        string $type,
        string $label,
        callable $map
    ) {
        $this->column = $column;
        $this->type = $type;
        $this->label = $label;
        $this->mapCallback = $map;
    }

    public function map(Model $model): string
    {
        return ($this->mapCallback)($model);
    }

    public function mapColumn(Model $model): string
    {
        $column = $this->column;
        return $model->$column;
    }

    public string $column;
    public string $type;
    public string $label;

    private $mapCallback;
}
