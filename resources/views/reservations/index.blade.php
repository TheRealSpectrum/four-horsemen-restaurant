@php
date_default_timezone_set("Europe/Amsterdam");
@endphp

@extends("layout.app")

@section("content")
<div id="main_wrapper" class="grid grid-cols-10 grid-rows-1 gap-5 ">
    <p class="row-start-1 col-span-2">active reservations</p>
    <div id="active_reservations" class="row-start-2 col-start-1 col-span-2 flex flex-row flex-wrap border-2 border-black place-content-start">
        @foreach ($active as $item)
            <x-res-item :info="$item"></x-reservation-item>
        @endforeach
    </div>
    <div id="incoming_reservations" class="row-start-2 col-start-3 col-span-6 flex flex-col flex-nowrap border-2 border-black place-content-start">
        <p>late reservations</p>
        <div id="late_reservations" class="flex flex-row flex-wrap border-2 border-black place-content-start">
            @foreach ($late as $item)
                <x-res-item :info="$item"></x-reservation-item>
            @endforeach
        </div>
        <p>reservations in the next hour</p>
        <div id="upcoming_reservations" class="flex flex-row flex-wrap border-2 border-black place-content-start">
            @foreach ($upcoming as $item)
                <x-res-item :info="$item"></x-reservation-item>
            @endforeach
        </div>
    </div>
    <p class="row-start-1 col-start-9 col-span-2">reservations later today</p>  
    <div id="later_reservations" class="row-start-2 col-start-9 col-span-2 flex flex-row flex-wrap border-2 border-black place-content-start">
        @foreach ($later as $item)
            <x-res-item :info="$item"></x-reservation-item>
        @endforeach  
    </div>
</div>
@endsection()
