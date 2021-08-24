<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LabledInput extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $label, $type, $placeholder, $value;

    public function __construct($data)
    {
        $this->label = $data->label;
        $this->type = $data->type;
        $this->placeholder = $data->placeholder ?? $data->label + "...";
        $this->value = $data->value ?? "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("components.labled-input");
    }
}
