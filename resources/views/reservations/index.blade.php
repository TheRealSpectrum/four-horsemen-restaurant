@extends("layout.reservations")

@section("reservations-content")
@php
    $configuredAutoRefreshTimer = 30
@endphp
<div id="main_wrapper" class="grid grid-cols-4 grid-rows-1 gap-5 p-10 bg-backgrounddark" style="height:91vh">

    <x-reservation-tab class="h-full col-start-1 col-span-1" title="Active Reservations">
        @foreach ($active as $item)
        {{-- @dd($item) --}}
            <x-res-item :info="$item"></x-reservation-item>
        @endforeach
    </x-reservation-tab>

    <x-reservation-tab class="h-full col-start-2 col-span-2" columns="2" title="This Hour">
            @foreach ($late as $item)
                <x-res-item :info="$item"></x-reservation-item>
            @endforeach

            @foreach ($upcoming as $item)
                <x-res-item :info="$item"></x-reservation-item>
            @endforeach
    </x-reservation-tab>

    <x-reservation-tab class="col-start-4 col-span-1" title="Later this day">
        @foreach ($later as $item)
            <x-res-item :info="$item"></x-reservation-item>
        @endforeach  
    </x-reservation-tab>
</div>
<div id="show-box-root" data-show-box-json="{{App\Models\Reservation::formatCollectionForJavascript($reservations)}}"
    class="fixed w-screen h-screen inset-0 p-52 bg-dim hidden">

    <div class="bg-light w-full h-full border-2 border-dark p-4 dark:border-light dark:bg-dark">
        <h1 class="mx-auto text-center text-4xl font-bold">reservation information</h1>

        <div class="flex flex-row justify-end h-full items-stretch">
            <div id="reservation-data" 
                class="flex flex-col gap-6 pt-6">
                <div class="ml-32 grid grid-cols-5">
                    <p class="text-2xl font-bold w-30 text-right pr-4 row-span-1">Name:</p>
                    <p data-show-box-display="name" class="show-box-display text-2xl text-dark-gray row-span-4 dark:text-light-gray"></p>
                </div>
                <div class="ml-32 grid grid-cols-5">
                    <p class="text-2xl font-bold w-30 text-right pr-4 row-span-1">Number of guests:</p>
                    <p data-show-box-display="guestCount" class="show-box-display text-2xl text-dark-grey row-span-5"></p>
                </div>
                <div class="ml-32 grid grid-cols-5">
                    <p class="text-2xl font-bold w-30 text-right pr-4 row-span-1">Day:</p>
                    <p data-show-box-display="dateStart" class="show-box-display text-2xl text-dark-grey row-span-5"></p>
                </div>
                <div class="ml-32 grid grid-cols-5">
                    <p class="text-2xl font-bold w-30 text-right pr-4 row-span-1">Starting time:</p>
                    <p data-show-box-display="timeStart" class="show-box-display text-2xl text-dark-grey row-span-5"></p>
                </div>
                <div class="ml-32 grid grid-cols-5">
                    <p class="text-2xl font-bold w-30 text-right pr-4 row-span-1">Has arrived:</p>
                    <p data-show-box-display="active" class="show-box-display text-2xl text-dark-grey row-span-5"></p>
                </div>
                <div class="ml-32 grid grid-cols-5">
                    <p class="text-2xl font-bold w-30 text-right pr-4 row-span-1">Event:</p>
                    <p data-show-box-display="eventType" class="show-box-display text-2xl text-dark-grey row-span-5"></p>
                </div>
            </div>

            <div class="flex flex-col h-full gap-6 w-60 items-stretch">
                <x-button id="show-box-close">Back to index</x-button>
                <form action="/update" method="POST">
                    @csrf
                    @method("PATCH")
                    <input type="hidden" name="action" value="activate">
                    <input class="show-box-insert-id" type="hidden" name="id" value="">
                    <x-button class="w-full" type="submit" level="low">Guest arrived</x-button>
                </form>
                <form action="/update" method="POST" id="reservation-cancel">
                    @csrf
                    @method("PATCH")
                    <input type="hidden" name="action" value="cancel">
                    <input class="show-box-insert-id" type="hidden" name="id" value="">
                    <x-button level="high" data-confirmation-id="confirm-reservation-cancel" class="confirmation-trigger w-full">Cancel reservation</x-button>
                </form>
                <form action="/update" method="POST">
                    @csrf
                    @method("PATCH")
                    <input type="hidden" name="action" value="done">
                    <input class="show-box-insert-id" type="hidden" name="id" value="">
                    <x-button level="low" type="submit" class="w-full">Guest is done</x-button>
                </form>
            </div>
        </div>
    </div>
</div>

<x-notifier id="notify-guest-update" trigger="notifyGuestUpdate">
    The reservation status has been updated to: <br>
    arrived
</x-notifier>
<x-notifier id="notify-guest-done" trigger="notifyGuestDone">
    The reservation status has been updated to: <br>
    done
</x-notifier>
<x-notifier id="notify-reservation-cancel" type="warningLow" trigger="notifyReservationCancel">The reservation has been canceled</x-notifier>
<x-confirmation id="confirm-reservation-cancel" type="warningHigh" form="reservation-cancel"
    option-back="No, go back" option-continue="Yes, cancel reservation" title="Cancel the reservation?"/>

<script>
    let load = new Date()
    let timeout = setInterval(reload,10000,load)
    

    function reload(load){
        if(checkTime(load) && document.getElementById("show-box-root").classList.contains("hidden")){
        // location.reload()
        window.location = window.location.pathname
    }
    }

    function checkTime(load){
        let dif = (new Date()).getTime() - load.getTime()
        if(Math.round(dif/1000) > {{$configuredAutoRefreshTimer}}){
            return true
        }
        return false
    }
</script>

@endsection
