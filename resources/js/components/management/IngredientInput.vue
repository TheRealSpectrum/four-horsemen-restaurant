<template>
    <div>
        <div class="grid grid-cols-3 h-6">
            <label for="name" class="text-lg font-bold"> label </label>
            <action-button level="safe">Add ingredient</action-button>
            <div class="font-bold text-warning-high p-1">errors</div>
        </div>
        <input
            name="name"
            value="old(name, value)"
            type="type"
            class="text-lg"
        />
    </div>
</template>

<script lang="js">

export default {
};
</script>
