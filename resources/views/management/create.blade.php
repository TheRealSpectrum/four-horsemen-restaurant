Management: create

<form action="{{route("management.$managementName.store")}}" method="post">
  @csrf

  @foreach($columns as $column)
    <div>
      <label for="{{$column->name}}">{{ $column->display }}</label>
      <input id="" type="{{$column->type}}" name="{{$column->name}}">
    </div>
  @endforeach

  <x-button type="submit">Create dish</x-button>
</form>
