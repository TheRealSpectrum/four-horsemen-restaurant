@extends("layout.app")

@section("content")
    @foreach ($resevations as $item)
        <x-res-item :info="$item"></x-reservation-item>
    @endforeach
@endsection()