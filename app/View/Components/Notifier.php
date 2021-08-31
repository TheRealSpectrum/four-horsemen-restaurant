<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

final class Notifier extends Popup
{
    public function __construct(
        string $id = "",
        string $type = "save",
        string $trigger = ""
    ) {
        parent::__construct($id, $type, $trigger);
    }

    public function render(): View
    {
        return view("components.notifier");
    }
}
