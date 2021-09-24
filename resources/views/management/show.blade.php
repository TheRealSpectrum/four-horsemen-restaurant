@extends("layout.management.fields")

@section("fields-left")
  @foreach($builder->fieldsLeft as $field)
    <x-management.show-field type="{{$field->type}}" label="{{$field->label}}" value="{{$field->map($model)}}"></x-management>
  @endforeach
@endsection

@section("fields-right")
  @foreach($builder->fieldsRight as $field)
    <x-management.show-field type="{{$field->type}}" label="{{$field->label}}" value="{{$field->map($model)}}"></x-management>
  @endforeach
@endsection

@section("buttons")
  <a href="{{ route("management.$managementName.index") }}"><x-button class="w-full h-full">Back</x-button></a>
  <a href="{{ route("management.$managementName.edit", [$managementParameterName => $model->id]) }}"><x-button level="low" class="w-full h-full">Edit</x-button></a>
  <form action="{{ route("management.$managementName.destroy", [$managementParameterName => $model->id]) }}" method="post" class="w-full">
    @csrf
    @method("DELETE")
    <x-button type="submit" level="high" class="w-full h-full">Delete</x-button>
  </form>
@endsection
