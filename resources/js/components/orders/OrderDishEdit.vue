<template>
    <div id="order-root">
        <div class="menuItemRoot">
            <div class="menuItemName">
                <h1>
                    {{ selectedDish.name }}
                </h1>
            </div>
            <div class="menuItemDetails">
                <template v-if="isDish">
                    <h2>Dish Information</h2>
                    <p>
                        {{ selectedDish.details }}
                    </p>
                </template>
                <template v-else>
                    <h2>Alcohol content</h2>
                    <p class="alcohol-content">
                        {{ selectedDish.alcohol_content }}%
                    </p>
                </template>
            </div>
            <div class="menuItemAllergyDetails">
                <h2>Allergy Information</h2>
                <p>
                    {{ selectedDish.allergy }}
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
                    :value="value"
                    @input="$emit('change', $event.target.value)"
                >
                </textarea>
            </div>
            <div class="quantitySlector">
                <div
                    class="decQuantity btn"
                    @click="quantity > 1 ? $emit('add-to-quantity', -1) : ''"
                >
                    -
                </div>
                <input
                    type="text"
                    pattern="\d*"
                    class="curentQuantity"
                    :value="quantity"
                />
                <div
                    class="incQuantity btn"
                    @click="$emit('add-to-quantity', 1)"
                >
                    +
                </div>
            </div>
            <div class="btnWrap">
                <action-button
                    level="action"
                    class="backBtn"
                    @click-action="$emit('back')"
                    >Back</action-button
                >
                <action-button
                    level="safe"
                    class="addMenuItemBtn btn"
                    @click-action="$emit('add')"
                >
                    Add to Order
                </action-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    model: {
        prop: "value",
        event: "change",
    },
    props: {
        value: String,
        selectedDish: Object,
        quantity: Number,
        isDish: Boolean,
    },
};
</script>

<style scoped>
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

.alcohol-content {
    font-size: 10rem;
    font-weight: bold;
    text-align: center;
}
</style>
