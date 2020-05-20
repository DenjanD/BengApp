<template>
    <div>
        <base-header type="gradient-yellow" class="pb-6 pb-8 pt-5 pt-md-8">
        </base-header>

        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                    <div class="card card-profile shadow">
                        <div class="card-body pt-0 pt-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="mt-3 mb-3">Pembelian Spare Part</h3>
                                    <hr class="my-4" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <base-input alternative="" label="Nama Barang" placeholder="Ketik nama barang"
                                        input-classes="form-control-alternative" v-model="model.namaB" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <base-input alternative="" label="Merek" placeholder="Ketik merek barang"
                                        input-classes="form-control-alternative" v-model="model.merekB" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <base-input alternative="" label="Harga Beli" placeholder="Ketik harga barang"
                                        input-classes="form-control-alternative" v-model="model.hargaBeliB" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <base-input alternative="" label="Jumlah" placeholder="Ketik jumlah barang"
                                        input-classes="form-control-alternative" v-model="model.jumlahB" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label class="form-control-label">Kategori</label><br>
                                    <select class="form-control cust-form" v-model="model.kategoriB">
                                        <option selected>---Pilih Kategori Barang---</option>
                                        <option v-for="cat in categories">
                                            {{ cat.sp_category_id }} | {{ cat.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label class="form-control-label">Supplier</label><br>
                                    <select class="form-control cust-form" v-model="model.supplierB">
                                        <option selected>---Pilih Supplier Barang---</option>
                                        <option v-for="sup in suppliers">
                                            {{ sup.supplier_id }} | {{ sup.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <base-input alternative="" label="Harga Jual" placeholder="Ketik harga barang"
                                        input-classes="form-control-alternative" v-model="model.hargaJualB" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-block btn-primary" v-on:click="addData()">Tambah
                                        Pembelian</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 order-xl-1">
                    <spart-category-table></spart-category-table>
                    <spart-table class="mt-4"></spart-table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import SpartCategoryTable from './Tables/SpartCategoryTable'
    import SpartTable from './Tables/SpartTable'
    export default {
        name: 'spare-part',
        components: {
            SpartCategoryTable,
            SpartTable
        },
        data() {
            return {
                hide: true,
                model: {
                    namaB: '',
                    merekB: '',
                    hargaBeliB: '',
                    jumlahB: '',
                    kategoriB: '---Pilih Kategori Barang---',
                    supplierB: '---Pilih Supplier Barang---',
                    hargaJualB: ''
                },
                categories: [],
                suppliers: []
            }
        },
        created() {
            this.loadDatas()
        },
        methods: {
            loadDatas() {
                let reqConfig = {
                    headers: { Authorization: 'Bearer ' + localStorage.getItem('token') }
                }
                this.axios.get('api/spart', reqConfig).then(response => {
                    this.categories = response.data.spartcategories
                    this.suppliers = response.data.suppliers
                })
            },
            addData() {
                var katId = this.model.kategoriB.replace(/ .*/, '');
                var supId = this.model.supplierB.replace(/ .*/, '');
                var postData = {
                    name: this.model.namaB,
                    brand: this.model.merekB,
                    price: this.model.hargaJualB,
                    quantity: this.model.jumlahB,
                    category: katId,
                    supplier: supId,
                    buyPrice: this.model.hargaBeliB
                }
                let reqConfig = {
                    headers: { Authorization: 'Bearer ' + localStorage.getItem('token') }
                }
                this.axios.post("api/purchases", postData, reqConfig)
                    .then(response => {
                        //This section call loadData() from SpartTable.vue
                        location.reload()
                    });
            }
        }
    };
</script>
<style>
    .cust-form {
        background-color: #FFFFFF;
        border: solid 0px rgba(153, 153, 153, 1);
        font-size: 13px;
        color: #A8A8A8;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 5px;
        padding-right: 5px;
        -webkit-box-shadow: 0px 2px 13px -7px rgba(153, 153, 153, 1);
        -moz-box-shadow: 0px 2px 13px -7px rgba(153, 153, 153, 1);
        box-shadow: 0px 2px 13px -7px rgba(153, 153, 153, 1);
    }
</style>