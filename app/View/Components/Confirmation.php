<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Confirmation extends Notifier
{
    public function __construct(
        string $id = "",
        string $type = "info",
        string $trigger = ""
    ) {
        parent::__construct($id, $type, $trigger);
    }

    public function render(): View
    {
        return view("components.confirmation");
    }
}
