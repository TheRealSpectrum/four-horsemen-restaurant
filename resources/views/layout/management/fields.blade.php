@extends("layout.management")

@section("management-content")
    @isset($action)
        <form method="post" action="{{ $action }}" class="grid grid-cols-8 flex-1 m-6">
    @else
        <div class="grid grid-cols-8 flex-1 m-6">
    @endisset

    <div class="grid grid-cols-2 col-span-7 w-full">
        <div class="flex flex-col gap-4">
            @yield("fields-left")
        </div>
        <div class="flex flex-col gap-4 border-l mx-3">
            @yield("fields-right")
        </div>
    </div>
    <div class="flex flex-col gap-4">
        @yield("buttons")
    </div>

    @yield("fields-hidden")

    @isset($action)
        </form>
    @else
        </div>
    @endisset
@endsection
