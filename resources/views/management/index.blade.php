@extends("layout.management")

@section("management-content")
  <div class="flex flex-col flex-1 m-6">
    <div class="grid grid-cols-8">
      <div class="col-span-7 h-10 flex flex-row p-4">
        @foreach($builder->columns as $column)
          <div class="flex-1 text-center text-lg font-bold">
            {{ $column->header }}
          </div>
        @endforeach
      </div>
      <div></div>
    </div>
    <div class="grid grid-cols-8 flex-none justify-items-stretch">
      @foreach($models as $model)
      <div class="col-span-7 p-2">

        <a href="{{ route("management.$managementName.show", [$managementParameterName => $model->id]) }}">
          <div class="flex flex-row border-2 border-dark py-2 w-full h-full">
            @foreach($builder->columns as $column)

            <div class="flex-1 text-center">
              {{ $column->map($model) }}
            </div>

            @endforeach
          </div>
        </a>

      </div>
      <div class="p-2">
        <a href="{{ route("management.$managementName.edit", [$managementParameterName => $model->id]) }}"><x-button level="low" class="font-bold h-full w-full">Edit</x-button></a>
      </div>
      @endforeach
    </div>
    <div class="grid grid-cols-8">
      <div class="col-span-7 h-10">
        {{$models->links('vendor.pagination.tailwind')}}
      </div>
      <div class="p-2 h-14">
        <a href="{{ route("management.$managementName.create") }}"><x-button class="font-bold w-full h-full" level="safe">Create</x-button></a>
      </div>
    </div>
  </div>
@endsection
