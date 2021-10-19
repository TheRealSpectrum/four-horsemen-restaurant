<template>
    <div class="bg-mono-light p-2 grid grid-cols-3 grid-rows-5 gap-1">
        <div class="flex flex-col justify-center">
            <div class="text-4xl font-bold text-center">
                Table {{ orderNum }}
            </div>
        </div>

        <kitchen-item-box>{{ status }}</kitchen-item-box>
        <kitchen-item-box>Course {{ course }}</kitchen-item-box>
        <kitchen-dishes
            class="col-span-2 row-span-3"
            :dishes="dishes"
        ></kitchen-dishes>
        <kitchen-item-box>{{ time }}</kitchen-item-box>
        <kitchen-item-box>Course 2</kitchen-item-box>
        <div></div>
        <action-button
            class="col-span-2 mx-16 my-2 text-2xl font-bold"
            level="safe"
            @click-action="completeCourse"
            >mark course as done</action-button
        >
        <kitchen-item-box>Print receipt</kitchen-item-box>
    </div>
</template>
<script>
export default {
    props: {
        completeRoute: String,
        orderNum: Number,
        status: String,
        course: Number,
        dishes: Array,
        time: String,
    },
    methods: {
        async completeCourse() {
            await axios.patch(this.completeRoute);
        },
    },
};
</script>
