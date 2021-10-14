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
        bool $shouldSort,
        callable $map
    ) {
        $this->column = $column;
        $this->header = $header;
        $this->inputType = $inputType;
        $this->defaultValueCallback = $defaultValue;
        $this->shouldSort = $shouldSort;
        $this->mapCallback = $map;
    }

    public function map(Model $model): string
    {
        return ($this->mapCallback)($model);
    }

    public function defaultValue()
    {
        return ($this->defaultValueCallback)();
    }

    public string $column;
    public string $header;
    public string $inputType;
    public bool $shouldSort;

    private $defaultValueCallback;
    private $mapCallback;
}
