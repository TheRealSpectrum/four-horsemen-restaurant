<div id="{{$popupId}}" data-instant-trigger="{{$instantTrigger}}"
    class="confirmation w-screen h-screen bg-dim hidden
       grid grid-cols-1 grid-rows-1 justify-center place-items-center inline-block fixed left-0 top-0">
    <div
        class="bg-light border-2 border-dark p-2 max-w-xl rounded-xl
            flex flex-col">

        <div class="text-center text-xl">{{$titleText}}</div>
        <div class="text-center">{{$slot}}</div>
        <div class="flex flex-row justify-between flex-1 items-end m-8">
            <button class="confirmation-back border-2 border-dark p-1 rounded">{{$optionBackText}}</button>
            <button class="bg-{{$colorName}} border-2 border-dark p-1 rounded">{{$optionContinueText}}</button>
        </div>
    </div>
</div>
