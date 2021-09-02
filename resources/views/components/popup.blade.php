<div {{$attributes}} data-instant-trigger="{{$shouldTrigger}}" class="popup-root
     {{$additionalClasses}}
     fixed flex w-screen h-screen left-0 top-0">

    <div class="{{$additionalInternalClasses}}
         border-2 border-dark inline-block p-2 rounded-xl">

        <div class="text-center">{{$slot}}</div>

    </div>

</div>
