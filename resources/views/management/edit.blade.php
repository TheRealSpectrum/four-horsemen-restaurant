@extends("layout.management.fields", ["action" => route("management.$managementName.update", [$managementParameterName => $model->id])])

@section("fields-left")
  @foreach($builder->fieldsLeft as $field)
    <x-management.create-field name="{{$field->column}}" type="{{$field->type}}" label="{{$field->label}}" value="{{$field->mapColumn($model)}}"></x-management>
  @endforeach
@endsection

@section("fields-right")
  @foreach($builder->fieldsRight as $field)
    <x-management.create-field name="{{$field->column}}" type="{{$field->type}}" label="{{$field->label}}" value="{{$field->mapColumn($model)}}"></x-management>
  @endforeach
@endsection

@section("fields-hidden")
  @csrf
  @method("PATCH")
@endsection

@section("buttons")
  <a href="{{route("management.$managementName.show", [$managementParameterName => $model->id])}}" class="block w-full"><x-button class="w-full">Back</x-button></a>
  <x-button level="safe" type="submit">Save</x-button>
@endsection
