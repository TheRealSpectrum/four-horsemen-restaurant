@extends("layout.app")

@section("content")

    <div id="app">
        <div class="w-full h-20 fixed left-0 top-0 grid grid-cols-6">

            <div class="flex flex-row justify-between content-evenly gap-2 px-6 py-6 col-span-5">
                @foreach(config("management.navigation") as $navigationItem)
                    @if($navigationItem[1] === "")
                        <x-button level="nav" class="w-full">
                            {{$navigationItem[0]}}
                        </x-button>
                        @continue
                    @endif
                    <a href="{{route("management.{$navigationItem[1]}.index")}}" class="w-full inline-block">
                        @if(str_starts_with(Route::currentRouteName(), "management.{$navigationItem[1]}"))
                        <x-button level="nav-current" class="w-full">
                            {{$navigationItem[0]}}
                        </x-button>
                        @else
                        <x-button level="nav" class="w-full">
                            {{$navigationItem[0]}}
                        </x-button>
                        @endif
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

        <div class="management-root bg-columnlight flex items-stretch">
            @yield("management-content")
        </div>
    </div>

    <script src="{{ mix('/js/app.js') }}"></script>
    <script>
        const app = new Vue({
            el: "#app",
        });
    </script>

@endsection
