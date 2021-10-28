<template>
    <div>
        <label :for="name"><slot /></label>
        <input
            class="management-input management-input-value"
            :name="name"
            v-model="value"
            :data-value="value"
            :data-name="name"
            :type="type"
        />
    </div>
</template>

<script>
export default {
    data() {
        return {
            value: this.defaultValue,
        };
    },
    props: {
        type: String,
        name: String,
        defaultValue: String,
    },
};
</script>

<style scoped></style>
