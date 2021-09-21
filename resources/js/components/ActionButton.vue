<template>
    <button
        v-on:click="$emit('click-action')"
        type="button"
        class="border-2 border-dark rounded bg-save"
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
            <div>
                <slot />
            </div>
        </div>
    </button>
</template>
