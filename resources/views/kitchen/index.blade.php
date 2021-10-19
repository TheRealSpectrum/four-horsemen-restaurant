@extends("layout.kitchen")

@section("kitchen-content")
    <kitchen-app
        orders-route="{{route("kitchen.orders")}}"
        complete-route="{{route("kitchen.closeCourse", ["course" => "___INSERT_ID___"])}}"
        >
    </kitchen-app>
@endsection
