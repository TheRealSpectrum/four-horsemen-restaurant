<?php

namespace App\Management\Advanced;

use Illuminate\Support\Collection;

final class Setting
{
    public function __construct(string $name, string $display)
    {
        $this->name = $name;
        $this->display = $display;
    }

    public function getData(): Collection
    {
        return collect([
            "name" => $this->name,
        ]);
    }

    public string $name;
    public string $display;
}
