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
                                <button class="button is-success" @click="addModal=true">
                                <span class="icon is-small">
                                    <i class="fas fa-plus"></i>
                                </span>
                                    <p>Add Product Type</p>
                                </button>
                                <div v-if="addModal" class="modal is-active">
                                    <div class="modal-background"></div>
                                    <div class="modal-card">
                                        <header class="modal-card-head">
                                            <p class="modal-card-title">Add New Product Type</p>
                                            <button class="delete" aria-label="close" @click="addModal=false"></button>
                                        </header>
                                        <section class="modal-card-body">
                                            <div class="field">
                                                <label class="label">Name</label>
                                                <div class="control">
                                                    <input class="input" type="text" placeholder="Name" v-model="tname">
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Description</label>
                                                <div class="control">
                                                    <textarea class="input" placeholder="Description" v-model="tdescription"></textarea>
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
                                    <input class="input" type="text" placeholder="Search Type.." v-model="search">
                                </div>
                                <hr>

                                <table class="table is-bordered">
                                    <tr>
                                        <th>ID</th>
                                        <th>Type Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr v-for="type in filteredTypes">
                                        <td>{{ type.tid}}</td>
                                        <td>{{ type.tname }}</td>
                                        <td>{{ type.tdescription }}</td>
                                        <td>
                                            <a class="button is-info is-outlined is-small" @click="openEdit(type)" >
                                            <span class="icon is-small">
                                              <i class="fas fa-edit"></i>
                                            </span>
                                            </a>
                                            <div v-if="editModal" class="modal is-active">
                                                <div class="modal-background"></div>
                                                <div class="modal-card">
                                                    <header class="modal-card-head">
                                                        <p class="modal-card-title">Edit Product Type</p>
                                                        <button class="delete" aria-label="close" @click="editModal=false"></button>
                                                    </header>
                                                    <section class="modal-card-body">
                                                        <div class="field">
                                                            <label class="label">Name</label>
                                                            <div class="control">
                                                                <input class="input" type="text" placeholder="Name" v-model="formEdit.tname">
                                                            </div>
                                                        </div>

                                                        <div class="field">
                                                            <label class="label">Product Type</label>
                                                            <div class="control">
                                                                <textarea class="input" placeholder="Description" v-model="formEdit.tdescription"></textarea>
                                                            </div>
                                                        </div>

                                                    </section>
                                                    <footer class="modal-card-foot">
                                                        <button class="button is-success" @click="saveEdit(formEdit)">Update</button>
                                                        <button class="button" @click="editModal=false">Cancel</button>
                                                    </footer>
                                                </div>
                                            </div>
                                            <a class="button is-danger is-outlined is-small" @click="deleteType(type.tid)">
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
        name: "product-type",
        components: {
            'app-header': Header,
            'app-nav-bar': Navbar,
            'app-footer': Footer,
        },
        data() {
            return {
                type: {
                    tid: '',
                    tname: '',
                    tdescription:''
                },
                formEdit: {
                    tid: '',
                    tname: '',
                    tdescription:''
                },
                formAdd: {
                    tid: '',
                    tname: '',
                    tdescription:''
                },
                tid: '',
                tname: '',
                tdescription:'',
                types:[],
                search: '',
                editModal: false,
                addModal: false,
            }
        },

        computed: {
            filteredTypes() {
                return this.types.filter((type) => {
                    return type.tname.toLowerCase().match(this.search.toLowerCase())
                })
            }
        },

        created() {
            this.fetchTypeList();
        },

        methods: {
            fetchTypeList(){
                axios.get('/types')
                    .then(response => this.types = response.data)

            },

            deleteType(id) {
                let cf = confirm('Are you sure deleting this product type?');
                if (cf) {
                    axios.post('/deleteType/' + id)
                        .then(response => {
                            console.log(response);
                            this.fetchTypeList();
                            alert('Product type Deleted');
                        })
                }
            },

            openEdit(type) {
                this.editModal = true;
                this.formEdit = type;
                // axios.get('/editingProduct/'+id)
                //     .then(response=>this.formEdit = response.data)
            },
            saveEdit(formEdit) {
                axios.post('/editType', formEdit)
                    .then(response => {
                        this.fetchTypeList();
                        alert('Product type Updated');
                    })
            },
            saveAdd() {
                axios.post('/addType', {
                    tname: this.tname,
                    tdescription: this.tdescription
                })
                    .then(this.onSuccess)
            },
            onSuccess() {
                alert('Product type Created');
                this.fetchTypeList();

                this.tname = '';
                this.tdescription = '';
            },
        }
    }
</script>

<style scoped>
    textarea{
        height: 200px;
    }
</style>