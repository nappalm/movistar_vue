
window.Vue = require('vue');

import Vue from 'vue';


//Moment
import moment from 'moment';
moment.locale('es');

//Axios
import axios from 'axios';
window.axios = axios;

//vForm
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

import VueRouter from 'vue-router'
Vue.use(VueRouter)
let routes = [
    //HomePage
    { path: '/home',            component: require('./components/app/PrincipalComponent.vue') },
    // { path: '/experto',            component: require('./components/app/PrincipalComponent.vue') },

    { path: '/pymes',            component: require('./components/pages/PymesComponent.vue') },
]

const router = new VueRouter({
    mode: 'history',
    routes 
})

//Componentes ::
Vue.component('top-bar', require('./components/app/TopBarComponent.vue'));
// Vue.component('home-propio', require('./components/app/channels/PropioHomeComponent.vue'));

const app = new Vue({
    el: '#app',
    router
});