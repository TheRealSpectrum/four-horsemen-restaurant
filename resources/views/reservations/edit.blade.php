@php
date_default_timezone_set("Europe/Amsterdam");
@endphp

@extends("layout.reservations")

@section("reservations-content")
{{-- @if($errors->any())
    <div class="bg-light">
        <ul>
            @foreach($errors->all() as $error)
                <li class="text-sm text-warning-high">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="app" class="search">
    <edit-component  :reservation_data="{{($data)}}" :table_data="{{($tables)}}" :pivot="{{json_encode($pivot)}}" @if($errors->any()):errors="{{'true'}}"@endif></example-component>
</div>


@if($errors->any())
    <x-confirmation id="show-validation-errors" type="warningHigh" option-back="Go back" option-continue="Save" title="Please fill in the form correctly." form="show-validation-errors-form" trigger="showValidationErrors">
        <form id="show-validation-errors-form" action="/update" method="POST">
            @csrf
            @method("PATCH")
            <input type="hidden" name="action" value="update" />
            
            {{-- ID --}}
            <input type="hidden" value="{{ old('id') }}" name="id" readonly />
            
            {{-- Phone --}}
            <div>
                <label>Phone
                    <input type="tel" name="phone_number" value="{{ old('phone_number', '') }}" class="border" />
                </label>
                @error("phone_number")
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Name --}}
            <div>
                <label>Name
                    <input type="text" name="name" value="{{ old('name', '') }}" class="border" />
                </label>
                @error("name") 
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Guest Count --}}
            <div>
                <label>Number of guests
                    <input type="number" name="guest_count" value="{{ old('guest_count', '') }}" class="border" />
                </label>
                @error("guest_count")
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Event --}}
            <div>
                <label>Event
                    <input type="text" name="event_type" value="{{ old('event_type', '') }}" class="border" />
                </label>
                @error("event_type")
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Date ,Time and Tables --}}
            <div id="error">
                <table-select-component :reservation_data="{{($data)}}" :table_data="{{($tables)}}" :pivot="{{json_encode($pivot)}}" :date_default="'{{ old('date', today()->format('Y-m-d')) }}'" :date_min="'{{ today()->format('Y-m-d') }}'" :time_default="'{{ old('time', date('H:i')) }}'" :duration_default="{{ old('endTime', 60)}}" :selected-id="'{{old('id')}}'"
                    @if(old('table'))
                    :table-old="'{{old('table')}}'"
                    @else
                    :table-old="'none'"
                    @endif
                    ></table-select-component>
                @error("table")
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>
            

            {{-- Notes --}}
            <div>
                <textarea name="notes" cols="12" rows="8" class="border">{{ old('notes', '') }}</textarea>
                @error('notes')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

        </form>
    </x-confirmation>
@endif
<script src="{{ mix('/js/app.js') }}"></script>
<script>
    const app = new Vue({
        el: "#app",
    });
    const errReturn = new Vue({
        el: "#error",
    });
    if(document.querySelector('button.confirmation-back')){
        document.querySelector('button.confirmation-back').addEventListener('click',(e)=>{
            Array.from(document.getElementById('show-validation-errors').children).forEach(element=>{
                element.remove()
            })
        })
    }
</script>
@endsection()
