<template>
    <div class="grid grid-cols-3 h-6">
        <label :for="name" class="text-lg font-bold">
            {{ label }}
        </label>
        <select v-model="newValue" :name="name" class="text-lg">
            <option
                v-for="({ id, display }, i) in value.options"
                :key="i"
                :value="id"
            >
                {{ display }}
            </option>
        </select>
        <div v-if="error != null" class="font-bold text-warning-high p-1">
            {{ $error }}
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            newValue: this.value.value,
        };
    },
    props: {
        value: Object,
        label: String,
        name: String,
        error: String,
    },
};
</script>

<style scoped></style>
