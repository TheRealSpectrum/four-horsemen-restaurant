<template>
    <div class="p-2 h-14">
        <span
            ><action-button
                @click-action="create()"
                class="font-bold w-full h-full"
                level="safe"
                >Create</action-button
            ></span
        >
    </div>
</template>

<script>
export default {
    props: {
        routeIndex: String,
        routeStore: String,
        pageAfterCreate: String,
        columnData: Object,
    },
    methods: {
        async create() {
            try {
                const result = await axios.post(
                    this.routeStore,
                    this.columnData
                );

                location = this.routeIndex + "?page=" + this.pageAfterCreate;
            } catch (error) {
                console.log(error.response);
            }
        },
    },
};
</script>
