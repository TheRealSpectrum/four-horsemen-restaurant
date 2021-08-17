@php
date_default_timezone_set("Europe/Amsterdam");
$now = new DateTime(date('Y-m-d H:i'));
$plus1hours = new DateTime(date("+1hour"))
@endphp

@extends("layout.app")

@section("content")
    @foreach ($resevations as $item)
        @php
        $reservationDate = new DateTime(date('Y-m-d H:i', strtotime("$item->date $item->time")));
        @endphp
        @if ($reservationDate > $now && $reservationDate < $plus1hours)
            <x-res-item :info="$item"></x-reservation-item>
        @elseif ($reservationDate < $now && $item->status == true)
            <x-res-item :info="$item"></x-reservation-item>
        @elseif ($reservationDate < $now && $item->status == false)
            <x-res-item :info="$item" ></x-reservation-item>
        @else
            <x-res-item :info="$item"></x-reservation-item>
        @endif
    @endforeach
<div id="main_wrapper" class="grid grid-cols-4 grid-rows-1 gap-5 ">
    <div id="active_reservations" class="col-start-1 col-span-1 flex flex-row flex-wrap border-2 border-black">
        <p>active reservations</p>
    </div>
    <div id="incoming_reservations" class="col-start-2 col-span-2 flex flex-col flex-nowrap border-2 border-black">
        <div id="late_reservations" class="flex flex-row flex-wrap border-2 border-black">
            <p>late reservations</p>
        </div>
        <div id="upcoming_reservations" class="flex flex-row flex-wrap border-2 border-black">
            <p>reservations in the next hour</p>
        </div>
    </div>
    <div id="later_reservations" class="col-start-4 col-span-1 flex flex-row flex-wrap border-2 border-black">
        <p>reservations later today</p>    
    </div>
</div>
@endsection()