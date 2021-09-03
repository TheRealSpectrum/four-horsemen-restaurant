@extends("layout.reservations")

@section("reservations-content")
<div id="main_wrapper" class="grid grid-cols-10 grid-rows-1 gap-5 ">
    <p class="row-start-1 col-span-2">active reservations</p>
    <div id="active_reservations"
        class="row-start-2 col-start-1 col-span-2 flex flex-row flex-wrap border-2 border-black place-content-start">

        @foreach ($active as $item)
            <x-res-item :info="$item"></x-reservation-item>
        @endforeach

    </div>

    <div id="incoming_reservations"
        class="row-start-2 col-start-3 col-span-6 flex flex-col flex-nowrap border-2 border-black place-content-start">

        <p>late reservations</p>
        <div id="late_reservations"
            class="flex flex-row flex-wrap border-2 border-black place-content-start">

            @foreach ($late as $item)
                <x-res-item :info="$item"></x-reservation-item>
            @endforeach

        </div>

        <p>reservations in the next hour</p>
        <div id="upcoming_reservations"
            class="flex flex-row flex-wrap border-2 border-black place-content-start">

            @foreach ($upcoming as $item)
                <x-res-item :info="$item"></x-reservation-item>
            @endforeach

        </div>

    </div>

    <p class="row-start-1 col-start-9 col-span-2">reservations later today</p>  
    <div id="later_reservations"
        class="row-start-2 col-start-9 col-span-2 flex flex-row flex-wrap border-2 border-black place-content-start">

        @foreach ($later as $item)
            <x-res-item :info="$item"></x-reservation-item>
        @endforeach  

    </div>
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
            </div>
        </div>
    </div>
</div>

<x-notifier id="notify-guest-update" trigger="notifyGuestUpdate">
    The reservation status has been updated to: <br>
    arrived
</x-notifier>
<x-notifier id="notify-reservation-cancel" type="warningLow" trigger="notifyReservationCancel">The reservation has been canceled</x-notifier>
<x-confirmation id="confirm-reservation-cancel" type="warningHigh" form="reservation-cancel"
    option-back="No, go back" option-continue="Yes, cancel reservation" title="Cancel the reservation?"/>


@endsection
