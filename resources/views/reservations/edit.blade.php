@php
date_default_timezone_set("Europe/Amsterdam");
@endphp

@extends("layout.app")

@section("content")
<div id="app" class="">
    <edit-component  :reservation_data="{{($data)}}" :table_data="{{($tables)}}" :pivot="{{json_encode($pivot)}}"></example-component>

</div>
<script src="{{ mix('/js/app.js') }}"></script>
@endsection()