<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

final class Confirmation extends Component
{
    public function __construct(
        string $type = "",
        string $optionBack = "Go Back",
        string $optionContinue = "Continue",
        string $form = "",
        string $title = "",
        string $trigger = ""
    ) {
        $this->type = $type;
        $this->optionBackText = $optionBack;
        $this->optionContinueText = $optionContinue;
        $this->formId = $form;
        $this->title = $title;
        $this->trigger = $trigger;
    }

    public function render(): View
    {
        return view("components.confirmation");
    }

    public string $type = "";
    public string $optionBackText = "";
    public string $optionContinueText = "";
    public string $formId = "";
    public string $title = "";
    public string $trigger = "";
}
