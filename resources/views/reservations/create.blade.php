@extends('layout.app')

@section('content')
    <div class="w-1/2 mx-auto min-h-screen border-r-2 border-l-2">
        <form method="POST" action="{{ route('reservation.store') }}" class="w-full ">
            @csrf

            {{-- Name --}}
            <div>
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name', '') }}" />
                @error('name')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Phone Number --}}
            <div>
                <label for="phone">Phone</label>
                <input id="phone" type="tel" name="phone_number" value="{{ old('phone_number', '') }}" />
                @error('phone_number')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Number of Guests --}}
            <div>
                <label for="guests">Number of Guests</label>
                <input id="guests" type="number" name="guest_count" value="{{ old('guest_count', '') }}" />
                @error('guests_count')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Date --}}
            <div>
                <label for="date">Date</label>
                <input id="date" type="date" name="date" value="{{ old('date', '') }}" />
                @error('date')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Time --}}
            <div>
                <label for="time">Time</label>
                <input id="time" type="time" min="00:00" max="23:59" name="time" value="{{ old('time', '') }}" />
                @error('time')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Event --}}
            <div>
                <label for="event">Event</label>
                <input id="event" type="text" name="event_type" value="{{ old('event_type', '') }}" />
                @error('event_type')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tables --}}
            <div>
                <label for="tables">Tables</label>
                <input id="tables" type="text" name="tables" value="{{ old('tables', '') }}" />
                @error('tables')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Notes --}}
            <div>
                <textarea name="notes" placeholder="notes...">{{ old('notes', '') }}</textarea>
                @error('notes')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>
            {{-- Save --}}
            <div>
                <button type="submit" class="bg-save border-2 rounded w-min px-3">Save</button>
            </div>
        </form>

        {{-- graph goes here? --}}
    </div>
@endsection