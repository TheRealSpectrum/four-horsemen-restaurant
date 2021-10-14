/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { stringify } = require("postcss");

require("./bootstrap");

window.Vue = require("vue").default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "edit-component",
    require("./components/SearchReservations.vue").default
);

Vue.component(
    "table-select-component",
    require("./components/AvailibleTableSelect.vue").default
);

Vue.component("order-app", require("./components/OrderApp.vue").default);

Vue.component(
    "index-list",
    require("./components/management/IndexList.vue").default
);

Vue.component(
    "index-new",
    require("./components/management/IndexNew.vue").default
);

Vue.component(
    "index-list-inline-edit",
    require("./components/management/IndexListInlineEdit.vue").default
);

Vue.component(
    "ingredient-input",
    require("./components/management/IngredientInput.vue").default
);

Vue.component(
    "ingredient-display",
    require("./components/management/IngredientDisplay.vue").default
);

Vue.component(
    "kitchen-app",
    require("./components/kitchen/KitchenApp.vue").default
);

Vue.component(
    "kitchen-item",
    require("./components/kitchen/KitchenItem.vue").default
);

Vue.component(
    "kitchen-item-box",
    require("./components/kitchen/KitchenItemBox.vue").default
);

Vue.component(
    "kitchen-page",
    require("./components/kitchen/KitchenPage.vue").default
);

Vue.component(
    "action-button",
    require("./components/ActionButton.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
