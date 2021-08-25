<template>
    <div class="container">
        <div class="search">
            <label>reservation id<input type="text" name="id" id="searchID" placeholder="reservation id" v-model="searchID" value=""></label>
            <label>phone number<input type="text" name="phone" id="searchPhone" placeholder="Phone Number" v-model="searchPhone" value=""></label>
            <label>guest name<input type="text" name="name" id="searchName" placeholder="Guest Name" v-model="searchName" value=""></label>
            <label id="searchDate">date<input type="date" name="date" placeholder="reservation Date" v-model="searchDate" ></label>
            <label>event type<input type="event" name="id" id="searchEvent" placeholder="Event Type" v-model="searchEvent" value=""></label>
            <label id="searchTime">time<input type="time" name="date" placeholder="reservation Time" v-model="searchTime" value=""></label>
        </div>
        <div v-for="item in reservation_data" :key="item.index">
            <div v-if="isValid(item)" class="border-black border grid grid-cols-2 grid-rows-3 h-16 p-2 text-sm reservation relative">
                <p class="row-start-1 col-start-1 leading-none" :title="item.name">{{item.name.substring(0,15)}}</p>
                <p class="row-start-2 col-start-1 leading-none">{{IsolateDate(item.date_start)}}</p>
                <p class="row-start-3 col-start-1 leading-none">{{item.guest_count}} {{ (parseInt(item.guest_count)>1) ? "guests" : "guest"}}</p>
                <p class="row-start-1 col-start-2 leading-none">Id : {{item.id}}</p>
                <p class="row-start-2 col-start-2 leading-none">{{item.event_type}}</p>
                <p class="row-start-3 col-start-2 leading-none">{{"not yet"}}</p>
                <div class="imgWrap row-start-1 col-start-3 col-span-2 absolute right-0 flex flex-row-reverse">
                    <img src="icons/late.svg" alt="Late" class="icon" v-if="IsLate(item.date_start,item.active)">
                    <img src="icons/event.svg" alt="Event" class="icon" v-if="item.event_type.length > 0">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            reservation_data:Array,
            searchID:String,
            searchPhone:String,
            searchName:String,
            searchEvent:String,
            searchDate:Date,
            searchTime:Date,
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            isValid(item){
                let name_filter = new RegExp(this.searchName,"g")
                let event_filter = new RegExp(this.searchEvent,"g")
                if(
                    (this.searchID == item.id || this.searchID == undefined || this.searchID == '')&&
                    (this.searchPhone == item.phone || this.searchPhone == undefined || this.searchPhone == '')&&
                    (name_filter.test(item.name) || this.searchName == undefined || this.searchName == '')&&
                    (event_filter.test(item.event_type) || this.searchEvent == undefined || this.searchEvent == '')&&
                    (this.searchDate == this.IsolateDate(item.date_start) || this.searchDate == undefined || this.searchDate == '')&&
                    (this.searchTime == this.IsolateTime(item.date_start) || this.searchTime == undefined || this.searchTime == '')
                )
                return true
            },
            IsolateDate(datetime){
                return `${new Date(datetime).getFullYear()}-${("0" + (new Date(datetime).getMonth()+1)).slice(-2)}-${("0" + new Date(datetime).getDate()).slice(-2)}`
            },
            IsolateTime(datetime){
                return `${("0" + new Date(datetime).getHours()).slice(-2)}:${("0" + new Date(datetime).getMinutes()).slice(-2)}`
            },
            IsLate(datetime, active){
                console.log(active)
                if(parseInt((""+Date.parse(datetime)).slice(0,-4))<parseInt((""+Date.now()).slice(0,-4)) && active == 0){
                    return true
                }
            },
        },
    }
</script>
