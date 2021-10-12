<template>
    <div class="flex flex-row border-2 border-dark py-2 w-full h-full">
        <template v-for="[i] of columns.entries()">
            <div v-if="editing" class="flex-1">
                <input
                    class="input block text-center w-1/2"
                    v-model="columns[i]"
                />
            </div>
            <div v-else class="flex-1 text-center">
                {{ previousColumns[i] }}
            </div>
        </template>
    </div>
</template>

<style scoped lang="css">
.input {
    margin: auto;
}
</style>

<script>
export default {
    model: {
        prop: "columns",
        event: "input",
    },
    props: {
        editing: Boolean,
        columns: Array,
        previousColumns: Array,
    },
};
</script>
