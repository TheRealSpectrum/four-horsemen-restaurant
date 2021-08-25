@php
date_default_timezone_set("Europe/Amsterdam");
@endphp

@extends("layout.app")

@section("content")
@php
    // dd(get_defined_vars());
    // dd(($data));
@endphp
{{-- <p>{{$data}}</p> --}}
<div id="app" class="">
    <edit-component :reservation_data="{{($data)}}"></example-component>

</div>
    {{-- <script>
        var data = JSON.parse({{$data}})
    </script> --}}
<script src="{{ mix('/js/app.js') }}"></script>
@endsection()