<?php

namespace App\Management;

use Illuminate\Database\Eloquent\Model;

final class InlineColumn
{
    public function __construct(
        string $column,
        string $header,
        string $inputType,
        callable $defaultValue,
        callable $map
    ) {
        $this->column = $column;
        $this->header = $header;
        $this->inputType = $inputType;
        $this->mapCallback = $map;
    }

    public function map(Model $model): string
    {
        return ($this->mapCallback)($model);
    }

    public string $column;
    public string $header;
    public string $inputType;
    private $mapCallback;
}
