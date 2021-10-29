<?php

namespace App\Management\Advanced;

use Illuminate\Support\Collection;

final class Group
{
    public function __construct(string $name, callable $settings)
    {
        $this->name = $name;
        $this->settings = new Collection();
        $settings($this->settings);
    }

    public function getData(): Collection
    {
        return collect([
            "name" => $this->name,
            "settings" => $this->settings->map(function (Setting $setting) {
                return $setting->getData();
            }),
        ]);
    }

    public string $name;
    public Collection $settings;
}
