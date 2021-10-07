<template>
    <div class="grid grid-cols-8 flex-none justify-items-stretch">
        <template v-for="{ id, columns } of rows">
            <div class="col-span-7 p-2">
                <div v-if="editInline">
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

            <div v-if="!editInline" class="p-2">
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
    },
};
</script>
