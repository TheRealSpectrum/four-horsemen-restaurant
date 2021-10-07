@extends('layout.reservations')

@section('reservations-content')
    <div class="w-1/2 mx-auto border-r border-l pt-3 bg-columnlight" style="height : 90vh">
        <form method="POST" action="{{ route('reservation.store') }}" class="w-full flex flex-col my-3 py-3 space-y-5">
            @csrf

            <input type="hidden" name="active" value="1" />
            <input type="hidden" name="guest_count" value="1" />
            <input type="hidden" name="name" value="J. Doe" />
            <input type="hidden" name="phone_number" value="0000000000" />

            
            {{-- Date, Time and Tables --}}
            <div id="app" class="mx-auto w-1/2 flex justify-center items-center flex-wrap relative">
                <table-select-component :reservation_data="{{($data)}}" :table_data="{{($tables)}}" :pivot="{{json_encode($pivot)}}" :date_default="'{{ old('date', today()->format('Y-m-d')) }}'" :date_min="'{{ today()->format('Y-m-d') }}'" :time_default="'{{ old('time', date('H:i')) }}'" :duration_default="{{ old('endTime', 60)}}" :selected-i-d="'{{old('id')}}'"
                    @if(old('table'))
                    :table-old="'{{old('table')}}'"
                    @else
                    :table-old="'none'"
                    @endif
                ></table-select-component>
                @error("table")
                    <label class="text-sm text-center border w-1/3 bg-light text-warning-high absolute bottom-0 -right-1/2">{{ $message }}</label>
                @enderror
            </div>


            {{-- Event --}}
            <div class="mx-auto w-1/2 flex justify-center items-center flex-nowrap relative">
                <label for="event" class="w-1/3 font-bold text-center">Event</label>
                <input id="event" type="text" name="event_type" placeholder="event..." class="w-1/2 border p-2 text-center" value="{{ old('event_type', '') }}" />
                @error('event_type')
                    <label class="text-sm text-center border w-1/3 bg-light text-warning-high absolute -right-1/2">{{ $message }}</label>
                @enderror
            </div>

            {{-- Notes --}}
            <div class="mx-auto w-1/2 flex flex-row flex-nowrap justify-center relative">
                <textarea name="notes" cols="16" rows="6" placeholder="notes..." class="w-5/6 border p-2">{{ old('notes', '') }}</textarea>
                @error('notes')
                    <label class="text-sm text-center border w-1/3 bg-light text-warning-high absolute -right-1/2">{{ $message }}</label>
                @enderror
                {{-- Save --}}
                <div class="absolute bottom-0 -right-20 flex flex-col gap-5">
                    <label class="border border-textblack rounded-lg select-none p-1" >notify<br>kitchen <input type="checkbox" name="notify_kitchen" id="notify_kitchen" value="1"></label>
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
