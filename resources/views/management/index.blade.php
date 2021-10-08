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

    @if($editInline)
      <index-list
        :rows="{{$rows}}"
        :edit-inline="true"
        route-show=""
        route-edit=""
        ></index-list>
    @else
      <index-list
        :rows="{!!$rows!!}"
        :edit-inline="false"
        route-show="{!! route("management.$managementName.show", [$managementParameterName => "___INSERT_ID___"]) !!}"
        route-edit="{!! route("management.$managementName.edit", [$managementParameterName => "___INSERT_ID___"]) !!}"
        ></index-list>
    @endif

    <div class="grid grid-cols-8">
      <div class="col-span-7 h-10">
        {{$models->links('vendor.pagination.tailwind')}}
      </div>
      @if(!$editInline)
      <div class="p-2 h-14">
        <a href="{{ route("management.$managementName.create") }}"><x-button class="font-bold w-full h-full" level="safe">Create</x-button></a>
      </div>
      @endif
    </div>
  </div>
@endsection
