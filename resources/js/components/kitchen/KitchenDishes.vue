<template>
    <div class="flex flex-col justify-center p-2">
        <div
            class="
                h-full
                border-mono-darker border
                bg-mono-lighter
                flex flex-col
                justify-start
                p-4
            "
        >
            <ul class="font-bold">
                <li v-for="{ name, amount, note } of dishes">
                    <span
                        class="
                            inline-block
                            w-3
                            h-3
                            border border-mono-darker
                            rounded-full
                            mr-2
                        "
                        :class="{ 'bg-mono-darker': note !== null }"
                    ></span
                    >{{ amount }}X {{ name }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        dishes: Array,
    },
};
</script>
