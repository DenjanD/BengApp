<template>
    <div>
        <base-header type="gradient-danger" class="pb-6 pb-8 pt-5 pt-md-8">
        </base-header>

        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div>
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <h3>Buat Laporan</h3>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <tabs fill class="flex-column flex-md-row">
                                        <card shadow>
                                            <tab-pane>
                                                <span slot="title">
                                                    <i class="ni ni-cloud-upload-96">
                                                        Laporan Servis</i>
                                                </span>
                                                <p class="description">
                                                    <form action="service/export" method="get">   
                                                    <div class="row">                                                
                                                        <div class="col-md-6">
                                                            <label>Tanggal Awal Servis</label>  
                                                            <input type="date" placeholder="Tanggal awal" class="form-control" name="startDate" id="inStartDate">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Tanggal Akhir Servis</label>  
                                                            <input type="date" class="form-control" name="endDate" id="inEndDate">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <hr>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Teller</label>
                                                            <select class="form-control" name="selTeller">
                                                                <option>
                                                                    --- Pilih Teller ---
                                                                </option>
                                                                <option v-for="teller in teller" v-bind:key="teller.user_id">
                                                                    {{ teller.name }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Teknisi</label>
                                                            <select class="form-control" name="selTech">
                                                                <option>
                                                                    --- Pilih Teknisi ---
                                                                </option>
                                                                <option v-for="tech in technician" v-bind:key="tech.technician_id">
                                                                    {{ tech.name }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Kategori Servis</label>
                                                            <select class="form-control" name="selServCat">
                                                                <option>
                                                                    --- Pilih Kategori Servis ---
                                                                </option>
                                                                <option v-for="cat in servCat" v-bind:key="cat.scategory_id">
                                                                    {{ cat.name }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mt-5">
                                                            <input type="submit" class="btn btn-primary btn-block" id="buttReport" value="Buat Laporan">
                                                        </div>
                                                    </div>
                                                </form>
                                                </p>
                                            </tab-pane>

                                            <tab-pane title="Profile">
                                                <span slot="title">
                                                    <i class="ni ni-cloud-upload-96">
                                                        Laporan Pembelian</i>
                                                </span>
                                                <p class="description">
                                                    <form action="purchases/export" method="get">   
                                                    <div class="row">                                                
                                                        <div class="col-md-6">
                                                            <label>Tanggal Awal Pembelian</label>  
                                                            <input type="date" placeholder="Tanggal awal" class="form-control" name="startDate2" id="inStartDate2">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Tanggal Akhir Pembelian</label>  
                                                            <input type="date" class="form-control" name="endDate2" id="inEndDate2">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <hr>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Supplier</label>
                                                            <select class="form-control" name="selSupplier">
                                                                <option>
                                                                    --- Pilih Supplier ---
                                                                </option>
                                                                <option v-for="supplier in supplier" v-bind:key="supplier.supplier_id">
                                                                    {{ supplier.name }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Kategori Spare Part</label>
                                                            <select class="form-control" name="selSpartCat">
                                                                <option>
                                                                    --- Pilih Kategori Spare Part ---
                                                                </option>
                                                                <option v-for="spartCat in spartCat" v-bind:key="spartCat.sp_category_id">
                                                                    {{ spartCat.name }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mt-5">
                                                            <input type="submit" class="btn btn-primary btn-block" id="buttReport2" value="Buat Laporan">
                                                        </div>
                                                    </div>
                                                </form>
                                                </p>
                                            </tab-pane>

                                            <tab-pane>
                                                <span slot="title">
                                                    <i class="ni ni-cloud-upload-96">
                                                        Laporan Penjualan</i>
                                                </span>
                                                <p class="description">
                                                    <form action="sales/export" method="get">   
                                                    <div class="row">                                                
                                                        <div class="col-md-6">
                                                            <label>Tanggal Awal Penjualan</label>  
                                                            <input type="date" placeholder="Tanggal awal" class="form-control" name="startDate3" id="inStartDate3">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Tanggal Akhir Penjualan</label>  
                                                            <input type="date" class="form-control" name="endDate3" id="inEndDate3">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <hr>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Merek</label>
                                                            <select class="form-control" name="selBrand">
                                                                <option>
                                                                    --- Pilih Merek ---
                                                                </option>
                                                                <option v-for="brand in brand" v-bind:key="brand.name">
                                                                    {{ brand.name }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Kategori Barang</label>
                                                            <select class="form-control" name="selSpartCat">
                                                                <option>
                                                                    --- Pilih Kategori Barang ---
                                                                </option>
                                                                <option v-for="spartCat in spartCat" v-bind:key="spartCat.sp_category_id">
                                                                    {{ spartCat.name }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Supplier</label>
                                                            <select class="form-control" name="selSupplier">
                                                                <option>
                                                                    --- Pilih Supplier ---
                                                                </option>
                                                                <option v-for="supplier in supplier" v-bind:key="supplier.supplier_id">
                                                                    {{ supplier.name }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mt-5">
                                                            <input type="submit" class="btn btn-primary btn-block" id="buttReport" value="Buat Laporan">
                                                        </div>
                                                    </div>
                                                </form>
                                                </p>
                                            </tab-pane>
                                        </card>
                                    </tabs>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    export default {
        name: 'report',
        components: {
      
        },
        data() {
            return {
                teller: [],
                technician: [],
                servCat: [],
                supplier: [],
                spartCat: [],
                brand: []
            }
        },
        created() {
            this.loadFilter();
            this.loadFilter2();
        },
        methods: {
            loadFilter() {
                let reqConfig = {
                    headers: { Authorization: 'Bearer ' + localStorage.getItem('token') }
                }

                this.axios.get('api/users',reqConfig).then(response => {
                    this.teller = response.data
                })  
                this.axios.get('api/technician',reqConfig).then(response => {
                    this.technician = response.data
                })
                this.axios.get('api/scat',reqConfig).then(response => {
                    this.servCat = response.data
                })
            },

            loadFilter2() {
                let reqConfig = {
                    headers: { Authorization: 'Bearer' + localStorage.getItem('token') }
                }

                this.axios.get('api/supplier',reqConfig).then(response => {
                    this.supplier = response.data
                })
                
                this.axios.get('api/spcategory',reqConfig).then(response => {
                    this.spartCat = response.data
                })

                this.axios.get('api/spart/brand',reqConfig).then(response => {
                    this.brand = response.data
                    console.log(this.brand)
                })
            }
        }
    };
</script>
<style></style>