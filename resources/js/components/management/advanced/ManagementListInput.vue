<template>
    <div>
        <label :for="name">{{ label }}</label>
        <div
            class="
                management-list-input management-input-value
                flex flex-col
                gap-4
            "
            :data-value="valueJson"
            :data-name="name"
        >
            <div
                v-for="(listItem, i) in value"
                :key="i"
                class="bg-mono-lighter border-2 border-mono-darker"
            >
                <slot
                    :getValue="() => value[i]"
                    :setValue="(newVal) => setValue(i, newVal)"
                />
            </div>
            <action-button level="safe" @click-action="addItem()"
                >Add Item</action-button
            >
        </div>
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
        name: String,
        label: String,
        defaultValue: Array,
        defaultNew: null,
    },
    methods: {
        addItem() {
            this.value.push(_.cloneDeep(this.defaultNew));
        },
        setValue(i, newVal) {
            this.value.splice(i, 1, newVal);
        },
    },
    computed: {
        valueJson() {
            return JSON.stringify(this.value);
        },
    },
};
</script>

<style scoped></style>
