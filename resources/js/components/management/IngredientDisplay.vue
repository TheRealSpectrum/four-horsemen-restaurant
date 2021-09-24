<template>
    <div>
        <div class="grid grid-cols-3 h-6">
            <label for="name" class="text-lg font-bold"> {{ label }} </label>
        </div>
        <div class="flex flex-col py-4">
            <div
                v-for="({ name, amount }, index) in items"
                :key="index"
                class="grid grid-cols-2 py-2"
            >
                <div class="font-bold">{{ name }}</div>
                <div class="text-right">{{ amount }}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: this.value,
        };
    },
    props: {
        label: String,
        value: Array,
    },
};
</script>
