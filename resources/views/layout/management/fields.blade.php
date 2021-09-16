@extends("layout.management")

@section("management-content")
    @isset($action)
        <form method="post" action="{{ $action }}" class="grid grid-cols-2 flex-1 m-6">
    @else
        <div class="grid grid-cols-2 flex-1 m-6">
    @endisset

    <div class="flex flex-col gap-4">
        @yield("fields-left")
    </div>
    <div>
        @yield("fields-right")
    </div>

    @isset($action)
        </form>
    @else
        </div>
    @endisset
@endsection
