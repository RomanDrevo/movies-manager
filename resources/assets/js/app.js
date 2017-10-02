
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueResource from 'vue-resource';

import VueSweetAlert from 'vue-sweetalert';

import Modal from './components/Modal.vue';
import MovieRow from './components/MovieRow.vue';
import Pagination from './components/Pagination.vue';

Vue.use(VueResource);

Vue.use(VueSweetAlert);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('movie', require('./components/Movies.vue'));
Vue.component('modal', require ('./components/Modal.vue'));
Vue.component('movie-row', require ('./components/MovieRow.vue'));
Vue.component('pagination', require ('./components/Pagination.vue'));


const app = new Vue({
    el: '#app'
});



