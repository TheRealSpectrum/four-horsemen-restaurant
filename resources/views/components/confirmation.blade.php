<div id="{{$popupId}}" data-instant-trigger="{{$instantTrigger}}" data-form-id="{{$formId}}"
    class="confirmation w-screen h-screen bg-dim hidden
       grid grid-cols-1 grid-rows-1 justify-center place-items-center inline-block fixed left-0 top-0">
    <div
        class="bg-light border-2 border-dark p-2 max-w-xl rounded-xl
            flex flex-col">

        <h2 class="text-center text-xl font-bold">{{$title}}</h2>
        <div class="text-center">{{$slot}}</div>
        <div class="grid grid-cols-3 flex-1 m-8">
            <button class="confirmation-back border-2 border-dark p-1 rounded">{{$optionBackText}}</button>
            <div></div>
            <button class="confirmation-continue bg-{{$colorName}} border-2 border-dark p-1 rounded">{{$optionContinueText}}</button>
        </div>
    </div>
</div>
