<button {{$attributes}} type="{{$buttonType}}" class="{{$additionalClasses}} border-2 border-dark rounded">
    <div class="hover:bg-button-dim w-full h-full p-1 flex flex-col justify-center">
        <div>
            {{$slot}}
        </div>
    </div>
</button>
