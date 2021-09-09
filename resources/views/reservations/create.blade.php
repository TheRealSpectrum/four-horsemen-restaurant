@extends('layout.reservations')

@section('reservations-content')
    <div class="w-1/2 mx-auto min-h-screen border-r border-l pt-3 bg-columnlight">
        <form method="POST" action="{{ route('reservation.store') }}" class="w-full flex flex-col my-3 py-3 space-y-5">
            @csrf

            {{-- Name --}}
            <div class="mx-auto w-1/2 flex justify-center items-center flex-wrap">
                <label for="name" class="w-1/3 font-bold text-center">Name</label>
                <input id="name" type="text" name="name" placeholder="Name..." class="w-1/2 border p-2 text-center" value="{{ old('name', '') }}" />
                @error('name')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Phone Number --}}
            <div class="mx-auto w-1/2 flex justify-center items-cente flex-wrap">
                <label for="phone" class="w-1/3 font-bold text-center">Phone</label>
                <input id="phone" type="tel" name="phone_number" placeholder="phone..." class="w-1/2 border p-2 text-center" value="{{ old('phone_number', '') }}" />
                @error('phone_number')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Number of Guests --}}
            <div class="mx-auto w-1/2 flex justify-center items-center flex-wrap">
                <label for="guests" class="w-1/3 font-bold text-center">Number of Guests</label>
                <input id="guests" type="number" name="guest_count" placeholder="number of guests..." class="w-1/2 border p-2 text-center" value="{{ old('guest_count', '') }}" />
                @error('guest_count')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Date --}}
            <div class="mx-auto w-1/2 flex justify-center items-center flex-wrap">
                <label for="date" class="w-1/3 font-bold text-center">Date</label>
                <input id="date" type="date" name="date" min="{{ today()->format('Y-m-d') }}" class="w-1/2 border p-2 text-center" value="{{ old('date', today()->format('Y-m-d')) }}" />
                @error('date_start')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Time --}}
            <div class="mx-auto w-1/2 flex justify-center items-center flex-wrap">
                <label for="time" class="w-1/3 font-bold text-center">Time</label>
                <input id="time" type="time" min="00:00" max="23:59" name="time" class="w-1/2 border p-2 text-center" value="{{ old('time', date('H:i')) }}" />
                @error('date_start')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
                <select name="endTime" id="endTime">
                    <option value="60" default>+ 1 hour</option>
                    <option value="75">+ 1 hour and 15 minutes</option>
                    <option value="90">+ 1 hour and 30 minutes</option>
                    <option value="105">+ 1 hour and 45 minutes</option>
                    <option value="120">+ 2 hour</option>
                    <option value="135">+ 2 hour and 15 minutes</option>
                    <option value="150">+ 2 hour and 30 minutes</option>
                    <option value="165">+ 2 hour and 45 minutes</option>
                    <option value="180">+ 3 hour</option>
                    <option value="195">+ 3 hour and 15 minutes</option>
                    <option value="210">+ 3 hour and 30 minutes</option>
                    <option value="225">+ 3 hour and 45 minutes</option>
                    <option value="240">+ 4 hour</option>
                </select>                
                @error('date_end')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Event --}}
            <div class="mx-auto w-1/2 flex justify-center items-center flex-wrap">
                <label for="event" class="w-1/3 font-bold text-center">Event</label>
                <input id="event" type="text" name="event_type" placeholder="event..." class="w-1/2 border p-2 text-center" value="{{ old('event_type', '') }}" />
                @error('event_type')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tables --}}
            <div id="app" class="mx-auto w-1/2 flex justify-center items-center flex-wrap">
                <table-select-component :reservation_data="{{($data)}}" :table_data="{{($tables)}}" :pivot="{{json_encode($pivot)}}"></table-select-component>
                @error("table")
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
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
    <script>
        const app = new Vue({
            el: "#app",
        });
    </script>
@endsection
