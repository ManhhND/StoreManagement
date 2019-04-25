<template>
    <header class="hero is-light">
        <div class="hero-head">
            <nav class="navbar has-shadow" role="navigation" aria-label="main navigation" style="background-color: #333;">
                <div class="navbar-brand">
                    <figure @click="redirectHome">
                        <a>
                        <img width="50" height="20" src="http://i1024.photobucket.com/albums/y307/01636323484/download_zpsuqsc7ttr.png" alt="Pain&Gain logo">
                        </a>
                    </figure>
                    <button class="button navbar-burger" data-target="navMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                </div>


                <div class="navbar-menu navbar-end" id="navMenu">
                    <div class="navbar-item has-dropdown is-hoverable" style="color: blueviolet">
                        <a class="navbar-link" >
                            <figure class="image is-32x32" style="margin-right:.5em;">
                                <img src="http://i1024.photobucket.com/albums/y307/01636323484/default-user_zpsr1cwrrhx.png">
                            </figure>
                            <div v-for="user in users" >
                                Hi, {{user.name}}
                            </div>
                        </a>

                        <div class="navbar-dropdown is-right">
                            <a class="navbar-item" @click="redirectProfile">
                              <span class="icon is-small">
                                <i class="fa fa-user-circle"></i>
                              </span>
                                Profile
                            </a>
                            <hr class="navbar-divider">
                            <a class="navbar-item" @click="signOut">
                              <span class="icon is-small">
                                <i class="fa fa-sign-out-alt"></i>
                              </span>
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</template>

<script>
    export default {
        name: "header",
        data(){
          return{
              users:[],

              id:'',
              name:'',
              email:'',
              password: ''
          }
        },
        created() {
            this.getUser();
        },
        methods: {

            getUser(){
                axios.get('/userInfo')
                    .then(response => {
                        this.users = response.data;
                        console.log(this.users.data)
                    })
            },
            signOut(){
                localStorage.removeItem('token');
                this.$router.push('/')
            },
            redirectHome(){
                this.$router.push('/dashboard');
            },
            redirectProfile(){
                this.$router.push('/profile');
            }
        }
    }

</script>

<style scoped>

</style>