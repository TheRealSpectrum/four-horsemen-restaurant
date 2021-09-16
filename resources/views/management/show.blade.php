@extends("layout.management")

@section("management-content")
  <div class="grid grid-cols-2 flex-1 m-6">
    <div class="flex flex-col gap-4">
      @foreach($builder->fieldsLeft as $field)
        <x-management.show-field label="{{$field->label}}" value="{{$field->map($model)}}"></x-management>
      @endforeach
    </div>
    <div></div>
  </div>
@endsection
