@extends("layout.management.fields", ["action" => route("management.$managementName.store")])

@section("fields-left")
  @foreach($builder->fieldsLeft as $field)
    <x-management.create-field name="{{$field->column}}" type="{{$field->type}}" label="{{$field->label}}"></x-management>
  @endforeach
@endsection

@section("fields-right")
  @foreach($builder->fieldsRight as $field)
    <x-management.create-field name="{{$field->column}}" type="{{$field->type}}" label="{{$field->label}}"></x-management>
  @endforeach
@endsection

@section("fields-hidden")
  @csrf
@endsection

@section("buttons")
  <a href="{{route("management.$managementName.index")}}" class="block w-full"><x-button class="w-full">Back</x-button></a>
  <x-button level="safe" type="submit">Save</x-button>
@endsection
