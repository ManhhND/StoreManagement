<template>
    <div class="wrap">
        <table>
            <tr>
                <td class="main-side">
                    <div class="wrapSearch">
                        <p class="control has-icons-left has-icons-right">
                            <input type="text" class="input" placeholder="Search product..." v-model="search" @keyup="showProduct" :autofocus="true" >
                            <span class="icon is-small is-left">
								<i class="fas fa-search"></i>
							</span>
                        </p>
                        <div class="panel-footer" v-show="showList">
                            <ul v-for="product in products" >
                                <a @click="addToCart(product)">
                                    <li class="media">
                                        <figure class="image is-64x64">
                                            <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
                                        </figure>
                                        <div class="media-content">
                                            <p v-model="product.pname">
                                                <b>{{product.pname}}</b>
                                            </p>
                                            <nav>
                                                <div class="level-left">
                                                    <p class="level-item" v-model="product.pid">Product ID: {{product.pid}}</p>
                                                    <p class="level-item" v-model="product.price">Price: {{product.price}}</p>
                                                    <p class="level-item" v-model="product.quantity">Quantity: {{product.quantity}}</p>
                                                </div>
                                            </nav>
                                        </div>
                                    </li>
                                </a>
                            </ul>
                        </div>
                        <div class="infoBar">
                            <table>
                                <tr>
                                    <td>
                                        <b>STT</b>
                                    </td>
                                    <td>
                                        <b>Product ID</b>
                                    </td>
                                    <td>
                                        <b>Product Name</b>
                                    </td>
                                    <td>
                                        <b>Quantity</b>
                                    </td>
                                    <td>
                                        <b>Price</b>
                                    </td>
                                    <td>
                                        <b>Total</b>
                                    </td>
                                </tr>
                                <tr class="dataRow" v-for="(item, index) in items">
                                    <td>{{index + 1}}</td>
                                    <td>{{item.pid}}</td>
                                    <td>{{item.pname}}</td>
                                    <td>
                                        <button class="button is-small" @click="inc(item)">+</button>
                                        <input class="input is-small" disabled="disabled"  v-model="item.quantity">
                                        <button class="button is-small" @click="dec(item)">-</button>
                                    </td>
                                    <td>{{ formatPrice(item.price) }}</td>
                                    <td>{{ (item.price * item.quantity)|toCurrency }}</td>
                                    <td><i class="fa fa-trash" @click="removeFromCart(item)"></i></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
                <td class="sub-side">
                    <div class="redirect">
                        <div class="button">
                            <a @click="returnHome">
                                <i class="fas fa-home"></i>
                            </a>
                        </div>
                        <div v-for="user in users">
                            <input class="input" type="text" disabled="disabled" :value="'User: '+ user.name">
                            <input type="hidden"  :value="user.id">
                        </div>
                    </div>
                    <div class="customerTitle">
                        <p class="card-header">
                            <b>Customer</b>
                        </p>
                    </div>
                    <hr>
                    <div class="wrapCustomer">
                        <div class="field has-addons">
                            <div class="control">
                                <p class="control has-icons-left has-icons-right">
                                    <input type="text" class="input" placeholder="Search customer..." v-model="searchCustomer" @keyup="showCustomer" :autofocus="true">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </p>
                                <div class="panel-footer" v-show="showListCus">
                                    <ul v-for="customer in customers">
                                        <a @click="addCustomerToInvoice(customer)">
                                            <li class="media">
                                                <div class="media-content">
                                                    <p>
                                                        <b>{{customer.cname}}</b>
                                                    </p>
                                                    <nav>
                                                        <div class="level-left">
                                                            <p class="level-item">{{customer.cphone}}</p>
                                                        </div>
                                                    </nav>
                                                </div>
                                            </li>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                            <div class="control">
                                <button class="button" @click="addModal=true">
												<span class="icon is-small">
													<i class="fas fa-plus"></i>
												</span>
                                    <p>Add</p>
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
                                            <button class="button" @click="onCancel">Cancel</button>
                                        </footer>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="infoContent" v-for="cus in cust">
                            <label>
                                {{cus.cname}}             
                                <a class="button is-info is-outlined is-small" @click="openEdit(cus)" >
                                    <span class="icon is-small">
                                      <i class="fas fa-edit"></i>
                                    </span>
                                </a>
                            </label>
                            <input type="hidden" v-model="cus.cid"><br>
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
                            <label>{{cus.cphone}}</label><br>
                            <label>{{cus.caddress}}</label>
                        </div>
                        <div class="infoLabel">
                            <label class="label">Name:</label>
                            <label class="label">Phone:</label>
                            <label class="label">Address:</label>
                        </div>
                        
                    </div>
                    <div class="payTitle">
                        <p class="card-header">
                            <b>Payment: Invoice No.{{getCurrentInvoiceID()}}</b>
                        </p>
                    </div>
                    <div class="wrapPay">
                        <label class="label">Total:</label>
                        <h3>{{ invoiceTotal|toCurrency }}</h3>
                        <label class="label">Discount:</label>
                        <input class="input" type="text" style="width: 150px" v-model="discount"></input>
                        <br><hr>
                        <label class="label" style="display: inline-block;">Customer Pay:</label>
                        <h3 style="display: inline-block; float: right;"> {{ totalPay| toCurrency }}</h3>
                        <button class="button is-fullwidth is-large" @click="saveInvoice">
                            <b>Save</b>
                        </button>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        name: "sale",
        data(){
            return{
                search: '',
                searchCustomer: '',
                users:[],
                customers: [],
                currentInvoiceID: '',
                invoiceID: '',
                products:[],
                amount: 1,
                discount: '',
                total: '0',
                items:[],
                cust:[],
                showList: false,
                showListCus: false,
                addModal: false,
                editModal: false,
                formEdit: {
                    cid: '',
                    cname: '',
                    caddress:'',
                    cphone:'',
                    cemail:''
                },
                id:'',
                cid:'',
                cname: '',
                caddress:'',
                cphone:'',
                cemail:'',
            }
        },
        computed:{
            invoiceTotal (){
                return _.sumBy(this.items, function(item) {
                    return (item.price * item.quantity)
                })
            },
            totalPay(){
                return this.invoiceTotal - this.discount;
            },
        },
        mounted(){
            this.getUser();
            this.getCurrentInvoiceID();
        },
        methods:{
            getUser(){
                axios.get('/userInfo')
                    .then(response => {
                        this.users = response.data;
                        console.log(this.users.result.id)
                    })
            },
            getCurrentInvoiceID(){
                axios.get('getCurrentInvoiceID')
                    .then(response => {
                        this.currentInvoiceID = response.data;
                        this.invoiceID = this.currentInvoiceID[0].iid;
                    })
                return this.invoiceID;
            },
            returnHome(){
                this.$router.push('/dashboard')
            },
            showProduct(){
                if (this.search === ""){
                    this.showList = false
                } else {
                    //this.products=[];
                    this.showList = true;
                    axios.post('/search',{
                        search: this.search
                    })
                        .then(response=>{
                            this.products = response.data
                        })
                }
            },
            showCustomer(){
                if (this.searchCustomer === ""){
                    this.showListCus = false
                } else {
                    //this.products=[];
                    this.showListCus = true;
                    axios.post('/searchCustomer',{
                        searchCustomer: this.searchCustomer
                    })
                        .then(response=>{
                            this.customers = response.data
                        })
                }
            },
            addToCart(product){
                var found = _.find(this.items, ['pid', product.pid])
                if(typeof found !== 'object') {
                    product.quantity = this.amount,
                    product.discount = 0,
                    this.items.push(product),
                    this.showList = false,
                    this.search = "",
                    axios.post('addInvoiceDetail',{
                        iid: this.getCurrentInvoiceID(),
                        pid: product.pid,
                        quantity: product.quantity,
                        price: product.price,
                        discount: this.discount
                    })
                }
                else{
                    this.inc(product);
                    this.showList = false;
                }
            },
            inc (product) {
                var found = _.find(this.items, ['pid', product.pid])
                if(typeof found == 'object') {
                    var index = _.indexOf(this.items, found)
                    this.items[index].quantity++
                    axios.post('updateQtyDetail',{
                        quantity: items[index].quantity
                    })
                    // axios.post('addInvoiceDetail',{
                    //     iid: this.getCurrentInvoiceID(),
                    //     pid: product.pid,
                    //     quantity: items[index].quantity,
                    //     price: product.price,
                    //     discount: this.discount
                    // })   
                }   
            },
            dec (product) {
                var found = _.find(this.items, ['pid', product.pid])
                if(typeof found == 'object') {
                    var index = _.indexOf(this.items, found)
                    if(this.items[index].quantity == 1) {
                        this.items.splice(index, 1)
                        axios.post('deleteInvoiceDetail/'+items[index].pid)
                    } else {
                        this.items[index].quantity--
                        axios.post('deleteInvoiceDetail/'+items[index].pid)
                        .then(
                            axios.post('addInvoiceDetail',{
                                iid: this.getCurrentInvoiceID(),
                                pid: product.pid,
                                quantity: items[index].quantity,
                                price: product.price,
                                discount: discount
                            })
                        )          
                    }
                }
            },
            onDiscount(){
                return this.invoiceTotal() - this.discount;
            },
            removeFromCart(item){
                this.items.splice(this.items.indexOf(item),1);
                axios.post('deleteInvoiceDetail/'+item.pid)
            },
            addCustomerToInvoice(customer){
               // var found = _.find(this.cust, ['cid', customer.cid])
                if(this.cust.length>0) {
                    this.cust.pop(customer);
                    this.showListCus = false;
                    this.searchCustomer = "";
                    this.cust.push(customer)
                } else{
                    this.cust.push(customer);
                    this.showListCus = false;
                    this.searchCustomer = ""
                }
            },
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
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
                Customer = response.data,
                this.addModal=false,
                this.cname= '',
                this.caddress= '',
                this.cphone= '',
                this.cemail= '',
                alert('Customer Added!')                    
                
            },
            onCancel(){
                this.addModal = false;
                this.cname= '';
                this.caddress= '';
                this.cphone= '';
                this.cemail= '';
            },
            openEdit(cus){
                this.editModal = true;
                this.formEdit = cus;
            },
            saveEdit(formEdit){
                axios.post('/editCustomer', formEdit)
                .then(alert('Customer Updated!'))
            },
            saveInvoice(){
                // alert(this.users.result.id);
                // alert(this.cust[0].cid);
                axios.post('addInvoice',{
                    uid: this.users.result.id,
                    cid: this.cust[0].cid
                })
                // axios.post('addInvoiceDetail',{
                //     iid: this.getCurrentInvoiceID()
                // })
                // .then(
                //     alert('Invoice created!'),
                //     this.cust = []
                // )
            },

        }
    }
</script>

<style scoped>
    .wrap{
        background: black;
        height: 100%;
        padding: 6px;
        width: 100%;
    }
    table{
        width: 100%;
    }
    input{
    }
    .main-side{
        width: 70%;
        background: white;
        border-right: 5px solid black;
        overflow-y: auto;
    }
    .sub-side{
        width: 25%;
        background: white;
    }
    .wrapSearch{
        position: relative;
    }
    .infoBar{
        font-size: small;
        border-bottom: 1px solid lightgray;
        height: 30px;
        padding-left: 5px;
        background: rgba(0,0,0,.03);
        position: relative;
    }
    .infoBar td{
        padding-top: 3px;
    }
    .customerTitle{
        background: white;
        border: 1px solid black;
        border-radius: 10px;
    }
    .wrapCustomer{
        padding-left: 6px;
        padding-right: 6px;
    }
    .wrapCustomer button{
        background: black;
        color: white;
    }
    .payTitle{
        background: white;
        border: 1px solid black;
        border-radius: 10px;
        margin-top: 10px;
    }
    .wrapPay{
        padding: 5px;
    }
    .wrapPay button{
        border-radius: 10px;
        background: black;
        color: white;
    }
    .wrapPay input{
        text-align: right;
    }
    .panel-footer{
        position: fixed;
        background: white;
        max-height: 300px;
        width: 400px;
        border: 1px solid #a1a1a1;
        z-index: 1000;
        overflow-y: auto;
    }
    .panel-footer li{
        border-bottom: 1px solid #a1a1a1;
        padding: 5px;
    }
    .panel-footer li:hover{
        background: #e1e1e1;
    }
    .wrapCustomer .panel-footer{
        width: 250px;
    }
    .media-content{
        padding-left: 5px;
    }
    .box{
        border: 1px solid #a1a1a1
    }
    .dataRow{
        height: 50px;
    }
    .dataRow td{
        padding-top: 13px;
        border-bottom: 1px solid #919191;
        font-size: 16px;
    }
    .dataRow input{
        width: 50px;
        text-align: center;
    }
    .dataRow i{
        padding-top: 5px;
        cursor: pointer;
    }
    .main-side td{
        text-align: center;
    }
    .productRow{
        overflow-y: auto;
    }
    .infoContent{
        float: right;
        width: 70%;
    }
    .redirect .button{
        float: right;
    }
    .redirect input{
        width: 50%;
        background: white;
        border: none;
        cursor: text;
    }
</style>