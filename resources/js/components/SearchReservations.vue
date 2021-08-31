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
            <div class="w-1/3" v-for="item in computed_reservation_data" :key="item.index" v-on:click="SelectReservation(item)">
                <div v-if="isValid(item)" class="border-black border grid grid-cols-2 grid-rows-3 h-16 p-2 text-sm reservation relative">
                    <p  class="row-start-1 col-start-1 leading-none" :title="item.name">
                        {{(item.name.substring(0,15) + ((item.name.length>15)?"...":""))}}
                    </p>
                    <p class="row-start-2 col-start-1 leading-none">
                        {{IsolateDate(item.date_start)}}
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
                        {{"not yet"}}
                    </p>
                    <div class="imgWrap row-start-1 col-start-3 col-span-2 absolute right-0 flex flex-row">
                        <img src="icons/late.svg" alt="Late" class="icon " v-if="IsLate(item.date_start,item.active)">
                        <img src="icons/event.svg" alt="Event" class="icon " v-if="item.event_type">
                    </div>
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
                    placeholder="reservation id"  
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
                    name="phone" 
                    placeholder="reservation id" 
                    :value="selectedPhone"
                >
           </label>
            <label
                id="name" 
            >guest name
                <input 
                    type="text" 
                    name="name" 
                    placeholder="reservation id" 
                    :value="selectedName"
                >
            </label>
            <label
                id="guestCount" 
            ><span class="lableWrap"><span class="text">guest count</span> <span class="extraData">{{total_asigned_seats}}</span></span>
                <input 
                    type="number" 
                    name="guestCount" 
                    placeholder="reservation id" 
                    :value="selectedGuestCount"
                >
            </label>
            <label
                id="event" 
            >event type
                <input 
                    type="text" 
                    name="event" 
                    placeholder="reservation id" 
                    :value="selectedEvent"
                >
            </label>
            <label
                id="date" 
            >Date
                <input 
                    type="date" 
                    name="date" 
                    placeholder="reservation id" 
                    :value="selectedDate"
                >
            </label>
            <label
                id="notes" 
            >notes
                <br>
                <textarea 
                    type="text" 
                    name="notes" 
                    placeholder="reservation id"
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
                    placeholder="reservation id" 
                    :value="selectedTime"
                >
                <select name="endTime" id="endTime">
                    <option 
                        v-for="(reservation_length,index) in config.reservation_lengths" :key="index"
                        :value="`PT${reservation_length.hour}H${reservation_length.minutes}M`"
                        :default="reservation_length.default"
                    >
                        + {{reservation_length.houre}} hour {{(reservation_length.minutes !== 0)?`and ${reservation_length.minutes} minutes `:''}}
                    </option>
                    <!-- <option value="PT1H" default>+ 1 hour</option>
                    <option value="PT1H15M">+ 1 hour and 15 minutes</option>
                    <option value="PT1H30M">+ 1 hour and 30 minutes</option>
                    <option value="PT1H45M">+ 1 hour and 45 minutes</option>
                    <option value="PT2H">+ 2 hour</option>
                    <option value="PT2H15M">+ 2 hour and 15 minutes</option>
                    <option value="PT2H30M">+ 2 hour and 30 minutes</option>
                    <option value="PT2H45M">+ 2 hour and 45 minutes</option>
                    <option value="PT3H">+ 3 hour</option>
                    <option value="PT3H15M">+ 3 hour and 15 minutes</option>
                    <option value="PT3H30M">+ 3 hour and 30 minutes</option>
                    <option value="PT3H45M">+ 3 hour and 45 minutes</option>
                    <option value="PT4H">+ 4 hour</option> -->
                </select>
            </label>
            <label
                id="tables"
            >tables
                <select 
                    name="tableToAdd"
                    v-model="tableToAdd" 
                    :value="tableToAdd"
                >
                    <option :value="table.id" v-for="table in table_data" :key="table.id" v-on:click="addTable()">
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
        searchID: String,
        searchPhone: String,
        searchName: String,
        searchEvent: String,
        searchDate: Date,
        searchTime: Date,

        editState:Boolean,
        tableToAdd:String,

        selectedID: String,
        selectedPhone: String,
        selectedName: String,
        selectedEvent: String,
        selectedTabels: Array,
        selectedGuestCount: Number,
        selectedDate: Date,
        selectedTime: Date,
        selectedNotes: String,
    },
    computed: {
        computed_reservation_data: function () {
            return this.reservation_data.filter((i) => this.isValid(i));
        },
        computed_tables: function(){
            let out = ''
            out += this.selectedTabels?.join()
            return out
        },
        table_seats: function(){
            let out = {}
            this.table_data.forEach(table => {
                out[table.id]=table.seat_count               
            });
            return out
        },
        total_asigned_seats:function(){
            let seats = 0
            this.selectedTabels?.forEach(table =>{
                seats += this.table_seats[table]
            })
            return `total seats : ${seats}`
        },
        config:function(){

        }
    },
    data: () => ({
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        config:{},
    }),
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
        toggleEdit(state){
            if(((this.editState == true || this.editState==undefined ) && state != "show")|| state=="hide"){
                this.editState = false
            }else if((this.editState==false && state !="hide" )|| state=="show"){
                this.editState = true
            }
            console.log(this.selectedTabels)
        },
        SelectReservation(item){
            this.selectedID = item.id
            this.selectedPhone = item.phone
            this.selectedName = item.name
            this.selectedEvent = item.event_type
            this.selectedGuestCount = item.guest_count
            this.selectedDate = this.IsolateDate(item.date_start)
            this.selectedTime = this.IsolateTime(item.date_start)
            this.selectedNotes = item.notes
            this.selectedTabels = []
            for(let reservations_table of this.pivot){
                if(reservations_table.reservation_id==item.id){
                    this.selectedTabels.push(reservations_table.table_id)
                }
            }
            console.log(this.selectedTabels)
            this.toggleEdit("show")
        },
        removeTable(index){
            delete this.selectedTabels[index]
            this.selectedTabels = this.selectedTabels.filter(function (el) {return el != null})
        },
        addTable(){
            if(!this.computed_tables.split(',').includes(`${this.tableToAdd}`)){
                this.selectedTabels.push(this.tableToAdd)
            }
            this.tableToAdd = ''
        }
    },
};
</script>
