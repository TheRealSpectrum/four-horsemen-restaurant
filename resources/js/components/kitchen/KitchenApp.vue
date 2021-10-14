<template>
    <div class="kitchen-app grid w-full h-full">
        <div class="flex flex-row py-4 justify-center gap-4">
            <kitchen-page
                v-for="page in pages"
                @select="index = page"
                :page="page"
                :current="page === index"
            ></kitchen-page>
        </div>
        <div class="grid grid-cols-3 grid-rows-2 gap-6 p-6">
            <kitchen-item
                v-for="order in orders[index]"
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
            pages: [],
            index: 0,
        };
    },
    methods: {
        poll() {
            const allOrders = [
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
                {
                    orderNum: 5,
                    status: "Ongoing",
                    course: 2,
                    dishes: [],
                    time: "11:00",
                },
                {
                    orderNum: 6,
                    status: "New",
                    course: 3,
                    dishes: [],
                    time: "12:00",
                },
                {
                    orderNum: 7,
                    status: "New",
                    course: 3,
                    dishes: [],
                    time: "13:00",
                },
                {
                    orderNum: 8,
                    status: "New",
                    course: 3,
                    dishes: [],
                    time: "14:00",
                },
            ]; // todo: implement axios request

            this.orders = [];
            this.pages = [];
            for (let i = 0; allOrders.length > 0; ++i) {
                this.orders.push(allOrders.splice(0, 6));
                this.pages.push(i);
            }
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
