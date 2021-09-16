@extends("layout.management")

@section("management-content")
  <div class="grid grid-cols-2 flex-1 m-6">
    <div>
      @foreach($builder->fieldsLeft as $field)
        <div class="grid grid-cols-2">
          <div>
            {{$field->label}}
          </div>
          <div>
            {{$field->map($model)}}
          </div>
        </div>
      @endforeach
    </div>
    <div></div>
  </div>
@endsection
