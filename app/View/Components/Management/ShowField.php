<?php

namespace App\View\Components\Management;

use Illuminate\View\Component;

final class ShowField extends Component
{
    public function __construct(
        string $label = "",
        string $value = "",
        string $type = "text"
    ) {
        $this->label = $label;
        $this->value = $value;
        $this->type = $type;
    }

    public function render()
    {
        return view("components.management.show-field");
    }

    public string $label;
    public string $value;
    public string $type;
}
