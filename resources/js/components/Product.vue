<template>
    <div>
        <app-header></app-header>
        <div class="wrapper">
            <div class="columns">
                <app-nav-bar></app-nav-bar>
                <main class="column main">
                    <div style="padding: 5px">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="button is-success" @click="openAdd">
                                <span class="icon is-small">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <p>Add Product</p>
                            </button>
                            <div v-if="addModal" class="modal is-active" >
                                <div class="modal-background"></div>
                                <div class="modal-card">
                                    <header class="modal-card-head">
                                        <p class="modal-card-title">Add New Product</p>
                                        <button class="delete" aria-label="close" @click="addModal=false"></button>
                                    </header>
                                    <section class="modal-card-body">
                                        <div class="field">
                                            <label class="label">Name</label>
                                            <div class="control">
                                                <input class="input" type="text" placeholder="Name" v-model="pname">
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Product Type</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select v-model="tid">
                                                        <option v-for="type in types" :value="type.tid">{{type.tname}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Price</label>
                                            <div class="control">
                                                <input class="input" type="text" placeholder="Price" v-model="price">
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Quantity</label>
                                            <div class="control">
                                                <input class="input" type="number" placeholder="Quantity" v-model="quantity">
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">VendorID</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select v-model="vid">
                                                        <option v-for="vendor in vendors" :value="vendor.vid">{{vendor.vname}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </section>
                                    <footer class="modal-card-foot">
                                        <button class="button is-success" @click="saveAdd()">Save</button>
                                        <button class="button" @click="addModal=false">Cancel</button>
                                    </footer>
                                </div>
                        </div>
                            <div class="list-group-item">
                                <input class="input" type="text" placeholder="Search Product.." v-model="search">
                            </div>
                            <hr>

                            <table class="table is-bordered">
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th> Type</th>
                                    <th> Price</th>
                                    <th> Quantity</th>
                                    <th> Vendor </th>
                                    <th>Action</th>
                                </tr>
                                <tr v-for="product in filteredProducts">
                                    <td>{{product.pid}}</td>
                                    <td>{{product.pname}}</td>
                                    <td>{{product.type.tname}}</td>
                                    <td>{{product.price | toCurrency}}</td>
                                    <td>{{product.quantity}}</td>
                                    <td>{{product.vendor.vname}}</td>
                                    <td>
                                        <a class="button is-info is-outlined is-small" @click="openEdit(product)" >
                                            <span class="icon is-small">
                                              <i class="fas fa-edit"></i>
                                            </span>
                                        </a>
                                        <div v-if="editModal" class="modal is-active">
                                            <div class="modal-background"></div>
                                            <div class="modal-card">
                                                <header class="modal-card-head">
                                                    <p class="modal-card-title">Edit Product</p>
                                                    <button class="delete" aria-label="close" @click="editModal=false"></button>
                                                </header>
                                                <section class="modal-card-body">
                                                    <div class="field">
                                                        <label class="label">Name</label>
                                                        <div class="control">
                                                            <input class="input" type="text" placeholder="Name" v-model="formEdit.pname">
                                                        </div>
                                                    </div>

                                                    <div class="field">
                                                        <label class="label">Product Type</label>
                                                        <div class="control">
                                                            <div class="select is-fullwidth">
                                                                <select v-model="formEdit.tid">
                                                                    <option v-for="type in types" :value="type.tid">{{type.tname}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="field">
                                                        <label class="label">Price</label>
                                                        <div class="control">
                                                            <input class="input" type="text" placeholder="Email" v-model="formEdit.price">
                                                        </div>
                                                    </div>

                                                    <div class="field">
                                                        <label class="label">Quantity</label>
                                                        <div class="control">
                                                            <input class="input" type="number" placeholder="Email" v-model="formEdit.quantity">
                                                        </div>
                                                    </div>

                                                    <div class="field">
                                                        <label class="label">Vendor</label>
                                                        <div class="control">
                                                            <div class="select is-fullwidth">
                                                                <select v-model="formEdit.vid">
                                                                    <option v-for="vendor in vendors" :value="vendor.vid">{{vendor.vname}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </section>
                                                <footer class="modal-card-foot">
                                                    <button class="button is-success" @click="saveEdit(formEdit)">Update</button>
                                                    <button class="button" @click="editModal=false">Cancel</button>
                                                </footer>
                                            </div>
                                        </div>
                                        <a class="button is-danger is-outlined is-small" @click="deleteProduct(product.pid)">
                                            <span class="icon is-small">
                                              <i class="fas fa-times"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <div class="modal-footer">
                                <button class="button is-info" @click="fetchPaginationProduct(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
                                    Prev
                                </button>
                                <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span>
                                <button class="button is-info" @click="fetchPaginationProduct(pagination.next_page_url)" :disabled="!pagination.next_page_url">
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
        name: "product-table",
        components:{
            'app-header': Header,
            'app-nav-bar': Navbar,
            'app-footer': Footer,
        },
        data(){
            return {
                product:{
                    pid: '',
                    pname: '',
                    tid: '',
                    tname: '',
                    price:'',
                    quantity:'',
                    vid:'',
                    vname:''
                },
                type: {
                    tid: '',
                    tname: '',
                },
                vendor:{
                    vid:'',
                    vname:'',
                },
                formEdit: {
                    pid: '',
                    pname: '',
                    tid: '',
                    price:'',
                    quantity:'',
                    vid:''
                },
                pid: '',
                pname: '',
                tid: '',
                tname: '',
                vid: '',
                vname: '',
                price:'',
                quantity:'',
                products:[],
                types: [],
                vendors: [],
                search: '',
                editModal: false,
                addModal: false,
                url: 'products',
                pagination: []
            }
        },

        computed: {
            filteredProducts: function () {
                return this.products.filter((product)=>{
                    return product.pname.toLowerCase().match(this.search.toLowerCase())
                })
            }
        },

        methods: {
            fetchProductList(){
                let $this = this;
                axios.get(this.url)
                    .then(response => {
                        this.products = response.data.data;
                        $this.makePagination(response.data)
                    });
            },

            deleteProduct(id){
                let cf = confirm('Are you sure deleting this product?');
                if (cf) {
                    axios.post('/deleteProduct/' + id)
                        .then(response => {
                            console.log(response);
                            this.fetchProductList();
                            alert('Product Deleted');
                        })
                }
            },

            openEdit(product){
                this.editModal = true;
                axios.get('/types')
                    .then(response => this.types = response.data);
                axios.get('/vendors')
                    .then(response => this.vendors = response.data);
                this.formEdit = product;

                // axios.get('/editingProduct/'+id)
                //     .then(response=>this.formEdit = response.data)
            },
            saveEdit(formEdit){
                axios.post('/editProduct', formEdit)
                    .then(response=>{
                        this.fetchProductList();
                        alert('Product Updated');
                    })
            },
            openAdd(){
                this.addModal = true;
                axios.get('/types')
                    .then(response => this.types = response.data);
                axios.get('/vendors')
                    .then(response => this.vendors = response.data)
            },
            saveAdd(){
                axios.post('/addProduct', {
                    pname: this.pname,
                    tid: this.tid,
                    quantity: this.quantity,
                    price: this.price,
                    vid: this.vid
                })
                    .then(this.onSuccess)
            },
            onSuccess(){
                this.fetchProductList();
                alert('Product Added');
                this.pname= '';
                this.tid= '--Select type--';
                this.price= '';
                this.quantity= '';
                this.vid= '--Select vendor--';
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
            fetchPaginationProduct(url){
                this.url = url;
                this.fetchProductList()
            }
        },
        mounted() {
            this.fetchProductList()
        }
    }
</script>
