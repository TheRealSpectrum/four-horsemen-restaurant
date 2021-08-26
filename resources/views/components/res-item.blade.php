@php
date_default_timezone_set("Europe/Amsterdam");
$datetime = new DateTime(date('Y-m-d H:i', strtotime("$date $time")));
$now = new DateTime(date('Y-m-d H:i'));
@endphp
<div data-show-box-index="{{$id}}" class="show-box-trigger border-black border grid grid-cols-2 grid-rows-3 h-16 p-2 text-sm reservation">
    <p class="row-start-1 col-start-1 leading-none" title="{{$name}}">{{mb_strimwidth($name,0,15,"...")}}</p>
    <p class="row-start-2 col-start-1 leading-none">{{$date}} - {{$time}}</p>
    <p class="row-start-3 col-start-1 leading-none">{{$numOfGuests}} {{ ($numOfGuests>1) ? "guests" : "guest"}}</p>
    <p class="row-start-1 col-start-2 leading-none">Id : {{$id}}</p>
    <p class="row-start-2 col-start-2 leading-none">{{$eventType ?? ''}}</p>
    <p class="row-start-3 col-start-2 leading-none">{{(count(explode(",",$tables))>1)?"tables":"table"}} : {{$tables}}</p>
    @if ($datetime < $now && $active == 0)
    <img src="icons/late.svg" alt="" class="row-start-1 col-start-3 col-span-2 w-12 h-12">
    @elseif ($eventType)
    <img src="icons/party.svg" alt="" class="row-start-1 col-start-3 col-span-2 w-12 h-12">
    @endif
</div>
