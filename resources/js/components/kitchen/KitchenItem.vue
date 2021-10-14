<template>
    <div class="bg-mono-light p-2 grid grid-cols-3 grid-rows-5 gap-1">
        <div class="flex flex-col justify-center">
            <div class="text-4xl font-bold text-center">Order N</div>
        </div>

        <kitchen-item-box>Status</kitchen-item-box>
        <kitchen-item-box>Course 1</kitchen-item-box>
        <kitchen-item-box class="col-span-2 row-span-3"
            >Orders here :)</kitchen-item-box
        >
        <kitchen-item-box>13:00</kitchen-item-box>
        <kitchen-item-box>Course 2</kitchen-item-box>
        <div></div>
        <action-button
            class="col-span-2 mx-16 my-2 text-2xl font-bold"
            level="safe"
            >mark course as done</action-button
        >
        <kitchen-item-box>Print receipt</kitchen-item-box>
    </div>
</template>
<script>
export default {};
</script>
