@extends("layout.app")

@section("content")
<div>
  <ul class="list-none text-mono-darker flex flex-col items-center p-12 gap-4 text-5xl">
    <li class="w-96"><a href="{{route("reservations.index")}}" class="w-full block"><x-button level="nav" class="w-full">Reservations</x-button></a></li>
    <li class="w-96"><a href="{{route("order.index")}}" class="w-full block"><x-button level="nav" class="w-full">Order</x-button></a></li>
    <li class="w-96"><a href="{{route("kitchen.index")}}" class="w-full block"><x-button level="nav" class="w-full">Kitchen</x-button></a></li>
    <li class="w-96"><a href="{{route("management.employees.index")}}" class="w-full block"><x-button level="nav" class="w-full">Management</x-button></a></li>
  </ul>
</div>
@endsection
