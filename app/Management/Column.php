<?php

namespace App\Management;

use Illuminate\Database\Eloquent\Model;

final class Column
{
    public function __construct(
        string $column,
        string $header,
        bool $shouldSort,
        callable $map
    ) {
        $this->column = $column;
        $this->header = $header;
        $this->shouldSort = $shouldSort;
        $this->mapCallback = $map;
    }

    public function map(Model $model): string
    {
        return ($this->mapCallback)($model);
    }

    public string $column;
    public string $header;
    public bool $shouldSort;
    private $mapCallback;
}
