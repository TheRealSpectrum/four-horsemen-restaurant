<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

final class Notifier extends Component
{
    public function __construct(string $type = "safe", string $trigger = "")
    {
        $this->type = $type;
        $this->trigger = $trigger;
    }

    public function render(): View
    {
        return view("components.notifier");
    }
    public string $type = "";
    public string $trigger = "";
}
