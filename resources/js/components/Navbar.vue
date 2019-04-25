<template>
    <aside class="column is-2 aside" style="background-color: yellow">
        <nav class="menu">
            <p class="menu-label">
                <b>GENERAL</b>
            </p>
            <ul class="menu-list">
                <router-link to="/dashboard" tag="li" exact>
                    <a>
                        <span class="icon is-small"><i class="fa fa-chalkboard"></i></span>
                        Dashboard
                    </a>
                </router-link>
            </ul>
            <p class="menu-label">
                <b>Administration</b>
            </p>
            <ul class="menu-list">
                <router-link tag="li" to="/sale">
                    <a>
                        <span class="icon is-small"><i class="fa fa-shopping-cart"></i></span>
                        Sale
                    </a>
                </router-link>
                <router-link tag="li" to="/product">
                    <a>
                        <span class="icon is-small"><i class="fa fa-cube"></i></span>
                        Product
                    </a>
                </router-link>
                <router-link tag="li" to="/type">
                    <a>
                        <span class="icon is-small"><i class="fa fa-list-ul"></i></span>
                        Product Type
                    </a>
                </router-link>
                <router-link tag="li" to="/invoice">
                    <a>
                        <span class="icon is-small"><i class="fa fa-file-invoice"></i></span>
                        Invoice
                    </a>
                </router-link>
                <router-link tag="li" to="/user">
                    <a>
                        <span class="icon is-small"><i class="fa fa-user"></i></span>
                        User
                    </a>
                </router-link>
                <router-link tag="li" to="/customer">
                    <a>
                        <span class="icon is-small"><i class="fa fa-users"></i></span>
                        Customer
                    </a>
                </router-link>
                <router-link tag="li" to="/vendor">
                    <a>
                        <span class="icon is-small"><i class="fa fa-industry"></i></span>
                        Vendor
                    </a>
                </router-link>
            </ul>
        </nav>
    </aside>
</template>

<script>
    export default {
        name: "navbar"
    }
</script>

<style scoped>

</style>