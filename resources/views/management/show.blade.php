@extends("layout.management.fields")

@section("fields-left")
  @foreach($builder->fieldsLeft as $field)
    <x-management.show-field label="{{$field->label}}" value="{{$field->map($model)}}"></x-management>
  @endforeach
@endsection

@section("fields-right")
  @foreach($builder->fieldsRight as $field)
    <x-management.show-field label="{{$field->label}}" value="{{$field->map($model)}}"></x-management>
  @endforeach
@endsection

@section("buttons")
  <x-button>Back</x-button>
  <x-button level="low">Edit</x-button>
  <x-button level="high">Delete</x-button>
@endsection
