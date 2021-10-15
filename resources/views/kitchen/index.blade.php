@extends("layout.kitchen")

@section("kitchen-content")
    <kitchen-app
        orders-route="{{route("kitchen.orders")}}"
        >
    </kitchen-app>
@endsection
