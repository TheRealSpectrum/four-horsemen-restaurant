<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * General purpose button.
 *
 * Possible to change the background color by changing the `level` attribute:
 * safe = green
 * low = orange
 * high = red
 *
 * Button type defaults to `button`.
 */
final class Button extends Component
{
    public function __construct(
        string $class = "",
        string $type = "button",
        string $level = "neutral"
    ) {
        $this->additionalClasses = $class;
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
    public string $buttonType = "";
}
