<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

final class Popup extends Component
{
    public function __construct(
        string $class = "",
        string $internalClass = "",
        string $type = "save",
        string $trigger = ""
    ) {
        $this->additionalClasses = $class;
        $this->additionalInternalClasses = $internalClass;

        $this->shouldTrigger = Request::has($trigger) ? "1" : "0";

        switch ($type) {
            case "safe":
                $this->additionalInternalClasses .= " bg-save";
                break;
            case "warningLow":
                $this->additionalInternalClasses .= " bg-warning-low";
                break;
            case "warningHigh":
                $this->additionalInternalClasses .= " bg-warning-high";
                break;
        }
    }

    public function render(): View
    {
        return view("components.popup");
    }

    public string $additionalClasses = "";
    public string $additionalInternalClasses = "";
    public string $shouldTrigger = "";
}
