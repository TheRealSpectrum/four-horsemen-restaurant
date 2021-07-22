@extends("layout.app")

@section("content")

    @auth
        <form action="{{ route("auth.logout") }}" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <a href="{{ route("auth.login") }}">Login</a>
    @endauth

@endsection
