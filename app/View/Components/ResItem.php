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

    public $id,
        $name,
        $numOfGuests,
        $tables,
        $date,
        $time,
        $timeEnd,
        $eventType,
        $active;

    public function __construct($info)
    {
        $this->id = $info->id;
        $this->name = $info->name;
        $this->numOfGuests = $info->guest_count;
        $this->tables = $info->tables->pluck("id");
        $this->date = $info->date_start->format("Y-m-d");
        $this->time = $info->date_start->format("H:i");
        $this->timeEnd = $info->date_end;
        $this->eventType = $info->event_type;
        $this->active = $info->active;
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
