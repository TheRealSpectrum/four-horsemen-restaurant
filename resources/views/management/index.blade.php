@extends("layout.management")

@section("management-content")
  <div class="flex flex-col flex-1 m-6">
    <div class="grid grid-cols-8">
      <div class="col-span-7 h-10 flex flex-row p-4">
        @foreach($editInline ? $builder->inlineColumns : $builder->columns as $column)
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
        route-update="{!! route("management.$managementName.update", [$managementParameterName => "___INSERT_ID___"]) !!}"
        :column-names="{!! $columnNames !!}"
        :column-input-types="{!! $columnInputTypes !!}"
        :edit-last="{{Request::input("edit-last", "0") === "1" ? "true" : "false"}}"
        ></index-list>
    @else
      <index-list
        :rows="{!!$rows!!}"
        :edit-inline="false"
        route-show="{!! route("management.$managementName.show", [$managementParameterName => "___INSERT_ID___"]) !!}"
        route-edit="{!! route("management.$managementName.edit", [$managementParameterName => "___INSERT_ID___"]) !!}"
        route-update="{!! route("management.$managementName.update", [$managementParameterName => "___INSERT_ID___"]) !!}"
        :column-names="{!! $columnNames !!}"
        ></index-list>
    @endif

    <div class="grid grid-cols-8">
      <div class="col-span-7 h-10">
        {{$models->links('vendor.pagination.tailwind')}}
      </div>
      @if($editInline)
        <index-new
          route-index="{!! route("management.$managementName.index") !!}"
          route-store="{!! route("management.$managementName.store") !!}"
          page-after-create="{{$pageAfterCreate}}"
          :column-data="{id: 28, seat_count: 1}"
          >Create</index-new>
      @else
      <div class="p-2 h-14">
        <a href="{{ route("management.$managementName.create") }}"><x-button class="font-bold w-full h-full" level="safe">Create</x-button></a>
      </div>
      @endif
    </div>
  </div>
@endsection
