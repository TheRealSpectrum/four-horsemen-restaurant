<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public function __construct(
        string $class = "",
        string $id = "",
        string $type = "button",
        string $level = "neutral"
    ) {
        $this->additionalClasses = $class;
        $this->id = $id;
        $this->buttonType = $type;

        switch ($level) {
            case "safe":
                $this->additionalClasses .= " bg-save";
                break;
            case "low":
                $this->additionalClasses .= " bg-warning-low";
                break;
            case "high":
                $this->additionalClasses .= " bg-warning-high";
                break;
        }
    }

    public function render()
    {
        return view("components.button");
    }

    public string $additionalClasses = "";
    public string $id = "";
    public string $buttonType = "";
}
