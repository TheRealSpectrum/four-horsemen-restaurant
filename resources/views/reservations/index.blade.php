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
            <x-res-item :info="$item" :pos="mid lower"></x-reservation-item>
        @elseif ($reservationDate < $now && $item->active)
            <x-res-item :info="$item" :pos="left"></x-reservation-item>
        @elseif ($reservationDate < $now && !$item->active)
            <x-res-item :info="$item" :pos="mid upper"></x-reservation-item>
        @else
            <x-res-item :info="$item" :pos="right"></x-reservation-item>
        @endif
    @endforeach
@endsection()