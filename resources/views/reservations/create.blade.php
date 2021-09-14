@extends('layout.reservations')

@section('reservations-content')
    <div class="w-1/2 mx-auto border-r border-l pt-3 bg-columnlight" style="height : 90vh">
        <form method="POST" action="{{ route('reservation.store') }}" class="w-full flex flex-col my-3 py-3 space-y-5">
            @csrf
            
            {{-- Tables --}}
            <div id="app" class="mx-auto w-1/2 flex justify-center items-center flex-wrap">
                <table-select-component :reservation_data="{{($data)}}" :table_data="{{($tables)}}" :pivot="{{json_encode($pivot)}}" :date_default="'{{ old('date', today()->format('Y-m-d')) }}'" :date_min="'{{ today()->format('Y-m-d') }}'" :time_default="'{{ old('time', date('H:i')) }}'" :duration_default="{{ old('endTime', 60)}}"></table-select-component>
                @error("table")
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Name --}}
            <div class="mx-auto w-1/2 flex justify-center items-center flex-wrap">
                <label for="name" class="w-1/3 font-bold text-center">Name</label>
                <input id="name" type="text" name="name" placeholder="Name..." class="w-1/2 border p-2 text-center" value="{{ old('name', '') }}" />
                @error('name')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Phone Number --}}
            <div class="mx-auto w-1/2 flex justify-center items-center flex-wrap">
                <label for="phone" class="w-1/3 font-bold text-center">Phone</label>
                <input id="phone" type="tel" name="phone_number" placeholder="phone..." class="w-1/2 border p-2 text-center" value="{{ old('phone_number', '') }}" />
                @error('phone_number')
                    <p class="text-sm text-warning-high">{{ $message }}</p>
                @enderror
            </div>

            {{-- Number of Guests --}}
            <div class="mx-auto w-1/2 flex justify-center items-center flex-wrap">
                <label for="guests" class="w-1/3 font-bold text-center">Number of Guests</label>
                <input id="guests" type="number" min="1" name="guest_count" placeholder="number of guests..." class="w-1/2 border p-2 text-center" value="{{ old('guest_count', '') }}" />
                @error('guest_count')
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

            {{-- Notes --}}
            <div class="mx-auto w-1/2 flex flex-row flex-nowrap justify-center relative">
                <textarea name="notes" cols="16" rows="6" placeholder="notes..." class="w-5/6 border p-2">{{ old('notes', '') }}</textarea>
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
