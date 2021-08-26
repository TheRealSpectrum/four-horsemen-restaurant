<template>
    <div class="container border border-current">
        <div class="search">
            <label
                >reservation id<input
                    type="text"
                    name="id"
                    id="searchID"
                    placeholder="reservation id"
                    v-model="searchID"
                    value=""
            /></label>
            <label
                >phone number<input
                    type="text"
                    name="phone"
                    id="searchPhone"
                    placeholder="Phone Number"
                    v-model="searchPhone"
                    value=""
            /></label>
            <label
                >guest name<input
                    type="text"
                    name="name"
                    id="searchName"
                    placeholder="Guest Name"
                    v-model="searchName"
                    value=""
            /></label>
            <label id="searchDate"
                >date<input
                    type="date"
                    name="date"
                    placeholder="reservation Date"
                    v-model="searchDate"
            /></label>
            <label
                >event type<input
                    type="event"
                    name="id"
                    id="searchEvent"
                    placeholder="Event Type"
                    v-model="searchEvent"
                    value=""
            /></label>
            <label id="searchTime"
                >time<input
                    type="time"
                    name="date"
                    placeholder="reservation Time"
                    v-model="searchTime"
                    value=""
            /></label>
        </div>
        <div class="results flex flex-row flex-shrink-0 w-10/12 flex-wrap">
            <div
                class="w-1/3"
                v-for="item in computed_reservation_data"
                :key="item.index"
            >
                <div
                    v-if="isValid(item)"
                    class="
                        border-black border
                        grid grid-cols-2 grid-rows-3
                        h-16
                        p-2
                        text-sm
                        reservation
                        relative
                    "
                >
                    <p
                        class="row-start-1 col-start-1 leading-none"
                        :title="item.name"
                    >
                        {{
                            item.name.substring(0, 15) +
                            (item.name.length > 15 ? "..." : "")
                        }}
                    </p>
                    <p class="row-start-2 col-start-1 leading-none">
                        {{ IsolateDate(item.date_start) }}
                    </p>
                    <p class="row-start-3 col-start-1 leading-none">
                        {{ item.guest_count }}
                        {{
                            parseInt(item.guest_count) > 1 ? "guests" : "guest"
                        }}
                    </p>
                    <p class="row-start-1 col-start-2 leading-none">
                        Id : {{ item.id }}
                    </p>
                    <p class="row-start-2 col-start-2 leading-none">
                        {{ item.event_type }}
                    </p>
                    <p class="row-start-3 col-start-2 leading-none">
                        {{ "not yet" }}
                    </p>
                    <div
                        class="
                            imgWrap
                            row-start-1
                            col-start-3 col-span-2
                            absolute
                            right-0
                            flex flex-row
                        "
                    >
                        <img
                            src="icons/late.svg"
                            alt="Late"
                            class="icon"
                            v-if="IsLate(item.date_start, item.active)"
                        />
                        <img
                            src="icons/event.svg"
                            alt="Event"
                            class="icon"
                            v-if="item.event_type.length > 0"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="edit">
            <p>
                reservation id : {{ selectedID
                }}<input
                    type="text"
                    name="id"
                    id="selectedID"
                    placeholder="reservation id"
                    :value="selectedID"
                    hidden
                />
            </p>
            <label
                >guest phone<input
                    type="text"
                    name="id"
                    id="phone"
                    placeholder="reservation id"
                    :value="selectedPhone"
            /></label>
            <label
                >guest name<input
                    type="text"
                    name="id"
                    id="name"
                    placeholder="reservation id"
                    :value="selectedName"
            /></label>
            <label
                >guest count<input
                    type="number"
                    name="id"
                    id="guestCount"
                    placeholder="reservation id"
                    :value="selectedGuestCount"
            /></label>
            <label
                >event type<input
                    type="text"
                    name="id"
                    id="event"
                    placeholder="reservation id"
                    :value="selectedEvent"
            /></label>
            <label
                >Date<input
                    type="date"
                    name="Date"
                    id="date"
                    placeholder="reservation id"
                    :value="selectedDate"
            /></label>
            <label
                >notes
                <textarea
                    type="text"
                    name="Notes"
                    id="notes"
                    placeholder="reservation id"
                    :value="selectedNotes"
                >
                </textarea>
            </label>
            <label
                >Time<input
                    type="time"
                    name="Time"
                    id="time"
                    placeholder="reservation id"
                    :value="selectedTime"
            /></label>
            <label
                >tabels
                <div class="selectedTables"></div>
                <select
                    type="time"
                    name="Time"
                    id="time"
                    placeholder="reservation id"
                    v-model="selectedTime"
                    value=""
                >
                    <option
                        value=""
                        v-for="table in table_data"
                        :key="table.id"
                    >
                        Table {{ table.id }} - {{ table.seat_count }}
                        {{ table.seat_count > 1 ? "seats" : "seat" }}
                    </option>
                </select>
                <button>addTable</button>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        pivot: Array,
        table_data: Array,
        reservation_data: Array,
        searchID: String,
        searchPhone: String,
        searchName: String,
        searchEvent: String,
        searchDate: Date,
        searchTime: Date,

        selectedID: String,
        selectedPhone: String,
        selectedName: String,
        selectedEvent: String,
        selectedTabels: String, // curently broken
        selectedGuestCount: Number,
        selectedDate: Date,
        selectedTime: Date,
        selectedNotes: String,
    },
    computed: {
        computed_reservation_data: function () {
            return this.reservation_data.filter((i) => this.isValid(i));
        },
    },
    methods: {
        isValid(item) {
            let name_filter = new RegExp(this.searchName, "g");
            let event_filter = new RegExp(this.searchEvent, "g");
            if (
                (this.searchID == item.id ||
                    this.searchID == undefined ||
                    this.searchID == "") &&
                (this.searchPhone == item.phone ||
                    this.searchPhone == undefined ||
                    this.searchPhone == "") &&
                (name_filter.test(item.name) ||
                    this.searchName == undefined ||
                    this.searchName == "") &&
                (event_filter.test(item.event_type) ||
                    this.searchEvent == undefined ||
                    this.searchEvent == "") &&
                (this.searchDate == this.IsolateDate(item.date_start) ||
                    this.searchDate == undefined ||
                    this.searchDate == "") &&
                (this.searchTime == this.IsolateTime(item.date_start) ||
                    this.searchTime == undefined ||
                    this.searchTime == "")
            )
                return true;
        },
        IsolateDate(datetime) {
            datetime = new Date(datetime);
            return `${datetime.getFullYear()}-${(
                "0" +
                (datetime.getMonth() + 1)
            ).slice(-2)}-${("0" + datetime.getDate()).slice(-2)}`;
        },
        IsolateTime(datetime) {
            datetime = new Date(datetime);
            return `${("0" + datetime.getHours()).slice(-2)}:${(
                "0" + datetime.getMinutes()
            ).slice(-2)}`;
        },
        IsLate(datetime, active) {
            if (
                parseInt(("" + Date.parse(datetime)).slice(0, -4)) <
                    parseInt(("" + Date.now()).slice(0, -4)) &&
                active == 0
            ) {
                return true;
            }
        },
    },
};
</script>
