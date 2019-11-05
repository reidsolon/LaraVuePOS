/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

const moment = require('moment')
require('moment/locale/en-au')
 
Vue.use(require('vue-moment'), {
    moment
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('Navigation', require('./components/NavigationComponent.vue').default);

//Reusable Components
Vue.component('category-table-item', require('./components/Modules/ReusableComponents/CategoryTableItem.vue').default);

//Item Purchase
Vue.component('item-list', require('./components/Modules/Item_purchases/ItemList.vue').default);

//MasterFiles
Vue.component('category-list', require('./components/Modules/Master_files/ItemCategoriesList.vue').default);
Vue.component('category-view', require('./components/Modules/Master_files/ItemCategoryView.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
