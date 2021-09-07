@php
date_default_timezone_set("Europe/Amsterdam");
$datetime = new DateTime(date('Y-m-d H:i', strtotime("$date $time")));
$now = new DateTime(date('Y-m-d H:i'));
@endphp
<div data-show-box-index="{{$id}}" class="show-box-trigger border-black border grid grid-cols-2 grid-rows-3 h-16 p-2 text-sm reservation relative bg-light">
    <p class="row-start-1 col-start-1 leading-none" title="{{$name}}">{{mb_strimwidth($name,0,15,"...")}}</p>
    <p class="row-start-2 col-start-1 leading-none">{{$date}} - {{$time}}</p>
    <p class="row-start-3 col-start-1 leading-none">{{$numOfGuests}} {{ ($numOfGuests>1) ? "guests" : "guest"}}</p>
    <p class="row-start-1 col-start-2 leading-none">Id : {{$id}}</p>
    <p class="row-start-2 col-start-2 leading-none">{{$eventType ?? ''}}</p>
    <p class="row-start-3 col-start-2 leading-none">{{(count(explode(",",$tables))>1)?"tables":"table"}} : {{implode(', ',json_decode($tables))}}</p>
    <div class="imgWrap row-start-1 col-start-3 col-span-2 absolute right-0 flex flex-col-reverse">
        @if ($datetime < $now && $active == 0)
        <img src="icons/late.svg" alt="Late" class="icon" v-if="IsLate(item.date_start,item.active)">
        @endif
        @if ($eventType)
        <img src="icons/event.svg" alt="Event" class="icon" v-if="item.event_type.length > 0">
        @endif
    </div>
</div>
