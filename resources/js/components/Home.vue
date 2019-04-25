<template>
    <div>
        <app-header></app-header>
        <div class="wrapper">
            <div class="columns">
                <app-nav-bar></app-nav-bar>
            </div>
        </div>

        <app-footer></app-footer>
    </div>
</template>

<script>
    import Header from './Header';
    import Navbar from './Navbar';
    import Footer from './Footer';
    import Product from './Product';
    export default {
        name: "home",
        components:{
            'app-header': Header,
            'app-nav-bar': Navbar,
            'app-footer': Footer,
            'app-product': Product,
        }
    }
</script>

<style scoped>

</style>