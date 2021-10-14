<template>
    <action-button
        @click-action="$emit('select')"
        class="font-bold text-4xl w-24"
        :level="level"
    >
        {{ display }}
    </action-button>
</template>

<script>
export default {
    props: {
        page: Number,
        current: Boolean,
    },
    computed: {
        display() {
            return (this.page + 1).toString();
        },
        level() {
            return this.current ? "nav-current" : "nav";
        },
    },
};
</script>
