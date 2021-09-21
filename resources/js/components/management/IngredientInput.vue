<template>
    <div>
        <div class="grid grid-cols-3 h-6">
            <label for="name" class="text-lg font-bold"> {{ label }} </label>
            <action-button level="safe">Add ingredient</action-button>
            <div v-if="error" class="font-bold text-warning-high p-1">
                {{ error }}
            </div>
        </div>
        <div class="flex flex-col py-4">
            <div v-for="(item, index) in value" class="grid grid-cols-3 py-2">
                <div class="text-lg font-bold">{{ item.type }}</div>
                <div class="flex flex-row">
                    <input
                        type="number"
                        :name="`ingredient-${index + 1}`"
                        v-model:value="item.amount"
                    />
                    <div>{{ item.unit }}</div>
                </div>
                <action-button>Delete</action-button>
            </div>
        </div>
    </div>
</template>

<script lang="js">

export default {
    props: {
        label: String,
        error: String,
        value: Array,
    }
};
</script>
