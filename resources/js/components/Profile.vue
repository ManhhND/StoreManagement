<template>
    <div>
        <app-header></app-header>
        <div class="wrapper">
            <div class="columns">
                <app-nav-bar></app-nav-bar>
                <main class="column main">
                    <div class="wrap">
                        <table>
                            <tr>
                                <td>
                                    <div class="right-side" v-for="user in users">
                                        <div class="field">
                                            <label class="label">Name</label>
                                            <div class="control">
                                                <input class="input" type="text" v-model="user.name">
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Email</label>
                                            <div class="control">
                                                <input class="input" type="text" v-model="user.email">
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Password</label>
                                            <div class="control">
                                                <input class="input" type="password" v-model="user.password">
                                            </div>
                                        </div>

                                        <button class="button is-success is-right" @click="saveEdit(user)">Save Changes</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
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

    export default {
        name: "profile",
        components:{
            'app-header': Header,
            'app-nav-bar': Navbar,
            'app-footer': Footer,

        },
        data(){
            return {
                users:[],
                user: {
                    id:'',
                    name:'',
                    email:'',
                    password: '',
                },
                id:'',
                name:'',
                email:'',
                password: '',
                image: ''
            }
        },
        created(){
            this.getUser()
        },
        methods:{
            getUser(){
                axios.get('/userInfo')
                    .then(response => this.users = response.data)
            },
            saveEdit(user){
                axios.post('/editUser', user)
                    .then(response => {
                        this.getUser();
                        alert('User Updated');
                    })
            },
            // imgChange(e) {
            //     //console.log(e.target.files[0])
            //     var reader = new FileReader();
            //
            //         // reader.onload = function (e) {
            //         //     $('#blah')
            //         //         .attr('src', e.target.result);
            //         // };
            //
            //     reader.readAsDataURL(e.target.files[0]);
            //     reader.onload = (e) =>{
            //         this.user.image = e.target.result
            //     }
            //     console.log(this.user)
            // }
        }
    }
</script>

<style scoped>
    .wrap{
        padding: 5px;
        display: inline;
    }
    .left-side{
        border-right: 1px solid #818182;
        width: 30%;
    }
    .right-side{
        width: 100%;
    }
    .right-side button{
        margin-left: 629px;
    }
    table td{
        padding: 5px;
    }
    table{
        width: 100%;
    }
</style>