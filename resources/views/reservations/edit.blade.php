@php
date_default_timezone_set("Europe/Amsterdam");
@endphp

@extends("layout.reservations")

@section("reservations-content")
@if($errors->any())
{{-- {{ dd(Request()) }} --}}
    <div class="bg-light">
        <ul>
            @foreach($errors->all() as $error)
                <li class="text-sm text-warning-high">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="app" class="search">
    <edit-component  :reservation_data="{{($data)}}" :table_data="{{($tables)}}" :pivot="{{json_encode($pivot)}}"></example-component>

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
            

            {{-- Date and Time --}}
            <div>
                <label>Date
                    <input type="date" name="date" min="{{ today()->format('Y-m-d') }}" value="{{ old('date', today()->format('Y-m-d')) }}" class="border" />
                </label>
                @error('date_start')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label>Time
                    <input type="time" min="00:00" max="23:59" name="time" value="{{ old('time', date('H:i')) }}" class="border" />
                </label>
                @error('date_start')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
                <select name="endTime" id="endTime">
                    <option value="60" {{ old('endTime') == '60' ? 'selected' : '' }}>+ 1 hour</option>
                    <option value="75" {{ old('endTime') == '75' ? 'selected' : '' }}>+ 1 hour and 15 minutes</option>
                    <option value="90" {{ old('endTime') == '90' ? 'selected' : '' }}>+ 1 hour and 30 minutes</option>
                    <option value="105" {{ old('endTime') == '105' ? 'selected' : '' }}>+ 1 hour and 45 minutes</option>
                    <option value="120" {{ old('endTime') == '120' ? 'selected' : '' }}>+ 2 hour</option>
                    <option value="135" {{ old('endTime') == '135' ? 'selected' : '' }}>+ 2 hour and 15 minutes</option>
                    <option value="150" {{ old('endTime') == '150' ? 'selected' : '' }}>+ 2 hour and 30 minutes</option>
                    <option value="165" {{ old('endTime') == '165' ? 'selected' : '' }}>+ 2 hour and 45 minutes</option>
                    <option value="180" {{ old('endTime') == '180' ? 'selected' : '' }}>+ 3 hour</option>
                    <option value="195" {{ old('endTime') == '195' ? 'selected' : '' }}>+ 3 hour and 15 minutes</option>
                    <option value="210" {{ old('endTime') == '210' ? 'selected' : '' }}>+ 3 hour and 30 minutes</option>
                    <option value="225" {{ old('endTime') == '225' ? 'selected' : '' }}>+ 3 hour and 45 minutes</option>
                    <option value="240" {{ old('endTime') == '240' ? 'selected' : '' }}>+ 4 hour</option>
                </select>                
                @error('date_end')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tables --}}
            <div id="error">
                <table-select-component :reservation_data="{{($data)}}" :table_data="{{($tables)}}" :pivot="{{json_encode($pivot)}}"></table-select-component>
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
</script>
@endsection()
