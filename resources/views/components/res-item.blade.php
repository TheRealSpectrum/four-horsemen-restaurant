<div class="border-black border grid grid-cols-2 grid-rows-3 w-60 h-16">
    <p class="row-start-1 col-start-1">{{$name}}</p>
    <p class="row-start-2 col-start-1">{{$date}} - {{$time}}</p>
    <p class="row-start-3 col-start-1">{{$numOfGuests}} {{ ($numOfGuests>1) ? "guests" : "guest"}}</p>
    <p class="row-start-1 col-start-2">{{$id}}</p>
    <p class="row-start-2 col-start-2">{{$eventType ?? ''}}</p>
    <p class="row-start-3 col-start-2">{{$tables}}</p>
    <img src="#" alt="" class="row-start-1 col-start-3 col-span-2">
</div>