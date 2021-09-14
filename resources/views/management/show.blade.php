Management: show

<div>
    @foreach($columns as $column)
      @php($columnName = $column->name)

      <div>Field: {{ $column->display }}</div>
      <div>Value: {{ $model->$columnName }}</div>

    @endforeach
</div>

<form action="{{ route("management.$managementName.destroy", [$managementParameterName => $model->id]) }}" method="post">
  @csrf
  @method("DELETE")
  <x-button level="warningHigh" type="submit">Delete</x-button>
</form>
