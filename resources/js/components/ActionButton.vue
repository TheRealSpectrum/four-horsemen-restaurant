<template>
    <button
        v-on:click="$emit('click-action')"
        type="button"
        class="border-2 border-dark rounded"
        :class="background"
    >
        <div
            class="
                hover:bg-button-dim
                w-full
                h-full
                p-1
                flex flex-col
                justify-center
            "
        >
            <div class="inner">
                <slot />
            </div>
        </div>
    </button>
</template>

<script>
export default {
    props: {
        level: String,
        type: String,
    },
    computed: {
        background() {
            switch (this.level) {
                case "safe":
                    return "bg-save";
                    break;
                case "low":
                    return "bg-warning-low";
                    break;
                case "high":
                    return "bg-warning-high";
                    break;
                case "nav":
                    return "bg-navbutton-base";
                    break;
                case "nav-current":
                    return "bg-navbutton-active";
                    break;
                case "neutral":
                    return "bg-light";
                    break;
                case "action":
                    return "bg-mono-darker text-mono-lighter";
                    break;
            }
            return "";
        },
    },
};
</script>
