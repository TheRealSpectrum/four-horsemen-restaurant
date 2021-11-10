<template>
    <div id="order-root" class="new">
        <div class="notification" :class="showNotification ? 'show' : ''">
            <p>{{ notificationContent }}</p>
        </div>
        <label class="tableSelectWrap">
            <h3>table</h3>
            <select
                name="table"
                id="table"
                :value="table"
                @input="$emit('table-changed', $event)"
                @change="$emit('check-table')"
            >
                <option value="">select</option>
                <option
                    v-for="(table, index) in computedActiveTables"
                    :key="index"
                    :value="table.id"
                >
                    {{ table.id }}
                </option>
            </select>
        </label>
        <div class="orderList">
            <div
                v-for="(item, index) in orderList"
                :key="index"
                class="orderItem"
            >
                <div class="dishQuantity">
                    <p>
                        {{ `${item.amount} X` }}
                    </p>
                </div>
                <div class="dishImage">
                    <!-- todo: make this dynamic with custom images -->
                    <img
                        src="/dishes/missing.png"
                        :alt="`${item.name} image`"
                    />
                </div>
                <div class="dishName">
                    <p>
                        {{ item.name }}
                    </p>
                </div>
                <div
                    class="noteIndicator"
                    :class="{ noted: item.note.length > 0 }"
                >
                    <div />
                </div>
                <div class="removeDish">
                    <action-button
                        @click-action="$emit('remove-dish', index)"
                        level="high"
                        >Remove</action-button
                    >
                </div>
            </div>
        </div>
        <div v-if="!isDrinks" class="courseListWrapper">
            <div class="courseList">
                <label
                    class="courseItem"
                    v-for="(course, index) in order"
                    :key="index"
                    :class="{ selected: selectedCourse == index }"
                >
                    {{ getLabel(course) }}
                    <input
                        type="radio"
                        name="course"
                        :id="`course${index}`"
                        :value="index"
                        v-model="selectedCourse"
                        hidden
                    />
                </label>
            </div>

            <div class="courseListAdd">
                <div class="addCourse btn" @click="$emit('add-course')"></div>
            </div>
        </div>
        <div class="btnGroup">
            <action-button
                v-if="isDrinks"
                level="action"
                @click-action="$emit('swap')"
                >Courses</action-button
            >
            <action-button v-else level="action" @click-action="$emit('swap')"
                >Drinks</action-button
            >

            <action-button level="action" @click-action="$emit('place-order')"
                >Place Order</action-button
            >

            <action-button
                v-if="isDrinks"
                level="safe"
                @click-action="$emit('move-to-menu-select')"
                >Add Drink</action-button
            >
            <action-button
                v-else
                level="safe"
                @click-action="$emit('move-to-menu-select')"
                >Add Dish</action-button
            >
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            table: this.tableValue,
        };
    },
    props: {
        isDrinks: Boolean,
        showNotification: Boolean,
        notificationContent: String,
        tableValue: String,
        computedActiveTables: Array,
        computedSelectedCourse: Array,
        computed_normal_course: Array,
        computed_drink_course: Array,
        order: Array,
        selectedCourse: Number,
    },
    methods: {
        getLabel(course) {
            if (course.type == "normal") {
                return `course ${
                    this.computed_normal_course.indexOf(course) + 1
                }`;
            } else {
                return `drinks ${
                    this.computed_drink_course.indexOf(course) + 1
                }`;
            }
        },
    },
    computed: {
        orderList() {
            return this.isDrinks
                ? this.order
                : this.order[this.selectedCourse].items;
        },
    },
};
</script>

<style scoped>
#order-root {
    font-size: 3em;
    background-color: var(--mono-light, #ccc);
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100vw;
    height: 100vh;
}

.notification {
    position: absolute;
    top: 0;
    transform: translateY(-100%);
    background-color: white;
    border: solid 1px black;
    border-radius: 0 0 3em 3em;
    padding: 0 2em 2em 2em;
}
.notification.show {
    transform: translateY(0);
    transition: ease-in;
}
.tableSelectWrap {
    display: grid;
    grid-template-columns: 1fr 1fr;
    justify-content: center;
    align-items: center;
    background-color: var(--mono-darker, #000);
    width: 100%;
    color: var(--text-light, #fff);
    font-size: 6rem;
    line-height: 1;
    padding: 3rem;
    text-align: center;
}

.tableSelectWrap select {
    background-color: var(--mono-darker, #000);
    text-align: center;
}
.divider {
    width: 80%;
    height: 2px;
    border: solid 1px black;
}
.orderList {
    display: flex;
    flex-direction: column;
    gap: 5px;
    padding: 2rem;
    min-height: 40%;
    overflow-x: hidden;
    overflow-y: auto;
    width: 100%;
    flex: 1 1 0%;
}
.orderItem {
    display: grid;
    grid-template-columns: 6rem 10rem minmax(0, 1fr) 3rem minmax(0, 1fr);
    padding: 5px;
    gap: 5px;
    background: var(--mono-lighter, #fff);
    height: 10rem;
    border: 2px solid black;
}

.orderItem * {
    max-height: 10rem;
    overflow: hidden;
}

.noteIndicator {
    display: flex;
    justify-content: center;
    align-items: center;
}

.noteIndicator > div {
    height: 2rem;
    width: 2rem;
    border-radius: 50%;
    border: 1px solid black;
}

.noteIndicator.noted > div {
    background-color: black;
}

.dishImage {
    padding: 0.5rem;
}

.dishImage > * {
    display: block;
    position: relative;
    width: 100%;
    height: 100%;
}

.dishName {
    display: flex;
    justify-content: flex-start;
    align-items: center;
}
.dishQuantity {
    display: grid;
    place-content: center;
    white-space: nowrap;
    overflow: visible;
}

.courseListWrapper {
    display: grid;
    width: 100%;
    grid-template-columns: 1fr 10rem;
    height: 10%;
    border-top: 2px solid var(--mono-darker, #000);
    border-bottom: 2px solid var(--mono-darker, #000);
}

.courseList {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    gap: 10px;
    pad: 10px;
    padding: 1rem;
    width: 100%;
    overflow-y: hidden;
    scroll-snap-type: x proximity;
    flex-wrap: wrap;
}

.courseListAdd {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
}

.courseItem {
    border: solid 2px var(--mono-darker, #000);
    padding: 10px;
    flex-shrink: 0;
    white-space: nowrap;
    background-color: var(--mono-dark, #666);
}

.courseItem.selected {
    background-color: var(--nav-active, #666);
}

.removeDish {
    padding: 0.5rem 2rem;
}

.removeDish > * {
    width: 100%;
    height: 100%;
}

.addCourse {
    position: relative;
    order: 9999;
    height: 3em;
    width: 3em;
    flex-shrink: 0;
    border: solid 0px transparent;
    border-radius: 90%;
    /*background: radial-gradient(#fff, #ddd);*/
    background-color: var(--mono-dark, #fff);
    border: 2px solid var(--mono-darker, #000);
    scroll-snap-align: end;
}
.addCourse::before {
    content: " ";
    position: absolute;
    width: 0.5em;
    height: 2em;
    flex-shrink: 0;
    left: calc(50% - 0.25em);
    top: calc(50% - 1em);
    background-color: var(--mono-darker, #000);
}
.addCourse::after {
    content: " ";
    position: absolute;
    width: 2em;
    height: 0.5em;
    flex-shrink: 0;
    left: calc(50% - 1em);
    top: calc(50% - 0.25em);
    background-color: var(--mono-darker, #000);
}

.btnGroup {
    display: flex;
    padding: 1.5rem;
    flex-direction: row;
    justify-content: space-around;
    width: 100%;
}

.btnGroup button {
    padding: 2.5rem 0;
    line-height: 1;
    width: 25rem;
}
</style>
