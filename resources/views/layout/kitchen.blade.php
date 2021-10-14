@extends("layout.app")

@section("content")
    <div id="app">
        @yield("kitchen-content")
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script>
        const app = new Vue({
            el: "#app",
        });
    </script>
@endsection
