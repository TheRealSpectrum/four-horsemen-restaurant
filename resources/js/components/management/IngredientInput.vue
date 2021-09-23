<template>
    <div>
        <div class="grid grid-cols-3 h-6">
            <label for="name" class="text-lg font-bold"> {{ label }} </label>
            <action-button v-on:click-action="addItem()" level="safe"
                >Add ingredient</action-button
            >
            <div v-if="error" class="font-bold text-warning-high p-1">
                {{ error }}
            </div>
        </div>
        <div class="flex flex-col py-4">
            <div
                v-for="(ingredient, index) in items"
                :key="index"
                class="grid grid-cols-3 py-2"
            >
                <select
                    class="text-lg font-bold w-1/2"
                    :name="`ingredient-id-${index}`"
                >
                    <option
                        v-for="{ id, name, unit } of ingredients"
                        :value="id"
                        :selected.boolean="id === ingredient.id"
                    >
                        {{ name }}
                    </option>
                </select>
                <div class="flex flex-row">
                    <input
                        type="number"
                        :name="`ingredient-amount-${index}`"
                        v-model:value="ingredient.amount"
                    />
                    <div>{{ units[ingredient.id] }}</div>
                </div>
                <action-button
                    v-on:click-action="removeItem(index)"
                    level="high"
                    >Delete</action-button
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        let units = {};

        for (const ingredient of this.ingredients) {
            units[ingredient.id] = ingredient.unit;
        }

        return {
            items: this.value,
            units,
        };
    },
    props: {
        label: String,
        value: Array,
        error: String,
        ingredients: Array,
    },
    methods: {
        addItem() {
            this.items.push({ type: "next", amount: 0, unit: "l" });
        },
        removeItem(index) {
            this.items.splice(index, 1);
        },
    },
};
</script>
