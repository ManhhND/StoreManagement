import './bootstrap';
import axios from 'axios';
import router from './routes';


window.Vue = require('vue');

// Vue.component('productList', require('./components/Product'));
Vue.filter('toCurrency', function (value) {
    if (typeof value !== "number") {
        return value;
    }
    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        minimumFractionDigits: 0,
        currency: 'VND',
    });
    return formatter.format(value);
});

new Vue({
    el: '#app',
    router,
    axios,

});
