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
                :class="{ selected: selectedCourse == index }"
            >
                course {{ index + 1 }}
                <input
                    type="radio"
                    name="course"
                    :id="`course${index}`"
                    :value="index"
                    v-model="selectedCourse"
                    hidden
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
            <!-- todo: implement properly-->
            <action-button v-for="i in 5" class="dishCategory">
                <img src="/dishes/missing.png" />
            </action-button>
        </div>
        <div class="filteredDishes">
            <action-button
                v-for="(item, index) of dish_data"
                :key="index"
                @click-action="selectMenuItem(index)"
                class="menuItem"
            >
                <!-- TODO add src when images are availible -->
                <div class="menuImage">
                    <img src="/dishes/missing.png" alt="`${item.name} image`" />
                </div>
                <div class="menuName">
                    <p>{{ item.name }}</p>
                </div>
            </action-button>
        </div>
        <action-button
            level="action"
            class="backBtn"
            @click-action="state = 'new'"
            >Back</action-button
        >
    </div>
    <div id="order-root" v-else-if="state == 'details'">
        <div class="menuItemRoot">
            <div class="menuItemName">
                <h1>
                    {{ dish_data[selectedDish].name }}
                </h1>
            </div>
            <div class="menuItemDetails">
                <h2>Dish Information</h2>
                <p>
                    {{ dish_data[selectedDish].details }}
                </p>
            </div>
            <div class="menuItemAllergyDetails">
                <h2>Allergy Information</h2>
                <p>
                    {{ dish_data[selectedDish].allergy }}
                </p>
            </div>
            <div class="orderItemNotes">
                <h2>Notes</h2>
                <textarea
                    name="note"
                    id="note"
                    cols="30"
                    rows="4"
                    placeholder="Notes..."
                    v-model="menuItemNotes"
                >
                </textarea>
            </div>
            <div class="quantitySlector">
                <div
                    class="decQuantity btn"
                    @click="
                        selectedQuantity > 1 ? (selectedQuantity += -1) : ''
                    "
                >
                    -
                </div>
                <input
                    type="text"
                    pattern="\d*"
                    class="curentQuantity"
                    v-model="selectedQuantity"
                />
                <div class="incQuantity btn" @click="selectedQuantity += 1">
                    +
                </div>
            </div>
            <div class="btnWrap">
                <action-button
                    level="action"
                    class="backBtn"
                    @click="state = 'select'"
                    >Back</action-button
                >
                <action-button
                    level="safe"
                    class="addMenuItemBtn btn"
                    @click="addToOrder()"
                >
                    Add to Order
                </action-button>
            </div>
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

.menuItem .inner {
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
/* tab 3 styles */
.quantitySlector {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    gap: 1em;
    width: 100%;
    padding: 0 1rem;
}
.curentQuantity {
    flex-shrink: 1;
    text-align: center;
    height: 3em;
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
    justify-content: space-around;
    align-items: center;
    width: 100%;
}

.btnWrap button {
    width: 20rem;
}

.menuItemRoot {
    height: 100vh;
    width: 100%;
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 15vh repeat(3, minmax(0, 1fr)) repeat(2, 10vh);
}

.menuItemName {
    background-color: var(--mono-darker);
    color: var(--mono-lighter);
    font-size: 6rem;
    line-height: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.menuItemName h1 {
    text-align: center;
}

.menuItemDetails,
.menuItemAllergyDetails,
.orderItemNotes {
    display: flex;
    flex-direction: column;
    width: 100%;
}

.menuItemDetails h2,
.menuItemAllergyDetails h2,
.orderItemNotes h2 {
    font-size: 3.75rem;
    line-height: 1;
    text-align: center;
    font-weight: bold;
}

.orderItemNotes textarea {
    width: calc(100% - 2rem);
    height: auto;
    background-color: var(--mono-lighter);
    border: 2px solid var(--mono-darker);
    margin: 1rem;
}

.menuItemDetails p,
.menuItemAllergyDetails p {
    width: calc(100% - 2rem);
    flex: 1 1 0%;
    margin: 1rem;
    background-color: var(--mono-lighter);
    border: 2px solid var(--mono-darker);
}
</style>
