import router from 'vue-router';
import Dashboard from './components/Dashboard';
import Product from './components/Product';
import Customer from './components/Customer';
import Login from './components/Login';
import Home from './components/Home';
import Sale from './components/Sale';
import User from './components/User';
import Type from './components/ProductType';
import Vendor from './components/Vendor';
import Invoice from './components/Invoice';
import Profile from './components/Profile';
import Cart from './components/ExampleComponent';

export default new router({
    routes: [

        {
            path: '/',
            name: 'login',
            component: Login
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            requiresAuth: true
        },
        {
            path: '/product',
            name: 'product',
            component: Product
        },
        {
            path: '/type',
            name: 'type',
            component: Type
        },
        {
            path: '/vendor',
            name: 'vendor',
            component: Vendor
        },
        {
            path: '/invoice',
            name: 'invoice',
            component: Invoice
        },
        {
            path: '/customer',
            name: 'customer',
            component: Customer
        },
        {
            path: '/user',
            name: 'user',
            component: User
        },
        {
            path: '/profile',
            name: 'profile',
            component: Profile
        },
        {
            path: '/home',
            name: 'Home',
            component: Home
        },
        {
            path: '/sale',
            name: 'sale',
            component: Sale
        },
        {
            path: '/cart',
            component: Cart
        }
    ],
    // mode: 'history',

    linkActiveClass: 'is-active'
});