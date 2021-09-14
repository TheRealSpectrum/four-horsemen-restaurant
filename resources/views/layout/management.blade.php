@extends("layout.app")

@section("content")

    <div class="w-full h-20 fixed left-0 top-0 grid grid-cols-6">

        <div class="flex flex-row justify-between content-evenly gap-2 px-6 py-6 col-span-5">
            @foreach(config("management.navigation") as $navigationItem)
                <a href="{{route("management.{$navigationItem[1]}.index")}}" class="w-full inline-block">
                    <x-button level="nav" class="w-full">
                        {{$navigationItem[0]}}
                    </x-button>
                </a>
            @endforeach
        </div>
        <div>
            <form action="{{route("auth.logout")}}" method="post" class="flex flex-row justify-end h-full py-6 px-6">
                @csrf
                <x-button type="submit" level="nav">Logout</x-button>
            </form>
        </div>

    </div>
    <div class="w-full h-20"></div>

    <div class="bg-columnlight">
        @yield("management-content")
    </div>

@endsection
