<template>
    <div class="grid grid-cols-8 flex-none justify-items-stretch">
        <template v-for="({ id, columns }, index) in rows">
            <div class="col-span-7 p-2">
                <div v-if="editInline">
                    <index-list-inline-edit
                        :editing="index === currentIndex"
                        :previousColumns="oldRows[index].columns"
                        v-model="columns"
                    ></index-list-inline-edit>
                </div>

                <a v-else :href="insertedRouteShow(id)">
                    <div
                        class="
                            flex flex-row
                            border-2 border-dark
                            py-2
                            w-full
                            h-full
                        "
                    >
                        <div
                            v-for="column of columns"
                            class="flex-1 text-center"
                        >
                            {{ column }}
                        </div>
                    </div>
                </a>
            </div>

            <div v-if="editInline" class="p-2">
                <span>
                    <action-button
                        v-if="index === currentIndex"
                        level="safe"
                        @click-action="saveRow(index, columns)"
                        class="font-bold h-full w-full"
                        >Save</action-button
                    >

                    <action-button
                        v-else
                        level="low"
                        @click-action="editRow(index)"
                        class="font-bold h-full w-full"
                        >Edit</action-button
                    >
                </span>
            </div>
            <div v-else class="p-2">
                <a :href="insertedRouteEdit(id)"
                    ><action-button level="low" class="font-bold h-full w-full"
                        >Edit</action-button
                    ></a
                >
            </div>
        </template>
    </div>
</template>

<script>
export default {
    data() {
        return {
            currentIndex: -1,
            oldRows: _.cloneDeep(this.rows),
        };
    },
    props: {
        rows: Array,
        editInline: Boolean,
        routeShow: String,
        routeEdit: String,
    },
    methods: {
        insertedRouteShow(id) {
            return this.routeShow.replace("___INSERT_ID___", id);
        },
        insertedRouteEdit(id) {
            return this.routeEdit.replace("___INSERT_ID___", id);
        },
        editRow(index) {
            this.currentIndex = index;
        },
        saveRow(index, columns) {
            console.log("saved", index, columns);
        },
    },
};
</script>
