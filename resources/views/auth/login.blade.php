@extends("layout.app")

@section("content")
    <form action="{{route("auth.login")}}" method="post">
        @csrf
        <label for="email"></label>
        <input id="email" type="email" name="email">

        <label for="password"></label>
        <input id="password" type="password" name="password">

        <button type="submit">Login</button>
    </form>
@endsection()
