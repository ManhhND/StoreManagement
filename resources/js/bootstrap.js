import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import auth from "./auth";


window.auth = require('../js/auth');
window.Popper = require('popper.js').default;
window._ = require('lodash');



window.Vue = Vue;
Vue.use(VueRouter);
window.axios = axios;



window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Authorization'] = 'Bearer ' +localStorage.getItem('token');


export default {
    beforeRouteEnter: function (to, from, next) {
        auth.checkToken()
        // called before the route that renders this component is confirmed.
        // does NOT have access to `this` component instance,
        // because it has not been created yet when this guard is called!
    },
}

axios.interceptors.response.use(undefined, err=>{
    let res = err.response;
    if (res.status === 401){
        localStorage.removeItem('token');
        window.location.replace('');
        alert('You must log in first')
    }
});

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */
//
// let token = document.head.querySelector('meta[name="csrf-token"]');
//
// if (token) {
//     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// } else {
//     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
// }

