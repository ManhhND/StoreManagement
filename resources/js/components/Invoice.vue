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
                                <button class="button is-success" @click="openSale">
                                    <span class="icon is-small">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <p>Add Invoice</p>
                                </button>

                                <div class="list-group-item">
                                    <input class="input" type="text" placeholder="Search Invoice.." v-model="search">
                                </div>
                                <hr>

                                <table class="table is-bordered">
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Date Created</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr v-for="invoice in invoices">
                                        <td>{{invoice.iid}}</td>
                                        <td>{{invoice.date}}</td>
                                        <td>{{invoice.customer.cname }}</td>
                                        <td>{{invoice.total}}</td>
                                        <td>
                                            <a class="button is-info is-outlined is-small" @click="openEdit(invoice)" >
                                                <span class="icon is-small">
                                                    <i class="fas fa-eye"></i>
                                                </span> <p>Detail</p>
                                            </a>
                                            <div v-if="editModal" class="modal is-active">
                                                <div class="modal-background"></div>
                                                <div class="modal-card">
                                                    <header class="modal-card-head">
                                                        <p class="modal-card-title">Edit Invoice</p>
                                                        <button class="delete" aria-label="close" @click="editModal=false"></button>
                                                    </header>
                                                    <section class="modal-card-body">
                                                        <div class="field">
                                                            <label class="label">Customer</label>
                                                            <div class="control">
                                                                <input class="input" type="text" placeholder="Name" v-model="formEdit.customerID">
                                                            </div>
                                                        </div>

                                                        <div class="field">
                                                            <label class="label">User in Responsibility</label>
                                                            <div class="control">
                                                                <textarea class="input" placeholder="Address" v-model="formEdit.userID"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="field">
                                                            <label class="label">Product</label>
                                                            <div class="control">
                                                                <input class="input" type="number" placeholder="Phone" v-model="formEdit.productID">
                                                            </div>
                                                        </div>

                                                    </section>
                                                    <footer class="modal-card-foot">
                                                        <button class="button is-success" @click="saveEdit(formEdit)">Update</button>
                                                        <button class="button" @click="editModal=false">Cancel</button>
                                                    </footer>
                                                </div>
                                            </div>
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
        name: 'invoice',
        components: {
            'app-header': Header,
            'app-nav-bar': Navbar,
            'app-footer': Footer,
        },
        data(){
            return{
                invoice:{
                    iid: '',
                    date: '',
                    id:'',
                },
                iid: '',
                date: '',
                id:'',
                invoices: [],
                search: '',
                editModal: false,
                addModal: false,
                token: localStorage.getItem('token')
            }
        },
        computed: {
            filteredInvoices: function () {
                return this.invoices.filter((invoice)=>{
                    return invoice.userID.toLowerCase().match(this.search.toLowerCase())
                        ||invoice.customerID.toLowerCase().match(this.search.toLowerCase())
                        ||invoice.productID.toLowerCase().match(this.search.toLowerCase())
                })
            }
        },
        created(){
            this.fetchInvoiceList();
        },

        methods: {
            fetchInvoiceList() {
                axios.get('/invoices')
                    .then(response => this.invoices = response.data)
            },
            openSale(){
                this.$router.push('/sale')
            }
        }
    }
</script>

<style scoped>

</style>