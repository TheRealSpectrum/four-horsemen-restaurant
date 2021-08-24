@extends('layout.app')

@section('content')
    <div class="w-1/2 mx-auto">
        <form>
            <label for="name">Name</label>
            <input id="name" type="text" />

            <label for="phone">Phone</label>
            <input id="phone" type="tel" />

            <label for="guests">Number of Guests</label>
            <input id="guests" type="number" />

            <label for="date">Date</label>
            <input id="date" type="date" />
            
            <label for="time">Time</label>
            <input id="time" type="datetime" />

            <label for="event">Event</label>
            <input id="event" type="text" />

            <label for="tables">Tables</label>
            <input id="tables" type="text" />

            <textarea placeholder="notes..."></textarea>

            <button type="submit" >Save</button>
        </form>

        {{-- graph goes here? --}}
    </div>
@endsection