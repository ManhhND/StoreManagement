<template>
        <div class="hero is-success is-fullheight">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <div class="column is-4 is-offset-4">
                        <div class="box">
                            <div class="title has-text-grey">WELCOME</div>
                            <form @submit.prevent="getLogInfo">
                                <div class="field">
                                    <div class="control">
                                        <input class="input is-large" type="text" name="name" v-model="email" placeholder="Your Email" autofocus="">
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <input class="input is-large" type="password" name="password" v-model="password" placeholder="Your Password">
                                    </div>
                                </div>
                                <button class="button is-info is-large" type="submit">Sign In</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
    export default {
        data(){
            return{
                email: '',
                password: '',
                token: '',
            }
        },
        created(){
          let token = localStorage.getItem('token')
          if (token !== null){
              this.$router.push('dashboard')
          }
        },
        methods:{
            getLogInfo(){
                axios.post('/login',{
                    email:this.email,
                    password:this.password
                })
                    .then(response=>{
                        let token= response.data.token;
                        if(token){
                            localStorage.setItem('token',token);
                            this.$router.push('/dashboard');
                            window.axios.defaults.headers.common['Authorization'] = 'Bearer ' +localStorage.getItem('token');

                        } else {alert('Invalid login credentials!')}
                        console.log(token);

                    })
            }
        }
    }
</script>
