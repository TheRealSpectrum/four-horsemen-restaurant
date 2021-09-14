Management: edit

<form action="{{route("management.$managementName.update", [$managementParameterName => $model->id])}}" method="post">
  @csrf
  @method("PATCH")

  @foreach($columns as $column)
    @php($columnName = $column->name)

    <div>
      <label for="{{$column->name}}">{{ $column->display }}</label>
      <input id="" type="{{$column->type}}" name="{{$column->name}}" value="{{$model->$columnName}}">
    </div>
  @endforeach

  <x-button type="submit">Update dish</x-button>
</form>
