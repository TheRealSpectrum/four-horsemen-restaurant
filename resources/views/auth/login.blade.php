@extends("layout.app")

@section("content")
    <div class="mx-auto max-w-6xl min-h-screen flex flex-col content-center justify-center">
        <form action="{{route("auth.login")}}" method="post"
            class="flex flex-col content-center justify-center h-24 text-2xl">
            @csrf
            <div class="flex flex-row content-center justify-center gap-6 h-10">
                <label for="email">email</label>
                <input id="email" type="email" name="email" value="{{old("email")}}" class="border border-dark bg-light ">

                <label for="password">password</label>
                <input id="password" type="password" name="password" class="border border-dark bg-light">
            </div>
            <ul>
                @foreach($errors->all() as  $error)
                <li class="text-center text-warning-high">{{$error}}</li>
                @endforeach
            </ul>

            <button type="submit"
                class="my-4 w-32 mx-auto border-dark border-2 ">Login</button>
        </form>
    </div>
@endsection()
