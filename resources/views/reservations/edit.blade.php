@php
date_default_timezone_set("Europe/Amsterdam");
@endphp

@extends("layout.reservations")

@section("reservations-content")
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="app" class="search">
    <edit-component  :reservation_data="{{($data)}}" :table_data="{{($tables)}}" :pivot="{{json_encode($pivot)}}"></example-component>

</div>
<script src="{{ mix('/js/app.js') }}"></script>
<script>
    const app = new Vue({
        el: "#app",
    });
</script>
@endsection()
