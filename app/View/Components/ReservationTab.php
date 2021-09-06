<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ReservationTab extends Component
{
    public function __construct(
        string $title = "",
        string $columns = "1",
        string $class = "",
        string $bodyClass = ""
    ) {
        $this->title = $title;
        $this->additionalClasses = $class;

        $this->additionalBodyClasses = $bodyClass;
        switch ($columns) {
            case "3":
                $this->additionalBodyClasses .= " grid-cols-3";
                break;

            case "2":
                $this->additionalBodyClasses .= " grid-cols-2";
                break;

            default:
                $this->additionalBodyClasses .= " grid-cols-1";
                break;
        }
    }

    public function render()
    {
        return view("components.reservation-tab");
    }

    public string $title;
    public string $additionalClasses;
    public string $additionalBodyClasses;
}
