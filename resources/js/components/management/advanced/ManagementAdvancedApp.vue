<template>
    <div id="management-advanced-app" class="grid">
        <ul
            class="
                bg-mono-light
                border-r-4 border-mono-darker
                list-disc
                pl-8
                text-2xl
                overflow-auto
                max-h-full
            "
        >
            <li v-for="i in 4" :key="i">
                <h2>header {{ i }} >>></h2>
                <ul class="list-disc pl-8 flex flex-col gap-6">
                    <li v-for="j in 8" :key="j">
                        <action-button
                            @click-action="select(i, j)"
                            class="w-full"
                            >item {{ j }}</action-button
                        >
                    </li>
                </ul>
            </li>
        </ul>
        <div class="h-full w-full">
            <div v-for="i in 4" :key="i">
                <div v-for="j in 8" :key="j">
                    <div v-if="isSelected(i, j)">{{ i }}, {{ j }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            selected: { header: null, item: null },
        };
    },
    methods: {
        select(header, item) {
            this.selected = { header, item };
        },
        isSelected(header, item) {
            return (
                this.selected.header === header && this.selected.item === item
            );
        },
    },
};
</script>

<style scoped>
#management-advanced-app {
    grid-template-columns: 22rem 1fr;
    width: 100vw;
}
</style>
