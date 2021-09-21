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

        switch ($type) {
            case "ingredient":
                $this->display =
                    "components.management.create-field-ingredient";
                break;
        }
    }

    public function render()
    {
        return view($this->display);
    }

    public string $name;
    public string $label;
    public string $value;
    public string $type;

    private string $display = "components.management.create-field";
}
