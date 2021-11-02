<template>
    <div class="grid grid-cols-3 h-6">
        <label :for="name" class="text-lg font-bold">
            {{ label }}
        </label>
        <select v-model="newValue" :name="name">
            <option
                v-for="(unit, i) in units"
                :key="i"
                :value="unit.id"
                class="text-xl"
            >
                {{ unit.name }}
            </option>
        </select>
    </div>
</template>

<script>
export default {
    data() {
        return {
            newValue: this.value,
        };
    },
    props: {
        label: String,
        name: String,
        value: Number,
        units: Array,
    },
};
</script>

<style scoped></style>
