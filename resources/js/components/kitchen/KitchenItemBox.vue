<template>
    <div class="flex flex-col justify-center p-2">
        <div
            class="
                h-full
                border-mono-darker border
                bg-mono-lighter
                flex flex-col
                justify-center
            "
        >
            <div class="text-3xl font-bold text-center">
                <slot />
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>
