<div id="{{$notifyId}}" data-instant-trigger="{{$instantTrigger}}"
    class="w-screen h-screen
       grid grid-cols-1 grid-rows-1 justify-center place-items-center inline-block fixed left-0 top-0">
    <div
                            class="confirmation bg-{{$colorName}} border-2 border-dark p-2 w-96 h-40 rounded-xl">
        <div class="text-center text-xl">{{$titleText}}</div>
        <div class="text-center">{{$slot}}</div>
    </div>
</div>
