@extends("layout.management.fields", ["action" => route("management.$managementName.store")])

@section("fields-left")
  @csrf
  @foreach($builder->fieldsLeft as $field)
    <x-management.create-field name="{{$field->column}}" type="{{$field->type}}" label="{{$field->label}}"></x-management>
  @endforeach
@endsection

@section("fields-right")
  @foreach($builder->fieldsRight as $field)
    <x-management.create-field name="{{$field->column}}" type="{{$field->type}}" label="{{$field->label}}"></x-management>
  @endforeach
@endsection
