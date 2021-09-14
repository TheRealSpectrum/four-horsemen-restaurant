<?php

namespace App\Management;

final class ManagementColumn
{
    public function __construct(
        string $name,
        string $display,
        string $type,
        array $validationRules,
        bool $showInIndex
    ) {
        $this->name = $name;
        $this->display = $display;
        $this->type = $type;
        $this->validationRules = $validationRules;
        $this->showInIndex = $showInIndex;
    }

    public string $name;
    public string $display;
    public string $type;
    public array $validationRules;
    public bool $showIndex;
}
