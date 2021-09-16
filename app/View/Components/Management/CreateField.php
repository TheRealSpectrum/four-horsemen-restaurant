<?php

namespace App\View\Components\Management;

use Illuminate\View\Component;

class CreateField extends Component
{
    public function __construct(
        string $name = "",
        string $label = "",
        string $value = "",
        string $type = "text"
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->type = $type;
    }

    public function render()
    {
        return view("components.management.create-field");
    }

    public string $name;
    public string $label;
    public string $value;
    public string $type;
}
