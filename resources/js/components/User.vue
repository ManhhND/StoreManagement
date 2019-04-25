<template>
    <div>
        <app-header></app-header>
        <div class="wrapper">
            <div class="columns">
                <app-nav-bar></app-nav-bar>
                <main class="column main">
                    <div class="container" style="padding: 5px">
                        <div class="row">
                            <div class="col-md-11">
                                <button class="button is-success" @click="addModal=true">
                    <span class="icon is-small">
                        <i class="fas fa-plus"></i>
                    </span>
                                    <p>Add User</p>
                                </button>
                                <div v-if="addModal" class="modal is-active">
                                    <div class="modal-background"></div>
                                    <div class="modal-card">
                                        <header class="modal-card-head">
                                            <p class="modal-card-title">Add New User</p>
                                            <button class="delete" aria-label="close" @click="addModal=false"></button>
                                        </header>
                                        <section class="modal-card-body">
                                            <div class="field">
                                                <label class="label">Name</label>
                                                <div class="control">
                                                    <input class="input" type="text" placeholder="Name" v-model="name">
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Email</label>
                                                <div class="control">
                                                    <input class="input" type="text" placeholder="Email" v-model="email"/>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Password</label>
                                                <div class="control">
                                                    <input class="input" type="password" placeholder="Password" v-model="password">
                                                </div>
                                            </div>

                                        </section>
                                        <footer class="modal-card-foot">
                                            <button class="button is-success" @click="saveAdd">Save</button>
                                            <button class="button" @click="addModal=false">Cancel</button>
                                        </footer>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <input class="input" type="text" placeholder="Search User.." v-model="search">
                                </div>
                                <hr>

                                <table class="table is-bordered">
                                    <tr>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr v-for="user in filteredUsers">
                                        <td>{{user.id}}</td>
                                        <td>{{user.name}}</td>
                                        <td>{{user.email}}</td>
                                        <td>
                                            <a class="button is-info is-outlined is-small" @click="openEdit(user)" >
                                <span class="icon is-small">
                                  <i class="fas fa-edit"></i>
                                </span>
                                            </a>
                                            <div v-if="editModal" class="modal is-active">
                                                <div class="modal-background"></div>
                                                <div class="modal-card">
                                                    <header class="modal-card-head">
                                                        <p class="modal-card-title">Edit User</p>
                                                        <button class="delete" aria-label="close" @click="editModal=false"></button>
                                                    </header>
                                                    <section class="modal-card-body">
                                                        <div class="field">
                                                            <label class="label">Name</label>
                                                            <div class="control">
                                                                <input class="input" type="text" placeholder="Name" v-model="formEdit.name">
                                                            </div>
                                                        </div>

                                                        <div class="field">
                                                            <label class="label">Email</label>
                                                            <div class="control">
                                                                <input class="input" type="text" placeholder="Email" v-model="formEdit.email">
                                                            </div>
                                                        </div>

                                                        <div class="field">
                                                            <label class="label">New Password</label>
                                                            <div class="control">
                                                                <input class="input" type="password" placeholder="Enter new password" v-model="formEdit.password">
                                                            </div>
                                                        </div>

                                                    </section>
                                                    <footer class="modal-card-foot">
                                                        <button class="button is-success" @click="saveEdit(formEdit)">Update</button>
                                                        <button class="button" @click="editModal=false">Cancel</button>
                                                    </footer>
                                                </div>
                                            </div>
                                            <a class="button is-danger is-outlined is-small" @click="deleteUser(user.id)">
                                                <span class="icon is-small">
                                                  <i class="fas fa-times"></i>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                </table>

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

    export default {
        name: "user",
        components:{
            'app-header': Header,
            'app-nav-bar': Navbar,
            'app-footer': Footer,
        },
        data(){
            return {
                user:{
                    id: '',
                    name: '',
                    email:'',
                    password: ''
                },
                formEdit: {
                    id: '',
                    name: '',
                    email:'',
                    password: ''
                },
                formAdd:{
                    id: '',
                    name: '',
                    email:'',
                    password: ''
                },
                id: '',
                name: '',
                email:'',
                password: '',
                users:[],
                search: '',
                editModal: false,
                addModal: false,
                token: localStorage.getItem('token')
            }
        },

        computed: {
            filteredUsers: function () {
                return this.users.filter((user)=>{
                    return user.name.toLowerCase().match(this.search.toLowerCase())
                        ||user.email.toLowerCase().match(this.search.toLowerCase())
                        ||user.password.toLowerCase().match(this.search.toLowerCase())
                })
            }
        },

        created(){
            this.fetchUserList();
        },

        methods: {
            fetchUserList() {
                axios.get('/users')
                    .then(response => this.users = response.data)
            },

            deleteUser(id) {
                axios.post('/deleteUser/' + id)
                    .then(response => {
                        this.fetchUserList();
                    })
            },

            openEdit(user) {
                this.editModal = true;
                this.formEdit = user;
                // axios.get('/editingUser/'+id)
                //     .then(response=>this.formEdit = response.data)
            },
            saveEdit(formEdit) {
                axios.post('/editUser', formEdit)
                    .then(response => {
                        this.fetchUserList();
                        alert('User Updated');
                    })
            },
            saveAdd() {
                axios.post('/addUser', {
                    name: this.name,
                    email: this.email,
                    password: this.password
                })
                    .then(this.onSuccess)
            },
            onSuccess() {
                alert('User Added');
                this.fetchUserList();

                this.name = '';
                this.email = '';
                this.password = ''
            }
        }
    }
</script>

<style scoped>

</style>