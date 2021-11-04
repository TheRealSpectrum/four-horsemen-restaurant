@if($errors->has($name))
    <select-input
        :value="{{ $value }}"
        label="{{ $label }}"
        name="{{ $name }}"
        error="{{ $errors->first($name) }}"
    ></select-input>
@else
    <select-input
        :value="{{ $value }}"
        label="{{ $label }}"
        name="{{ $name }}"
        error=""
    ></select-input>
@endif
