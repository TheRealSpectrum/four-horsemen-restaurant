<template>
    <div class="kitchen-app grid w-full h-full">
        <div class="flex flex-row"></div>
        <div class="grid grid-cols-3 grid-rows-2 gap-6 p-6">
            <kitchen-item
                v-for="order in orders"
                :order-num="order.orderNum"
                :status="order.status"
                :course="order.course"
                :dishes="order.dishes"
                :time="order.time"
            ></kitchen-item>
        </div>
    </div>
</template>

<style>
.kitchen-app {
    grid-template-rows: 5rem 1fr;
}
</style>

<script>
export default {
    data() {
        return {
            pollInterval: null,
            orders: [],
        };
    },
    methods: {
        poll() {
            this.orders = [
                {
                    orderNum: 1,
                    status: "Ongoing",
                    course: 2,
                    dishes: [],
                    time: "11:00",
                },
                {
                    orderNum: 2,
                    status: "New",
                    course: 3,
                    dishes: [],
                    time: "12:00",
                },
                {
                    orderNum: 3,
                    status: "New",
                    course: 3,
                    dishes: [],
                    time: "13:00",
                },
                {
                    orderNum: 4,
                    status: "New",
                    course: 3,
                    dishes: [],
                    time: "14:00",
                },
            ]; // todo: implement axios request
        },
    },
    created() {
        this.poll();
        this.pollInterval = setInterval(() => this.poll(), 3000);
    },
    beforeDestroy() {
        clearInterval(this.pollInterval);
    },
};
</script>
