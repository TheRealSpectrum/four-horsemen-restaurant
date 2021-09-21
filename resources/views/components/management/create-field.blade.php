<div class="grid grid-cols-3 h-6">
    <label for="{{$name}}" class="text-lg font-bold">
        {{ $label }}
    </label>
    <input name="{{$name}}" value="{{old($name, $value)}}" type="{{$type}}" class="text-lg"/>
    @if($errors->has($name))
        <div class="font-bold text-warning-high p-1">{{$errors->first($name)}}</div>
    @endif
</div>
