<template>
    <div id="app">
        <div class="header">
            <h2>Comics</h2>
            <div>
                <button @click="showCart = !showCart" v-show="!verified">
                    {{ items.length + (items.length > 1 || items.length === 0 ? " items" : " item") }}
                </button>
            </div>
        </div>
        <div class="cart" v-show="showCart">
            <div v-show="items.length > 0">
                <ul>
                    <li v-for="item in items" transition="fade">
                        <p><strong>{{ item.quantity }}</strong> - {{ item.name }} <i class="fa fa-trash" @click="removeFromCart(item)"></i></p>
                    </li>
                </ul>
                <div><button @click="verified = true, showCart = false">Check out</button></div>
            </div>
            <div v-show="items.length === 0">
                <p>Your cart is empty!</p>
            </div>
        </div>
        <div class="container">
            <div class="shop" v-show="!verified">
                <h3>New Arrivals</h3>
                <ul>
                    <li v-for="item in shop">
                        <div>
                            <h5>{{ item.name }}</h5>
                            <p>${{ item.price }}</p>
                            <button @click="addToCart(item)">Add to cart</button>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="checkout" v-show="verified">
                <h3>Your Cart</h3>
                <h5 v-for="item in items"><strong>{{ item.quantity }}</strong> - {{ item.name }}<span>${{ item.price * item.quantity }}</span></h5>
                <hr />
                <div class="row">
                    <div class="u-pull-right">
                        <h5>Total: <span>{{ total | currency }}</span></h5>
                        <button>Looks Good</button>
                    </div>
                </div>
            </div>
        </div>
        <ul>
            <li v-for="item in carts">
                {{item.name}}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'cart',
        data() {
            return {
                items: [],
                shop: [
                    {
                        name: "One-Punch Man, Vol. 5",
                        price: 10.02,
                        quantity: 0
                    },
                    {
                        name: "Gantz Omnibus, Vol. 1",
                        price: 22.98,
                        quantity: 0
                    },
                    {
                        name: "Dragon Ball Freeza Arc, Vol. 1",
                        price: 15.98,
                        quantity: 0
                    },
                    {
                        name: "Uzumaki: Spiral into Horror, Vol. 1",
                        price: 4.84,
                        quantity: 0
                    },
                    {
                        name: "Superman: Red Son (New Edition)",
                        price: 10.93,
                        quantity: 0
                    }
                ],
                carts:[
                    {name: 'aa'},
                    {name: 'bb'},
                    {name: 'cc'}
                ],
                showCart: false,
                verified: false,
                quantity: 1
            }
        },
        computed: {
            total() {
                var total = 0;
                for(var i = 0; i < this.items.length; i++) {
                    total += this.items[i].price;
                }
                return total;
            }
        },
        methods: {
            addToCart(item) {
                item.quantity += 1;
                this.items.push(item);
            },
            removeFromCart(item) {
                item.quantity -= 1;
                this.items.splice(this.items.indexOf(item), 1);
            }
        }
    }
</script>

<style scoped>
    body {
        height: 100%;
        background: linear-gradient(to top, #FF6B83, #ffb8c3) no-repeat fixed;
    }

    #app {
        font-family: 'Roboto Slab', serif;
    }

    .header {
        height: 80px;
    }
    .header h2 {
        color: #fff;
        font-family: 'Rock Salt';
        float: left;
        font-weight: bolder;
        margin: 10px 20px;
    }
    .header button {
        border: 0;
        background: #FFDBE0;
        transition: all .1s ease-out;
    }
    .header button:hover {
        background: #ffd1d7;
    }
    .header div {
        float: right;
        display: inline;
        margin: 10px;
    }

    li {
        list-style: none;
    }

    .fa {
        cursor: pointer;
        margin-left: 5px;
    }

    .fade-transition {
        transition: all 0.2s ease-out;
    }

    .fade-enter, .fade-leave {
        opacity: 0;
    }

    .cart > div {
        z-index: 100;
        background: #fff;
        padding: 20px 30px;
        position: absolute;
        right: 30px;
        box-shadow: 2px 2px 6px 0 rgba(0, 0, 0, 0.3);
    }
    .cart > div div {
        text-align: center;
    }
    .cart ul, .cart li, .cart p {
        margin-bottom: 0;
    }
    .cart button {
        margin: 20px 0 10px;
        text-transform: uppercase;
        text-decoration: none;
        font-weight: bold;
        letter-spacing: 2px;
    }
    .cart input {
        width: 30px;
    }

    .shop h3 {
        position: absolute;
        top: -85px;
        left: -30px;
        color: rgba(255, 255, 255, 0.3);
        font-family: sans-serif;
        font-size: 4em;
        font-weight: bold;
        letter-spacing: -2px;
    }
    .shop ul {
        margin-top: 90px;
    }
    .shop li div {
        padding: 30px;
        background: #fff;
        margin-bottom: 20px;
        box-shadow: 1px 1px 6px 0 rgba(0, 0, 0, 0.3);
    }
    .shop button {
        color: white;
        border: 0;
        background: #00ADB5;
        margin: 0;
        transition: all .1s ease-out;
    }
    .shop button:hover {
        background: #00959c;
    }

    .checkout {
        background: #fff;
        box-shadow: 1px 1px 6px 0 rgba(0, 0, 0, 0.3);
        margin-top: 90px;
        padding: 50px 60px;
    }
    .checkout h3 {
        position: absolute;
        top: -85px;
        left: -30px;
        color: rgba(255, 255, 255, 0.3);
        font-family: sans-serif;
        font-size: 4em;
        font-weight: bold;
        letter-spacing: -2px;
    }
    .checkout span {
        float: right;
    }

    @media screen and (max-width: 630px) {
        .checkout {
            padding: 30px 40px;
        }
        .checkout h5 {
            font-size: 1.2em;
        }
    }
    @media screen and (max-width: 550px) {
        .shop h3, .checkout h3 {
            font-size: 3.3em;
            top: -70px;
            left: 0px;
        }
    }
</style>
