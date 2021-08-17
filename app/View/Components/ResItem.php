<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ResItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $id, $name, $numOfGuests, $tables, $date, $time, $eventType, $active;

    public function __construct($info)
    {
        $this->id = $info->id;
        $this->name = $info->name;
        $this->numOfGuests = $info->numOfGuests;
        $this->tables = implode(", ", $info->tables);
        $this->date = $info->date;
        $this->time = $info->time;
        $this->eventType = $info->eventType;
        $this->active = $info->status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("components.res-item");
    }
}
