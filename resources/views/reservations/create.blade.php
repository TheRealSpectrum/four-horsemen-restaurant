@extends('layout.app')

@section('content')
    <div class="w-1/2 mx-auto min-h-screen border-r-2 border-l-2">
        <form method="POST" action="{{ route('reservation.store') }}" class="w-full ">
            @csrf

            {{-- Name --}}
            <div>
                <label for="name">Name</label>
                <input id="name" type="text" name="name" />
            </div>

            {{-- Phone Number --}}
            <div>
                <label for="phone">Phone</label>
                <input id="phone" type="tel" name="phone_number" />
            </div>

            {{-- Number of Guests --}}
            <div>
                <label for="guests">Number of Guests</label>
                <input id="guests" type="number" name="guest_count" />
            </div>

            {{-- Date --}}
            <div>
                <label for="date">Date</label>
                <input id="date" type="date" name="date" />
            </div>
            
            {{-- Time --}}
            <div>
                <label for="time">Time</label>
                <input id="time" type="time" min="00:00" max="23:59" name="time" />
            </div>

            {{-- Event --}}
            <div>
                <label for="event">Event</label>
                <input id="event" type="text" name="event_type" />
            </div>

            {{-- Tables --}}
            <div id="app">
                <table-select-component :reservation_data="{{($data)}}" :table_data="{{($tables)}}" :pivot="{{json_encode($pivot)}}"></table-select-component>
            </div>

            {{-- Notes --}}
            <textarea name="notes" placeholder="notes..."></textarea>

            {{-- Save --}}
            <button type="submit" class="bg-save border-2 rounded w-min px-3">Save</button>
        </form>

        {{-- graph goes here? --}}
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
@endsection