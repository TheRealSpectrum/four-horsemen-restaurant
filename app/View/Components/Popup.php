<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Request;

abstract class Popup extends Component
{
    public function __construct(
        string $id = "",
        string $type = "save",
        string $trigger = ""
    ) {
        $this->popupId = $id;
        $this->instantTrigger = Request::has($trigger) ? "1" : "0";

        switch ($type) {
            case "save":
                $this->titleText = "Info";
                $this->colorName = "save";
                break;
            case "warningLow":
                $this->titleText = "Alert!";
                $this->colorName = "warning-low";
                break;
            case "warningHigh":
                $this->titleText = "Alert!";
                $this->colorName = "warning-high";
                break;
        }
    }

    public string $popupId = "";
    public string $titleText = "";
    public string $colorName = "";
    public string $instantTrigger = "";
}
