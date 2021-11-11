@extends("layout.kitchen")

@section("kitchen-content")
    <kitchen-app
        orders-route="{{$type === "dishes" ? route("kitchen.orders") : route("kitchen.orders2")}}"
        complete-route="{{$type === "dishes" ? route("kitchen.closeCourse", ["course" => "___INSERT_ID___"]) : route("kitchen.closeCourse", ["course" => "___INSERT_ID___"])}}"
        >
    </kitchen-app>
@endsection
