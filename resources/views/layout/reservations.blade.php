@extends("layout.app")

@section("content")

    <div class="w-full h-20 fixed left-0 top-0
        grid grid-cols-3">
        <div></div>
        <div class="flex flex-row justify-between content-evenly gap-2 px-6 py-6">
            <a href="{{route("reservations.index")}}" class="w-full inline-block"><x-button class="w-full">Today</x-button></a>
            <a href="{{route("reservation.create")}}" class="w-full inline-block"><x-button class="w-full">Create reservation</x-button></a>
            <a href="{{route("reservation.edit")}}" class="w-full inline-block"><x-button class="w-full">All reservations</x-button></a>
        </div>
        <div>
            <form action="{{route("auth.logout")}}" method="post" class="flex flex-row justify-end h-full py-6 px-6">
                @csrf
                <x-button type="submit">Logout</x-button>
            </form>
        </div>

    </div>
    <div class="w-full h-20"></div>

    @yield("reservation-content")

@endsection
