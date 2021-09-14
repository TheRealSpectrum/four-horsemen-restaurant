@extends("layout.management")

@section("management-content")
@foreach($models as $model)

  <div>
    @foreach($columns as $column)
      @php($columnName = $column->name)

      <div>Field: {{ $column->display }}</div>
      <div>Value: {{ $model->$columnName }}</div>

    @endforeach
  </div>
  <div>----</div>

@endforeach
@endsection
