<template>
    <div>
        <div class="grid grid-cols-3 h-6">
            <label for="name" class="text-lg font-bold"> {{ label }} </label>
        </div>
        <div>Profit: {{ value.profit }}</div>
        <div class="flex flex-col py-4">
            <div
                v-for="({ name, amount, purchasePrice }, index) in items"
                :key="index"
                class="grid grid-cols-3 py-2"
            >
                <div class="font-bold">{{ name }}</div>
                <div>{{ purchasePrice }}</div>
                <div class="text-right">{{ amount }}</div>
            </div>
            <div class="grid grid-cols-3 py-2 border-t border-mono-darker">
                <div class="font-bold">Total:</div>
                <div>{{ value.totalPrice }}</div>
                <div class="text-right"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: this.value.ingredients,
        };
    },
    props: {
        label: String,
        value: Object,
    },
};
</script>
