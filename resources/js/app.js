/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
require("select2");
require("smartwizard/dist/css/smart_wizard_all.css");
const cors = require("cors");
// cors({ origin: "http://localhost:8000", optionsSuccessStatus: 200 });
// CommonJS
const Swal = require('sweetalert2');

import $ from "jquery";
window.$ = window.jQuery = $;
import "jquery-ui/ui/widgets/datepicker.js";

import vuetify from "./vuetify";
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

//Purchased Request
// Vue.component('purchase-request-component', require('./components/PurchaseRequestComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });

const app = new Vue({
    el: "#app",
    vuetify,
    // components: {
    //     'navbar': require('./components/ExampleComponent.vue'),
    // }
});
