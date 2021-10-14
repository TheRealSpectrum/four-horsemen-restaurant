<template>
    <div class="kitchen-app grid w-full h-full">
        <div class="flex flex-row"></div>
        <div class="grid grid-cols-3 grid-rows-2 gap-6 p-6">
            <kitchen-item
                v-for="i in 6"
                :order-num="i"
                status="New"
                :course="3"
                :orders="[]"
                :time="`1${i}:00`"
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
export default {};
</script>
