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
                                    <p>Add Customer</p>
                                </button>
                                <div v-if="addModal" class="modal is-active">
                                    <div class="modal-background"></div>
                                    <div class="modal-card">
                                        <header class="modal-card-head">
                                            <p class="modal-card-title">Add New Customer</p>
                                            <button class="delete" aria-label="close" @click="addModal=false"></button>
                                        </header>
                                        <section class="modal-card-body">
                                            <div class="field">
                                                <label class="label">Name</label>
                                                <div class="control">
                                                    <input class="input" type="text" placeholder="Name" v-model="cname">
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Address</label>
                                                <div class="control">
                                                    <textarea class="input" placeholder="Address" v-model="caddress"></textarea>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Phone number</label>
                                                <div class="control">
                                                    <input class="input" type="number" placeholder="Phone" v-model="cphone">
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Email</label>
                                                <div class="control">
                                                    <input class="input" type="email" placeholder="Email" v-model="cemail">
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
                                    <input class="input" type="text" placeholder="Search Customer.." v-model="search">
                                </div>
                                <hr>

                                <table class="table is-bordered">
                                    <tr>
                                        <th>Customer ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Address</th>
                                        <th>Customer Phone</th>
                                        <th>Customer Email</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr v-for="customer in filteredCustomers">
                                        <td>{{customer.cid}}</td>
                                        <td>{{customer.cname}}</td>
                                        <td>{{ customer.caddress }}</td>
                                        <td>{{customer.cphone}}</td>
                                        <td>{{customer.cemail}}</td>
                                        <td>
                                            <a class="button is-info is-outlined is-small" @click="openEdit(customer)" >
                                                <span class="icon is-small">
                                                  <i class="fas fa-edit"></i>
                                                </span>
                                            </a>
                                            <div v-if="editModal" class="modal is-active">
                                                <div class="modal-background"></div>
                                                <div class="modal-card">
                                                    <header class="modal-card-head">
                                                        <p class="modal-card-title">Edit Customer</p>
                                                        <button class="delete" aria-label="close" @click="editModal=false"></button>
                                                    </header>
                                                    <section class="modal-card-body">
                                                        <div class="field">
                                                            <label class="label">Name</label>
                                                            <div class="control">
                                                                <input class="input" type="text" placeholder="Name" v-model="formEdit.cname">
                                                            </div>
                                                        </div>

                                                        <div class="field">
                                                            <label class="label">Address</label>
                                                            <div class="control">
                                                                <textarea class="input" placeholder="Address" v-model="formEdit.caddress"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="field">
                                                            <label class="label">Phone</label>
                                                            <div class="control">
                                                                <input class="input" type="number" placeholder="Phone" v-model="formEdit.cphone">
                                                            </div>
                                                        </div>

                                                        <div class="field">
                                                            <label class="label">Email</label>
                                                            <div class="control">
                                                                <input class="input" type="email" placeholder="Email" v-model="formEdit.cemail">
                                                            </div>
                                                        </div>

                                                    </section>
                                                    <footer class="modal-card-foot">
                                                        <button class="button is-success" @click="saveEdit(formEdit)">Update</button>
                                                        <button class="button" @click="editModal=false">Cancel</button>
                                                    </footer>
                                                </div>
                                            </div>
                                            <a class="button is-danger is-outlined is-small" @click="deleteCustomer(customer.cid)">
                                                <span class="icon is-small">
                                                  <i class="fas fa-times"></i>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                </table>

                                <div class="modal-footer">
                                    <button class="button is-info" @click="fetchPaginationCustomer(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
                                        Prev
                                    </button>
                                    <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span>
                                    <button class="button is-info" @click="fetchPaginationCustomer(pagination.next_page_url)" :disabled="!pagination.next_page_url">
                                        Next
                                    </button>
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

    export default {
        components:{
            'app-header': Header,
            'app-nav-bar': Navbar,
            'app-footer': Footer,
        },

        data(){
            return {
                customer:{
                    cid: '',
                    cname: '',
                    caddress:'',
                    cphone:'',
                    cemail:''
                },
                formEdit: {
                    cid: '',
                    cname: '',
                    caddress:'',
                    cphone:'',
                    cemail:''
                },
                formAdd:{
                    cid: '',
                    cname: '',
                    caddress:'',
                    cphone:'',
                    cemail:''
                },
                cid: '',
                cname: '',
                caddress:'',
                cphone:'',
                cemail:'',
                customers:[],
                search: '',
                editModal: false,
                addModal: false,
                url: 'customers',
                pagination: []
            }
        },

        computed: {
            filteredCustomers: function () {
                return this.customers.filter((customer)=>{
                    return customer.cname.toLowerCase().match(this.search.toLowerCase())
                        ||customer.caddress.toLowerCase().match(this.search.toLowerCase())
                        ||customer.cphone.toLowerCase().match(this.search.toLowerCase())
                        ||customer.cemail.toLowerCase().match(this.search.toLowerCase())
                })
            }
        },

        created(){
            this.fetchCustomerList();
        },

        methods: {
            fetchCustomerList(){
                let $this = this;
                axios.get(this.url)
                    .then(response => {
                        this.customers = response.data.data;
                        $this.makePagination(response.data)
                    });

            },

            deleteCustomer(id){
                axios.post('/deleteCustomer/'+id)
                    .then(response =>{
                        this.fetchCustomerList();
                    })
            },

            openEdit(customer){
                this.editModal = true;
                this.formEdit = customer;
                // axios.get('/editingProduct/'+id)
                //     .then(response=>this.formEdit = response.data)
            },
            saveEdit(formEdit){
                axios.post('/editCustomer', formEdit)
                    .then(response=>{
                        this.fetchCustomerList();
                        alert('Customer Updated');
                    })
            },
            saveAdd(){
                axios.post('/addCustomer',{
                    cname: this.cname,
                    caddress: this.caddress,
                    cphone: this.cphone,
                    cemail: this.cemail
                })
                    .then(this.onSuccess)
            },
            onSuccess(){
                alert('Customer Added');
                this.fetchCustomerList();

                this.cname= '';
                this.caddress= '';
                this.cphone= '';
                this.cemail= '';
            },
            makePagination(data){
                let pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url
                }
                this.pagination = pagination
            },
            fetchPaginationCustomer(url){
                this.url = url;
                this.fetchCustomerList()
            }
        }
    }
</script>
