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

        switch ($type) {
            case "ingredient":
                $this->display = "components.management.show-field-ingredient";
                break;
        }
    }

    public function render()
    {
        return view($this->display);
    }

    public string $label;
    public string $value;
    public string $type;

    private string $display = "components.management.show-field";
}
