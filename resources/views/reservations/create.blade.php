@extends('layout.app')

@section('content')
    <div class="w-1/2 mx-auto min-h-screen border-r border-l pt-3">
        <form method="POST" action="{{ route('reservation.store') }}" class="w-full flex flex-col my-3 py-3 space-y-5">
            @csrf

            {{-- Name --}}
            <div class="mx-auto w-1/2 flex justify-center items-center">
                <label for="name" class="w-1/3 font-bold text-center">Name</label>
                <input id="name" type="text" name="name" placeholder="Name..." class="w-1/2 border p-2 text-center" value="{{ old('name', '') }}" />
                @error('name')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Phone Number --}}
            <div class="mx-auto w-1/2 flex justify-center items-center">
                <label for="phone" class="w-1/3 font-bold text-center">Phone</label>
                <input id="phone" type="tel" name="phone_number" placeholder="phone..." class="w-1/2 border p-2 text-center" value="{{ old('phone_number', '') }}" />
                @error('phone_number')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Number of Guests --}}
            <div class="mx-auto w-1/2 flex justify-center items-center">
                <label for="guests" class="w-1/3 font-bold text-center">Number of Guests</label>
                <input id="guests" type="number" name="guest_count" placeholder="amount of guests..." class="w-1/2 border p-2 text-center" value="{{ old('guest_count', '') }}" />
                @error('guest_count')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Date --}}
            <div class="mx-auto w-1/2 flex justify-center items-center">
                <label for="date" class="w-1/3 font-bold text-center">Date</label>
                <input id="date" type="date" name="date" class="w-1/2 border p-2 text-center" value="{{ old('date', '') }}" />
                @error('date')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Time --}}
            <div class="mx-auto w-1/2 flex justify-center items-center">
                <label for="time" class="w-1/3 font-bold text-center">Time</label>
                <input id="time" type="time" min="00:00" max="23:59" name="time" class="w-1/2 border p-2 text-center" value="{{ old('time', '') }}" />
                @error('time')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Event --}}
            <div class="mx-auto w-1/2 flex justify-center items-center">
                <label for="event" class="w-1/3 font-bold text-center">Event</label>
                <input id="event" type="text" name="event_type" class="w-1/2 border p-2 text-center" value="{{ old('event_type', '') }}" />
                @error('event_type')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tables --}}
            <div id="app">
                <table-select-component :reservation_data="{{($data)}}" :table_data="{{($tables)}}" :pivot="{{json_encode($pivot)}}"></table-select-component>
            </div>

            {{-- Notes --}}
            <div class="mx-auto w-1/2 flex flex-row flex-nowrap justify-center relative">
                <textarea name="notes" cols="12" rows="8" placeholder="notes..." class="w-5/6 border p-2">{{ old('notes', '') }}</textarea>
                @error('notes')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
                {{-- Save --}}
                <div class="absolute bottom-0 -right-20">
                    <button type="submit" class="bg-save border rounded w-min px-5 py-2">Save</button>
                </div>
            </div>
        </form>

        {{-- graph goes here? --}}
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
@endsection