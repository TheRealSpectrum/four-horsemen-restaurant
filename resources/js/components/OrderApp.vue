<template>
    <div id="order-root" class="new" v-if="state == 'new'">
        <div class="notification" :class="showNoteification ? 'show' : ''">
            <p>{{ norificationContent }}</p>
        </div>
        <label class="tableSelectWrap">
            <h3>table</h3>
            <select
                name="table"
                id="table"
                v-model="table"
                @change="checkTable()"
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
                v-for="(item, index) in order[selectedCourse]"
                :key="index"
                class="orderItem"
            >
                <div class="dishImage">
                    <!-- todo: make this dynamic with custom images -->
                    <img src="/dishes/missing.png" />
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
                        @click-action="removeDish(index)"
                        level="high"
                        >Remove</action-button
                    >
                </div>
            </div>
        </div>
        <div class="courseList">
            <label
                class="courseItem"
                v-for="(course, index) in order"
                :key="index"
                :class="selectedCourse == index"
            >
                course {{ index + 1 }}
                <input
                    type="radio"
                    name="course"
                    :id="`course${index}`"
                    :value="index"
                    v-model="selectedCourse"
                />
            </label>
            <div class="addCourse btn" @click="addCourse()"></div>
        </div>
        <div class="btnGroup">
            <action-button level="action" @click-action="moveToMenuSelect()"
                >Add Dish</action-button
            >
            <action-button level="safe">Place Order</action-button>
        </div>
    </div>
    <div id="order-root" v-else-if="state == 'select'">
        <div class="dishCategorySelect">
            <!-- TODO add when catogorys are made -->
        </div>
        <div class="filteredDishes">
            <div
                class="menuItem btn"
                v-for="(item, index) in dish_data"
                :key="index"
                @click="selectMenuItem(index)"
            >
                <!-- TODO add src when images are availible -->
                <img src="" :alt="`${item.name} image`" class="menuImage" />
                <p class="menuName">{{ item.name }}</p>
            </div>
        </div>
        <div class="backBtn btn" @click="state = 'new'">Back</div>
    </div>
    <div id="order-root" v-else-if="state == 'details'">
        <div class="menuItemName">
            {{ dish_data[selectedDish].name }}
        </div>
        <div class="menuItemDetails">
            {{ dish_data[selectedDish].details }}
        </div>
        <div class="menuItemAllergyDetails">
            {{ dish_data[selectedDish].allergy }}
        </div>
        <textarea
            name="note"
            id="note"
            cols="30"
            rows="10"
            class="orderItemNotes"
            placeholder="Notes..."
            v-model="menuItemNotes"
        >
        </textarea>
        <div class="divider"></div>
        <div class="quantitySlector">
            <div
                class="decQuantity btn"
                @click="selectedQuantity > 1 ? (selectedQuantity += -1) : ''"
            >
                -
            </div>
            <input
                type="text"
                pattern="\d*"
                class="curentQuantity"
                v-model="selectedQuantity"
            />
            <div class="incQuantity btn" @click="selectedQuantity += 1">+</div>
        </div>
        <div class="divider"></div>
        <div class="btnWrap">
            <div class="backBtn btn" @click="state = 'select'">Back</div>
            <div class="addMenuItemBtn btn" @click="addToOrder()">
                Add to Order
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        reservation_data: Array,
        table_data: Array,
        dish_data: Array,
    },
    data() {
        return {
            //state management
            state: "new",
            selectedDish: undefined,
            selectedCourse: 0,
            selectedDishFilter: undefined,
            showNoteification: false,
            norificationContent: "",

            //menu item input
            selectedQuantity: 1,
            menuItemNotes: undefined,

            //curent order
            order: [],
            table: "",
            currentItemDetails: {},
        };
    },
    computed: {
        computedActiveTables() {
            return this.table_data.filter((i) => i.active == 1);
        },
    },
    methods: {
        removeDish(index) {
            delete this.order[this.selectedCourse][index];
            this.order[this.selectedCourse] = this.order[
                this.selectedCourse
            ].filter((i) => {
                return i;
            });
        },
        addCourse() {
            this.order.push([]);
        },
        moveToMenuSelect() {
            this.state = "select";
        },
        selectMenuItem(index) {
            if (index != this.selectedDish) {
                this.menuItemNotes = undefined;
                this.selectedQuantity = 1;
            }
            this.state = "details";
            this.selectedDish = index;
        },
        addToOrder() {
            let itemToAdd = this.dish_data[this.selectedDish];
            itemToAdd["amount"] = this.selectedQuantity;
            itemToAdd["note"] = this.menuItemNotes ?? "";
            this.order[this.selectedCourse].push(itemToAdd);
            this.menuItemNotes = undefined;
            this.selectedQuantity = 1;
            this.selectedDish = undefined;
            this.selectedDishFilter = undefined;
            this.state = "new";
        },
        checkTable() {
            let related = "";
            this.table_data[this.table - 1]?.reservations.forEach(
                (reservation) => {
                    if (reservation.active) {
                        related = [];
                        this.reservation_data[
                            reservation.id - 1
                        ].tables.forEach((table) => {
                            related.push(table.id);
                        });
                    }
                }
            );
            if (this.table != related[0]) {
                this.table = related[0];
                this.norificationContent = `changed table to ${related[0]} due to group assignment`;
                this.showNoteification = true;
                setTimeout(() => {
                    this.showNoteification = false;
                    console.log("timeout");
                    this.norificationContent = "";
                }, 2000);
            }
        },
    },
};
</script>

<style>
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
.btn {
    user-select: none;
    cursor: pointer;
    display: grid;
    place-content: center;
}
/* tab 1 styles */
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
    grid-template-columns: 10rem minmax(0, 1fr) 3rem minmax(0, 1fr);
    padding: 5px;
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
    justify-content: start;
    align-items: center;
}

.courseList {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    gap: 10px;
    pad: 10px;
    height: 10%;
    width: 100%;
    overflow-x: auto;
    overflow-y: hidden;
    scroll-snap-type: x proximity;
    border-top: 2px solid var(--mono-darker, #000);
    border-bottom: 2px solid var(--mono-darker, #000);
}
.courseItem {
    border: solid 2px var(--mono-darker, #000);
    padding: 10px;
    flex-shrink: 0;
    white-space: nowrap;
    background-color: var(--mono-dark, #666);
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
/* tab 2 styles */
.dishCategorySelect {
    display: flex;
    flex-direction: row;
    width: 80%;
    height: 15vh;
    overflow-x: auto;
    overflow-y: hidden;
}
.filteredDishes {
    display: flex;
    flex-direction: column;
    width: 80%;
    height: 70vh;
    overflow-x: hidden;
    overflow-y: auto;
}
.menuItem {
    display: flex;
    flex-direction: row;
    width: 100%;
    height: 4em;
    overflow-y: hidden;
    overflow-x: hidden;
}
.menuImage {
    width: 4em;
    height: 4em;
    object-fit: cover;
}
.backBtn {
    color: white;
    background-color: #fd0000;
    padding: auto;
    margin: 3em;
}
/* tab 3 styles */
.quantitySlector {
    display: flex;
    flex-direction: row;
    gap: 1em;
    width: 80%;
}
.curentQuantity {
    flex-shrink: 1;
    text-align: center;
}
.incQuantity {
    width: 3em;
    height: 3em;
    flex-shrink: 0;
    padding: auto;
    display: grid;
    place-content: center;
    border: solid 1px black;
}
.decQuantity {
    width: 3em;
    height: 3em;
    flex-shrink: 0;
    padding: auto;
    display: grid;
    place-content: center;
    border: solid 1px black;
}
.btnWrap {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 80%;
}
</style>
