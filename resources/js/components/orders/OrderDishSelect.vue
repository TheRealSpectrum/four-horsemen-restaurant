<template>
    <div id="order-root">
        <div v-if="includeCategories" class="dishCategorySelect">
            <!-- todo: implement properly-->
            <action-button v-for="i in 5" :key="i" class="dishCategory">
                <img src="/dishes/missing.png" />
            </action-button>
        </div>
        <div class="filteredDishes">
            <action-button
                v-for="(item, index) of dish_data"
                :key="index"
                @click-action="$emit('select-menu-item', index)"
                class="menuItem"
            >
                <!-- TODO add src when images are available -->
                <div class="menuImage">
                    <img
                        src="/dishes/missing.png"
                        :alt="`${item.name} image`"
                    />
                </div>
                <div class="menuName">
                    <p>{{ item.name }}</p>
                </div>
            </action-button>
        </div>
        <action-button
            level="action"
            class="backBtn"
            @click-action="$emit('back')"
            >Back</action-button
        >
    </div>
</template>

<script>
export default {
    props: {
        includeCategories: Boolean,
        dish_data: Array,
    },
};
</script>

<style scoped>
.dishCategorySelect {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 3rem;
    padding: 0 3rem;
    width: 100%;
    height: 15vh;
    overflow-x: auto;
    overflow-y: hidden;
    background-color: var(--mono-darker, #000);
}
.filteredDishes {
    display: grid;
    width: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    grid-template-columns: 1fr 1fr;
    grid-auto-rows: 10rem;
    row-gap: 3rem;
    column-gap: 1.5rem;
    padding: 0 1.5rem;
}

.menuItem {
    width: 100%;
    overflow-y: hidden;
    overflow-x: hidden;
}

.menuItem /deep/ .inner {
    display: grid;
    grid-template-columns: 10rem 1fr;
    height: 100%;
}
.menuImage {
    padding: 1rem;
    object-fit: cover;
}

.menuName {
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100%;
}

.menuName > p {
    overflow: hidden;
}

.backBtn {
    padding: 1rem;
}
</style>
