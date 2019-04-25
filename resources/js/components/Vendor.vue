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
                                    <p>Add Vendor</p>
                                </button>
                                <div v-if="addModal" class="modal is-active">
                                    <div class="modal-background"></div>
                                    <div class="modal-card">
                                        <header class="modal-card-head">
                                            <p class="modal-card-title">Add New Vendor</p>
                                            <button class="delete" aria-label="close" @click="addModal=false"></button>
                                        </header>
                                        <section class="modal-card-body">
                                            <div class="field">
                                                <label class="label">Name</label>
                                                <div class="control">
                                                    <input class="input" type="text" placeholder="Name" v-model="vname">
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Address</label>
                                                <div class="control">
                                                    <textarea class="input" placeholder="Address" v-model="vaddress"></textarea>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Phone number</label>
                                                <div class="control">
                                                    <input class="input" type="number" placeholder="Phone" v-model="vphone">
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
                                    <input class="input" type="text" placeholder="Search Vendor.." v-model="search">
                                </div>
                                <hr>

                                <table class="table is-bordered">
                                    <tr>
                                        <th>Vendor ID</th>
                                        <th>Vendor Name</th>
                                        <th>Vendor Address</th>
                                        <th>Vendor Phone</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr v-for="vendor in filteredVendors">
                                        <td>{{vendor.vid}}</td>
                                        <td>{{vendor.vname}}</td>
                                        <td>{{vendor.vaddress}}</td>
                                        <td>{{vendor.vphone}}</td>
                                        <td>
                                            <a class="button is-info is-outlined is-small" @click="openEdit(vendor)" >
                                <span class="icon is-small">
                                  <i class="fas fa-edit"></i>
                                </span>
                                            </a>
                                            <div v-if="editModal" class="modal is-active">
                                                <div class="modal-background"></div>
                                                <div class="modal-card">
                                                    <header class="modal-card-head">
                                                        <p class="modal-card-title">Edit Vendor</p>
                                                        <button class="delete" aria-label="close" @click="editModal=false"></button>
                                                    </header>
                                                    <section class="modal-card-body">
                                                        <div class="field">
                                                            <label class="label">Name</label>
                                                            <div class="control">
                                                                <input class="input" type="text" placeholder="Name" v-model="formEdit.vname">
                                                            </div>
                                                        </div>

                                                        <div class="field">
                                                            <label class="label">Address</label>
                                                            <div class="control">
                                                                <textarea class="input" placeholder="Address" v-model="formEdit.vaddress"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="field">
                                                            <label class="label">Phone</label>
                                                            <div class="control">
                                                                <input class="input" type="number" placeholder="Phone" v-model="formEdit.vphone">
                                                            </div>
                                                        </div>

                                                    </section>
                                                    <footer class="modal-card-foot">
                                                        <button class="button is-success" @click="saveEdit(formEdit)">Update</button>
                                                        <button class="button" @click="editModal=false">Cancel</button>
                                                    </footer>
                                                </div>
                                            </div>
                                            <a class="button is-danger is-outlined is-small" @click="deleteVendor(vendor.vid)">
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
        name: 'vendor',
        components:{
            'app-header': Header,
            'app-nav-bar': Navbar,
            'app-footer': Footer,
        },

        data(){
            return {
                vendor:{
                    vid: '',
                    vname: '',
                    vaddress:'',
                    vphone:'',
                },
                formEdit: {
                    vid: '',
                    vname: '',
                    vaddress:'',
                    vphone:'',
                },
                formAdd:{
                    vid: '',
                    vname: '',
                    vaddress:'',
                    vphone:'',
                },
                vid: '',
                vname: '',
                vaddress:'',
                vphone:'',
                vendors:[],
                search: '',
                editModal: false,
                addModal: false,
                token: localStorage.getItem('token')
            }
        },

        computed: {
            filteredVendors: function () {
                return this.vendors.filter((vendor)=>{
                    return vendor.vname.toLowerCase().match(this.search.toLowerCase())
                        ||vendor.vaddress.toLowerCase().match(this.search.toLowerCase())
                        ||vendor.vphone.toLowerCase().match(this.search.toLowerCase())
                })
            }
        },

        created(){
            this.fetchVendorList();
        },

        methods: {
            fetchVendorList(){
                axios.get('/vendors')
                    .then(response => this.vendors = response.data)
            },

            deleteVendor(id){
                axios.post('/deleteVendor/'+id)
                    .then(response =>{
                        this.fetchVendorList();
                    })
            },

            openEdit(vendor){
                this.editModal = true;
                this.formEdit = vendor;
                // axios.get('/editingProduct/'+id)
                //     .then(response=>this.formEdit = response.data)
            },
            saveEdit(formEdit){
                axios.post('/editVendor', formEdit)
                    .then(response=>{
                        this.fetchVendorList();
                        alert('Vendor Updated');
                    })
            },
            saveAdd(){
                axios.post('/addVendor',{
                    vname: this.vname,
                    vaddress: this.vaddress,
                    vphone: this.vphone,
                })
                    .then(this.onSuccess)
            },
            onSuccess(){
                alert('Vendor Added');
                this.fetchVendorList();

                this.vname= '';
                this.vaddress= '';
                this.vphone= '';
            }
        }
    }
</script>

<style scoped>

</style>