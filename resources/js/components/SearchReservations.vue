<template>
    <!-- prettier-ignore -->
    <div class="container border border-current ">
        <div class="search">
            <label>reservation id
                <input 
                    type="text" 
                    name="id" 
                    id="searchID" 
                    placeholder="reservation id" 
                    v-model="searchID" 
                    value=""
                >
            </label>
            <label>phone number
                <input 
                    type="text" 
                    name="phone" 
                    id="searchPhone" 
                    placeholder="Phone Number" 
                    v-model="searchPhone" 
                    value=""
                >
            </label>
            <label>guest name
                <input 
                    type="text" 
                    name="name" 
                    id="searchName" 
                    placeholder="Guest Name" 
                    v-model="searchName" 
                    value=""
                >
            </label>
            <label id="searchDate">date
                <input 
                    type="date" 
                    name="date" 
                    placeholder="reservation Date" 
                    v-model="searchDate" 
                    :min="IsolateDate(Date.now())"
                >
            </label>
            <label>event type
                <input 
                    type="event" 
                    name="id" 
                    id="searchEvent" 
                    placeholder="Event Type" 
                    v-model="searchEvent" 
                    value=""
                >
            </label>
            <label id="searchTime">time
                <input 
                    type="time" 
                    name="date" 
                    placeholder="reservation Time" 
                    v-model="searchTime" 
                    value=""
                >
            </label>
        </div>
        <div class="results flex flex-row flex-shrink-0 w-10/12 flex-wrap">
            <div 
            v-for="item in computed_reservation_data" :key="item.index"
            v-on:click="SelectReservation(item)"
            class="border-black border grid grid-cols-2 grid-rows-3 h-16 p-2 text-sm reservation relative">
                <p  class="row-start-1 col-start-1 leading-none" :title="item.name">
                    {{(item.name.substring(0,15) + ((item.name.length>15)?"...":""))}}
                </p>
                <p class="row-start-2 col-start-1 leading-none">
                    {{IsolateDate(item.date_start)}} - {{IsolateTime(item.date_start)}} - {{IsolateTime(item.date_end)}}
                </p>
                <p class="row-start-3 col-start-1 leading-none">
                    {{item.guest_count}} {{ (parseInt(item.guest_count)>1) ? "guests" : "guest"}}
                </p>
                <p class="row-start-1 col-start-2 leading-none">
                    Id : {{item.id}}
                </p>
                <p class="row-start-2 col-start-2 leading-none">
                    {{item.event_type}}
                </p>
                <p class="row-start-3 col-start-2 leading-none">
                    {{getTables(item)}}
                </p>
                <div class="imgWrap row-start-1 col-start-3 col-span-2 absolute right-0 flex flex-row">
                    <img src="icons/late.svg" alt="Late" class="icon " v-if="IsLate(item.date_start,item.active)">
                    <img src="icons/event.svg" alt="Event" class="icon " v-if="item.event_type">
                </div>
            </div>
        </div>
        <form id="edit" class="edit" :class="((editState==false || editState==undefined)? 'hidden':'')"  action="/update" method="POST">
            <input type="hidden" name="_token" :value="csrf" readonly>
            <input type="hidden" name="_method" value="PATCH" readonly>
            <input type="hidden" name="table" :value="computed_tables" readonly>
            <div id="cancel" v-on:click="toggleEdit('hide')">X</div>
            <p
                id="id" 
            >reservation id : {{selectedID}}
                <input 
                    type="text" 
                    name="id"  
                    :value="selectedID" 
                    hidden
                    readonly
                >
            </p>
            <label
                id="phone" 
            >guest phone
                <input 
                    type="text" 
                    name="phone_number" 
                    :value="selectedPhone"
                >
           </label>
            <label
                id="name" 
            >guest name
                <input 
                    type="text" 
                    name="name" 
                    :value="selectedName"
                >
            </label>
            <label
                id="guestCount" 
            ><span class="lableWrap"><span class="text">guest count</span> <span class="extraData">{{total_asigned_seats}}</span></span>
                <input 
                    type="number" 
                    name="guest_count" 
                    :value="selectedGuestCount"
                >
            </label>
            <label
                id="event" 
            >event type
                <input 
                    type="text" 
                    name="event_type" 
                    :value="selectedEvent"
                >
            </label>
            <label
                id="date" 
            >Date
                <input 
                    type="date" 
                    name="date" 
                    :value="selectedDate"
                    :min="IsolateDate(Date.now())"
                >
            </label>
            <label
                id="notes" 
            >notes
                <br>
                <textarea 
                    type="text" 
                    name="notes" 
                    :value="selectedNotes"
                >
                </textarea>
            </label>
            <label
                id="time" 
            >Time
                <input 
                    type="time"
                    name="time"
                    :value="selectedTime"
                >
                <select name="endTime" id="endTime">
                    <!-- pre made for when config gets working expected config format
                    config:{
                        reservation_lenghts:[
                            {hours:int,minutes:int},
                            {hours:int,minutes:int}
                        ]
                    }


                        <option 
                        v-for="(reservation_length,index) in config.reservation_lengths" :key="index"
                        :value="`PT${reservation_length.hour}H${reservation_length.minutes}M`"
                        :default="reservation_length.default"
                    >
                        + {{reservation_length.hours}} hour {{(reservation_length.minutes !== 0)?`and ${reservation_length.minutes} minutes `:''}}
                    </option> -->
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
            </label>
            <label
                id="tables"
            >tables
                <select 
                    name="tableToAdd"
                    v-model="tableToAdd" 
                    :value="tableToAdd"
                    v-on:change="addTable()"
                >
                    <option :value="table.id" v-for="table in computed_table_data" :key="table.id" >
                        Table {{table.id}} - {{table.seat_count}} {{((table.seat_count>1)?"seats":"seat")}}
                    </option>
                </select>
                <div class="selectedTables flex flex-row justify-start gap-2"> 
                    <div class="table " v-for="(table,index) in selectedTabels" :key="index">
                        <p>{{table}}</p>
                        <div class="remove" v-on:click="removeTable(index)">remove</div>
                    </div>
                </div>
            </label>
            <div class="btnWrap">
                <button type="submit" name="action" value="update">
                    update reservation
                </button>
                <button type="submit" name="action" value="cancel">
                    cancel reservation
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        pivot: Array,
        table_data: Array,
        reservation_data: Array,
    },
    data() {
        return {
            searchID: "",
            searchPhone: "",
            searchName: "",
            searchEvent: "",
            searchDate: undefined,
            searchTime: undefined,

            editState: false,
            tableToAdd: "",

            selected_reservation: undefined,
            selectedID: undefined,
            selectedPhone: undefined,
            selectedName: undefined,
            selectedEvent: undefined,
            selectedTabels: undefined,
            selectedGuestCount: undefined,
            selectedDate: undefined,
            selectedTime: undefined,
            selectedNotes: undefined,

            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    computed: {
        computed_reservation_data: function () {
            return this.reservation_data.filter((i) => this.isValid(i));
        },
        computed_table_data: function () {
            return this.table_data.filter((i) => this.isAvailible(i));
        },
        computed_tables: function () {
            let out = "";
            out += this.selectedTabels?.join();
            return out;
        },
        table_seats: function () {
            let out = {};
            this.table_data.forEach((table) => {
                out[table.id] = table.seat_count;
            });
            return out;
        },
        total_asigned_seats: function () {
            let seats = 0;
            this.selectedTabels?.forEach((table) => {
                seats += this.table_seats[table];
            });
            return `total seats : ${seats}`;
        },
    },
    // data: () => ({
    // }),
    methods: {
        isValid(item) {
            let name_filter = new RegExp(this.searchName, "gi");
            let event_filter = new RegExp(this.searchEvent, "gi");
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
                    this.searchTime == "") &&
                item.canceled == false
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
        toggleEdit(state) {
            if (
                ((this.editState == true || this.editState == undefined) &&
                    state != "show") ||
                state == "hide"
            ) {
                this.editState = false;
            } else if (
                (this.editState == false && state != "hide") ||
                state == "show"
            ) {
                this.editState = true;
            }
            console.log(this.selectedTabels);
        },
        SelectReservation(item) {
            this.selected_reservation = item;
            this.selectedID = item.id;
            this.selectedPhone = item.phone_number;
            this.selectedName = item.name;
            this.selectedEvent = item.event_type;
            this.selectedGuestCount = item.guest_count;
            this.selectedDate = this.IsolateDate(item.date_start);
            this.selectedTime = this.IsolateTime(item.date_start);
            this.selectedNotes = item.notes;
            this.selectedTabels = [];
            for (let reservations_table of this.pivot) {
                if (reservations_table.reservation_id == item.id) {
                    this.selectedTabels.push(reservations_table.table_id);
                }
            }
            console.log(this.selectedTabels);
            this.toggleEdit("show");
        },
        removeTable(index) {
            delete this.selectedTabels[index];
            this.selectedTabels = this.selectedTabels.filter(function (el) {
                return el != null;
            });
        },
        addTable() {
            if (
                typeof this.tableToAdd == "number" &&
                !this.computed_tables.split(",").includes(`${this.tableToAdd}`)
            ) {
                this.selectedTabels.push(this.tableToAdd);
            }
            this.tableToAdd = "";
        },
        isAvailible(table) {
            let id = table.id;
            let result = true;
            this.reservation_data.forEach((reservation) => {
                if (
                    (this.selected_reservation?.date_start >
                        reservation.date_start &&
                        this.selected_reservation?.date_start <
                            reservation.date_end) ||
                    (this.selected_reservation?.date_end >
                        reservation.date_start &&
                        this.selected_reservation?.date_end <
                            reservation.date_end) ||
                    this.selectedTabels?.includes(id)
                ) {
                    reservation.tables.forEach((rezervedTable) => {
                        if (rezervedTable.id == id) {
                            result = false;
                        }
                    });
                }
            });
            return result;
        },
        getTables(item) {
            let out = [];
            item.tables.forEach((table) => {
                out.push(table.id);
            });
            return out.join(", ");
        },
    },
};
</script>
