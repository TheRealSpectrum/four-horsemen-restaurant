<div {{$attributes}} class="{{$additionalClasses}} flex flex-col">
    <div class="bg-light-gray h-8 w-64 pl-4">{{$title}}</div>
    <div class="{{$additionalBodyClasses}} grid bg-light-gray h-auto p-4 gap-x-5 gap-y-3 auto-rows-min flex-1" style="height:90%; overflow:auto">{{$slot}}</div>
</div>
