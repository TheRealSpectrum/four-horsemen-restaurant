<x-popup {{$attributes}} trigger="{{ $trigger }}" data-form-id="{{$formId}}" class="confirmation justify-center place-items-center bg-dim hidden" internalClass="bg-light flex flex-col max-w-xl">
    <h2 class="text-center text-xl font-bold">{{$title}}</h2>
    <div class="text-center">{{$slot}}</div>
    <div class="grid grid-cols-3 flex-1 m-8">
        <x-button class="confirmation-back">{{$optionBackText}}</x-button>
        <div></div>
        <x-button level="high" class="confirmation-continue">{{$optionContinueText}}</x-button>
    </div>
</x-popup>
