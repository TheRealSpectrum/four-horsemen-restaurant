<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

final class Confirmation extends Popup
{
    public function __construct(
        string $id = "",
        string $type = "save",
        string $trigger = "",
        string $optionBack = "Go Back",
        string $optionContinue = "Continue",
        string $form = "",
        string $title = ""
    ) {
        parent::__construct($id, $type, $trigger);
        $this->optionBackText = $optionBack;
        $this->optionContinueText = $optionContinue;
        $this->formId = $form;
        $this->title = $title;
    }

    public function render(): View
    {
        return view("components.confirmation");
    }

    public string $optionBackText = "";
    public string $optionContinueText = "";
    public string $formId = "";
    public string $title = "";
}
