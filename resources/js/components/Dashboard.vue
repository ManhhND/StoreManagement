<template>
    <div>
        <app-header></app-header>
        <div class="wrapper">
            <div class="columns">
                <app-nav-bar></app-nav-bar>
                <main class="column main">
                    <div style="padding: 5px;">
                        <section class="info-tiles">
                            <div class="tile is-ancestor has-text-centered">
                                <div class="tile is-parent">
                                    <article class="tile is-child box">
                                        <p class="title">16,430,000</p>
                                        <p class="subtitle">Revenue</p>
                                    </article>
                                </div>
                                <div class="tile is-parent">
                                    <article class="tile is-child box">
                                        <p class="title">21</p>
                                        <p class="subtitle">Orders</p>
                                    </article>
                                </div>
                                <div class="tile is-parent">
                                    <article class="tile is-child box">
                                        <p class="title">10</p>
                                        <p class="subtitle">New customers</p>
                                    </article>
                                </div>
                                <div class="tile is-parent">
                                    <article class="tile is-child box">
                                        <p class="title">5</p>
                                        <p class="subtitle">New Products</p>
                                    </article>
                                </div>
                            </div>
                        </section>
                        <!-- Events -->
                        <div class="columns">
                            <div class="column is-6">
                                <div class="card events-card">
                                    <header class="card-header">
                                        <p class="card-header-title">
                                            Events
                                        </p>
                                        <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                                        </a>
                                    </header>
                                    <div class="card-table">
                                        <div class="content">
                                            <table class="table is-fullwidth is-striped">
                                                <tbody>
                                                <tr>
                                                    <td width="5%"><i class="fa fa-bell"></i></td>
                                                    <td>Lorum ipsum dolem aire</td>
                                                    <td><a class="button is-small is-primary" href="#">Action</a></td>
                                                </tr>
                                                <tr>
                                                    <td width="5%"><i class="fa fa-bell"></i></td>
                                                    <td>Lorum ipsum dolem aire</td>
                                                    <td><a class="button is-small is-primary" href="#">Action</a></td>
                                                </tr>
                                                <tr>
                                                    <td width="5%"><i class="fa fa-bell"></i></td>
                                                    <td>Lorum ipsum dolem aire</td>
                                                    <td><a class="button is-small is-primary" href="#">Action</a></td>
                                                </tr>
                                                <tr>
                                                    <td width="5%"><i class="fa fa-bell"></i></td>
                                                    <td>Lorum ipsum dolem aire</td>
                                                    <td><a class="button is-small is-primary" href="#">Action</a></td>
                                                </tr>
                                                <tr>
                                                    <td width="5%"><i class="fa fa-bell"></i></td>
                                                    <td>Lorum ipsum dolem aire</td>
                                                    <td><a class="button is-small is-primary" href="#">Action</a></td>
                                                </tr>
                                                <tr>
                                                    <td width="5%"><i class="fa fa-bell"></i></td>
                                                    <td>Lorum ipsum dolem aire</td>
                                                    <td><a class="button is-small is-primary" href="#">Action</a></td>
                                                </tr>
                                                <tr>
                                                    <td width="5%"><i class="fa fa-bell"></i></td>
                                                    <td>Lorum ipsum dolem aire</td>
                                                    <td><a class="button is-small is-primary" href="#">Action</a></td>
                                                </tr>
                                                <tr>
                                                    <td width="5%"><i class="fa fa-bell"></i></td>
                                                    <td>Lorum ipsum dolem aire</td>
                                                    <td><a class="button is-small is-primary" href="#">Action</a></td>
                                                </tr>
                                                <tr>
                                                    <td width="5%"><i class="fa fa-bell"></i></td>
                                                    <td>Lorum ipsum dolem aire</td>
                                                    <td><a class="button is-small is-primary" href="#">Action</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <footer class="card-footer">
                                        <a href="#" class="card-footer-item">View All</a>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <app-footer></app-footer>
    </div>
</template>

<script>
    import Header from './Header';
    import Navbar from './Navbar';
    import Footer from './Footer';
    import auth from "../auth";

    export default {
        components:{
            'app-header': Header,
            'app-nav-bar': Navbar,
            'app-footer': Footer,
        },
        data(){
          return{
              token: localStorage.getItem('token'),
          }
        },
        mounted() {
            if (this.token == null){
                this.$router.push('/')
            }
        }
    }
</script>



// <!--<div>-->
//     <!--<app-header></app-header>-->
//     <!--<div class="wrapper">-->
//         <!--<div class="columns">-->
//             <!--<app-nav-bar></app-nav-bar>-->
//             <!--<main class="column main">-->
//             <!--</main>-->
//         <!--</div>-->
//     <!--</div>-->
//     <!--<app-footer></app-footer>-->
// <!--</div>-->