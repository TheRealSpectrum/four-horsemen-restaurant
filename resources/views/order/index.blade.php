@extends("layout.order")

@section("order-content")
    <div id="app">
        <order-app
        :reservation_data="{{$reservations}}"
        :table_data="{{$tables}}"
        :dish_data="{{$dishes}}"
        :drink_data="{{$drinks}}"
        >
        </order-app>
    </div>

    <script src="{{ mix('/js/app.js') }}"></script>
    <script>
        const app = new Vue({
            el: "#app",
        });
    </script>

@endsection
