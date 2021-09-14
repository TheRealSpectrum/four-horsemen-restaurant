@extends("layout.management")

@section("management-content")
  <div class="flex flex-col flex-1 m-6">
    <div class="grid grid-cols-8">
      <div class="col-span-7 h-10 flex flex-row p-4">
        @foreach($columns as $column)
          <div class="flex-1 text-center text-lg font-bold">
            {{ $column->display }}
          </div>
        @endforeach
      </div>
      <div></div>
    </div>
    <div class="grid grid-cols-8 flex-1 justify-items-stretch">
      @foreach($models as $model)
      <div class="col-span-7 p-4">

          <div class="flex flex-row border-2 border-dark py-2">
          @foreach($columns as $column)
            @php($columnName = $column->name)

            <div class="flex-1 text-center text-lg">
              {{ $model->$columnName }}
            </div>

          @endforeach
          </div>

      </div>
      <div class="p-4">
        <a href="{{ route("management.$managementName.edit", [$managementParameterName => $model->id]) }}"><x-button level="low" class="text-lg font-bold h-full w-full">Edit</x-button></a>
      </div>
      @endforeach
    </div>
    <div class="grid grid-cols-8">
      <div class="col-span-7 h-10"></div>
      <div></div>
    </div>
  </div>
@endsection
