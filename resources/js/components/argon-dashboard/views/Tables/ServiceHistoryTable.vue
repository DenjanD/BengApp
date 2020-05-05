<template>
    <div class="card shadow" :class="type === 'dark' ? 'bg-default': ''">
        <div class="card-header border-0" :class="type === 'dark' ? 'bg-transparent': ''">
            <div class="row align-items-center">
                <div class="col">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h3 class="mb-0">Antrian Servis</h3>
                        </div>
                        <div class="col-6 text-right">
                            <select class="cust-form w-40 mb-3" v-model="searchFilter">
                                <option selected>--- Filter Pencarian ---</option>
                                <option>Servis Id</option>
                                <option>Pelanggan</option>
                                <option>Kendaraan</option>
                                <option>Teknisi</option>
                            </select>
                            <base-input placeholder="Cari" class="input-group-alternative" alternative=""
                                addon-right-icon="fas fa-search" v-model="searchKey">
                            </base-input>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <tr class="cust-tr">
                    <th>Servis Id</th>
                    <th>Pelanggan</th>
                    <th>Kendaraan</th>
                    <th>Teknisi</th>
                    <th>Aksi</th>
                </tr>
                <tr v-for="row in filteredDataShow">
                    <td>
                        {{ row.service_id }}
                    </td>
                    <td>
                        {{ row.customer }}

                    </td>
                    <td>
                        {{ row.vehicle_name }} - {{ row.vehicle_license }}
                    </td>
                    <td>
                        {{ row.technician }}
                    </td>
                    <td>
                        <base-button type="info" size="sm"
                            @click.prevent="loadServiceDetail(row.service_id,row.status)">
                            <i class="fa fa-bars"></i> Rincian
                        </base-button>
                        <base-button v-if="row.status == 'Working'" type="success" size="sm"
                            @click.prevent="loadFinishService(row.service_id)">
                            <i class="fa fa-check"></i> Selesai
                        </base-button>
                    </td>
                </tr>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-end" :class="type === 'dark' ? 'bg-transparent': ''">
            <!-- Table Pagination -->
            <nav aria-label="...">
                <ul class="pagination">

                    <li class="page-item" v-bind:class="{ disabled: isBegin }">
                        <button class="page-link" tabindex="-1" @click="previousPagination">
                            <i class="fa fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                        </button>
                    </li>

                    <li v-for="number in pageNumbers" :class="{ active: number.number == dataPage}" class="page-item"
                        @click="changePage(number.number)"><button class="page-link">{{ number.number }}</button></li>

                    <li class="page-item" v-bind:class="{ disabled: isEnd }">
                        <button class="page-link" @click="nextPagination">
                            <i class="fa fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                        </button>
                    </li>
                </ul>
            </nav>
            <!-- /Table Pagination -->
        </div>

        <!-- Modal Detail Servis -->
        <modalstd :show.sync="modals.modal_detail_service">
            <template slot="header">
                <h5 class="modal-title" id="modal_detail_service">Detail Servis</h5>
            </template>
            <div class="row">
                <div class="col-md-3">
                    <b>Servis Id</b>
                    <p id="sId2"></p>

                    <b>Nama Pelanggan</b>
                    <p id="custName2"></p>

                    <b>Kendaraan</b>
                    <p id="vehicName2"></p>

                    <b>Plat Nomor</b>
                    <p id="vehicLic2"></p>

                    <b>Jumlah Kilometer</b>
                    <p id="kilometer2"></p>
                </div>
                <div class="col-md-3">
                    <b>Teknisi</b>
                    <p id="techName2"></p>

                    <b>Jam Mulai Servis</b>
                    <p id="serviceStartTime2"></p>

                    <b>Deskripsi Komplen</b>
                    <p id="compDesc2"></p>

                    <b>Deskripsi Tambahan</b>
                    <p id="servDesc2"></p>

                    <b>Kategori Servis</b>
                    <p id="sCat2"></p>

                    <b>Total Biaya Servis</b>
                    <p id="totalCost2"></p>
                </div>
                <div class="col-md-6">
                    <tabs fill class="flex-column flex-md-row mt-n3">
                        <card shadow>
                            <tab-pane title="Spare Part">
                                <span slot="title">
                                    <i class="ni ni-cloud-upload-96"></i>
                                    Spare Part
                                </span>


                                <!-- Alert after add table data -->
                                <div v-show="showAlertAddSpart==true"
                                    class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-inner--icon"><i class="notification-70"></i></span>
                                    <span class="alert-inner--text">Spare Part baru berhasil ditambahkan</span>
                                    <button type="button" @click="showAlertAddSpart = false" class="close"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive description">
                                    <base-table class="table align-items-center table-flush"
                                        :class="type === 'dark' ? 'table-dark': ''"
                                        :thead-classes="type === 'dark' ? 'thead-dark': 'thead-light'"
                                        tbody-classes="list" :data="tableSpart">
                                        <template slot="columns">
                                            <th>No.</th>
                                            <th>Spare Part</th>
                                            <th>Harga</th>
                                        </template>

                                        <template slot-scope="{row,index}">
                                            <td>
                                                {{ index+1 }}
                                            </td>
                                            <td>
                                                {{ row.spart }}
                                            </td>
                                            <td>
                                                {{ row.price }}
                                            </td>
                                        </template>
                                    </base-table>
                                </div>
                                <div class="mt-3 text-center">
                                    <strong>Total Biaya Spare Part : {{ spartDetailTotalCost }}</strong>
                                </div>
                            </tab-pane>

                            <tab-pane title="Job Servis">
                                <span slot="title">
                                    <i class="ni ni-bell-55 mr-2"></i>
                                    Jasa Servis
                                </span>


                                <!-- Alert after add table data -->
                                <div v-show="showAlertAddSjob==true"
                                    class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-inner--icon"><i class="notification-70"></i></span>
                                    <span class="alert-inner--text">Jasa baru berhasil ditambahkan</span>
                                    <button type="button" @click="showAlertAddSjob = false" class="close"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive description">
                                    <base-table class="table align-items-center table-flush"
                                        :class="type === 'dark' ? 'table-dark': ''"
                                        :thead-classes="type === 'dark' ? 'thead-dark': 'thead-light'"
                                        tbody-classes="list" :data="tableSJobs">
                                        <template slot="columns">
                                            <th>No.</th>
                                            <th>Job</th>
                                            <th>Harga</th>
                                        </template>

                                        <template slot-scope="{row,index}">
                                            <td>
                                                {{ index+1 }}
                                            </td>
                                            <td>
                                                {{ row.job }}
                                            </td>
                                            <td>
                                                {{ row.price }}
                                            </td>
                                        </template>
                                    </base-table>
                                </div>
                                <div class="mt-3 text-center">
                                    <strong>Total Biaya Jasa Servis : {{ sjobDetailTotalCost }}</strong>
                                </div>
                            </tab-pane>
                        </card>
                    </tabs>
                </div>
            </div>
            <template slot="footer">
                <base-button type="secondary" @click="modals.modal_detail_service = false">Tutup</base-button>
            </template>
        </modalstd>

    </div>
</template>
<script>
    export default {
        data() {
            return {
                searchKey: '',
                searchFilter: '--- Filter Pencarian ---',
                modals: { modal_add_service: false, modal_detail_service: false, name: '', address: '', phone: '', modal_finish_service: false },
                model: {
                    customer: '--- Pilih Nama Pelanggan ---',
                    technician: '--- Pilih Nama Teknisi ---',
                    spart: '--- Pilih Spare Part ---',
                    kilometer: '',
                    vehicle_license: '',
                    sjob: '--- Pilih Jasa Servis ---',
                    vehicle_name: '',
                    complaint_desc: '',
                    scategory: '--- Pilih Kategori Servis ---',
                    service_desc: ''
                },
                customerData: [],
                technicianData: [],
                spartData: [],
                sjobData: [],
                scatData: [],

                tableData: [],
                tableDataLength: 0,
                tableDataShow: [],
                pageShow: [],
                perPage: 15,
                pageNumbers: [],
                paginations: 0,
                dataPage: 1,
                isBegin: true,
                isEnd: true,
                selected: "",

                newSjob: '--- Pilih Jasa Baru ---',
                newSpart: '--- Pilih Spare Part Baru ---',

                tableSJobs: [],
                tableSpart: [],
                sjobDetailTotalCost: 0,
                spartDetailTotalCost: 0,
                showAlertAddSjob: false,
                showAlertAddSpart: false,
                finishSJobs: [],
                finishSpart: [],
                finishTotalCost: 0,

                showAlertAdd: false,
                showAlertUpdate: false,
                showAlertDelete: false,
                updateId: {},
                deleteId: {}
            };
        },
        created() {
            this.getAuthUser();
            this.loadCustomer();
            this.loadTechnician();
            this.loadSparePart();
            this.loadSjob();
            this.loadScategory();
            this.loadData();
        },
        name: 'service-table',
        props: {
            type: {
                type: String
            },
            title: String
        },
        methods: {
            getAuthUser() {
                this.axios.get('api/user', { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } }).then(response => {
                    this.model.teller = response.data.user.user_id
                    console.log(this.model.teller)
                })
            },

            loadCustomer() {
                this.axios.get("api/customer").then(response => {
                    this.customerData = response.data
                })
            },

            loadTechnician() {
                this.axios.get("api/technician").then(response => {
                    this.technicianData = response.data
                })
            },

            loadSparePart() {
                this.axios.get("api/spart").then(response => {
                    this.spartData = response.data.data
                })
            },

            loadSjob() {
                this.axios.get("api/sjob").then(response => {
                    this.sjobData = response.data.data
                })
            },

            loadScategory() {
                this.axios.get("api/scat").then(response => {
                    this.scatData = response.data.data
                })
            },

            loadServiceDetail(serviceId, servStatus) {
                this.axios.get("api/service/" + serviceId).then(response => {
                    if (servStatus == 'Done') {
                        document.getElementById("selNewSpart").style.display = "none"
                        document.getElementById("selNewSjob").style.display = "none"
                        document.getElementById("buttAddNewSpart").style.display = "none"
                        document.getElementById("buttAddNewSjob").style.display = "none"
                    }
                    else {
                        document.getElementById("selNewSpart").style.display = "block"
                        document.getElementById("selNewSjob").style.display = "block"
                        document.getElementById("buttAddNewSpart").style.display = "block"
                        document.getElementById("buttAddNewSjob").style.display = "block"
                    }

                    var sId = document.getElementById("sId2").innerHTML = response.data.data.service_id
                    var custName = document.getElementById("custName2").innerHTML = response.data.data.cust_name
                    var vehicName = document.getElementById("vehicName2").innerHTML = response.data.data.vehicle_name
                    var vehicLic = document.getElementById("vehicLic2").innerHTML = response.data.data.vehicle_license
                    var kilometer = document.getElementById("kilometer2").innerHTML = response.data.data.kilometer
                    var techName = document.getElementById("techName2").innerHTML = response.data.data.tech_name
                    var serviceStartTime = document.getElementById("serviceStartTime2").innerHTML = response.data.data.service_start_time
                    var compDesc = document.getElementById("compDesc2").innerHTML = response.data.data.complaint_desc
                    var servDesc = document.getElementById("servDesc2").innerHTML = response.data.data.service_desc
                    var sCat = document.getElementById("sCat2").innerHTML = response.data.data.scat_name + ' - Rp ' + response.data.data.scat_price
                    var totalCost = document.getElementById("totalCost2").innerHTML = response.data.data.total_cost

                    this.axios.get("api/servicesjob/" + serviceId).then(response => {
                        this.sjobDetailTotalCost = 0
                        this.tableSJobs = response.data
                        for (var i = 0; i < this.tableSJobs.length; i++) {
                            this.sjobDetailTotalCost += this.tableSJobs[i].price
                        }

                    })

                    this.axios.get("api/servicespart/" + serviceId).then(response => {
                        this.spartDetailTotalCost = 0
                        this.tableSpart = response.data
                        for (var i = 0; i < this.tableSpart.length; i++) {
                            this.spartDetailTotalCost += this.tableSpart[i].price
                        }

                    })
                    this.modals.modal_detail_service = true
                })
            },

            loadFinishService(serviceId) {
                this.finishTotalCost = 0
                this.axios.get("api/service/" + serviceId).then(response => {
                    var serId = document.getElementById("serId").innerHTML = serviceId
                    var custNameF = document.getElementById("custNameF").innerHTML = response.data.data.cust_name
                    var vehicNameF = document.getElementById("vehicNameF").innerHTML = response.data.data.vehicle_name
                    var vehicLicF = document.getElementById("vehicLicF").innerHTML = response.data.data.vehicle_license
                    var techNameF = document.getElementById("techNameF").innerHTML = response.data.data.tech_name
                    var sCatF = document.getElementById("sCatF").innerHTML = response.data.data.scat_name + " - Rp " + response.data.data.scat_price

                    this.axios.get("api/servicesjob/" + serviceId).then(response => {
                        this.sjobDetailTotalCost = 0
                        this.finishSJobs = response.data
                        for (var i = 0; i < this.finishSJobs.length; i++) {
                            this.sjobDetailTotalCost += this.finishSJobs[i].price
                        }
                        this.finishTotalCost += this.sjobDetailTotalCost
                    })

                    this.axios.get("api/servicespart/" + serviceId).then(response => {
                        this.spartDetailTotalCost = 0
                        this.finishSpart = response.data
                        for (var i = 0; i < this.finishSpart.length; i++) {
                            this.spartDetailTotalCost += this.finishSpart[i].price
                        }
                        this.finishTotalCost += this.spartDetailTotalCost
                    })
                    this.finishTotalCost += response.data.data.scat_price
                    this.modals.modal_finish_service = true
                })
            },

            finishService() {
                var servId = document.getElementById("serId").innerHTML
                this.axios.post("api/service/finish", {
                    service_id: servId
                }).then(response => {
                    this.loadData()
                    this.showAlertUpdate = true
                    this.modals.modal_finish_service = false
                })
            },

            addNewSjob() {
                var servId = document.getElementById("sId").innerHTML

                if (this.newSjob == '--- Pilih Jasa Baru ---') {
                    return
                }
                var sjobId = this.newSjob.replace(/ .*/, '')
                this.axios.post("api/servicesjob", {
                    service_id: servId,
                    sjob: sjobId
                }).then(response => {
                    this.sjobDetailTotalCost = 0
                    this.newSjob = '--- Pilih Jasa Baru ---'
                    this.axios.get("api/servicesjob/" + servId).then(response => {
                        this.tableSJobs = response.data
                        for (var i = 0; i < this.tableSJobs.length; i++) {
                            this.sjobDetailTotalCost += this.tableSJobs[i].price
                        }
                        this.showAlertAddSjob = true

                    })
                })
            },

            addNewSpart() {
                var servId = document.getElementById("sId").innerHTML

                if (this.newSpart == '--- Pilih Spare Part Baru ---') {
                    return
                }
                var spartId = this.newSpart.replace(/ .*/, '')
                this.axios.post("api/servicespart", {
                    service_id: servId,
                    spart: spartId
                }).then(response => {
                    this.spartDetailTotalCost = 0
                    this.newSpart = '--- Pilih Spare Part Baru ---'
                    this.axios.get("api/servicespart/" + servId).then(response => {
                        this.tableSpart = response.data
                        for (var i = 0; i < this.tableSpart.length; i++) {
                            this.spartDetailTotalCost += this.tableSpart[i].price
                        }
                        this.showAlertAddSpart = true

                    })
                })
            },

            loadData() {
                var i = 0

                //Get service data from database
                this.axios.get("api/servicehistory").then(response => {

                    //Declare table data container
                    this.tableData = []

                    //Declare shown table data
                    this.tableDataShow = []

                    //Declare shown data based on pagenumber
                    this.pageShow = []

                    //Data page number
                    this.dataPage = 1

                    //Set pagenumBegin is true
                    this.isBegin = true

                    //Get API response data
                    this.tableData = response.data;
                    console.log(this.tableData)
                    //Get data length
                    this.tableDataLength = this.tableData.length
                    var counter = 0
                    var num = 1
                    var ind = 0

                    //Declare total data index
                    if (this.tableDataLength == 1) {
                        var i = 1
                    } else {
                        var i = this.tableDataLength - 1
                    }
                    var o = 0

                    //Looping - When total data index > 0
                    for (i; i > 0; i--) {
                        if (i == 0) {
                            break
                        }

                        //IF total data index % data perpage == 0
                        if (i % this.perPage == 0) {
                            var obj = { pageNumber: num, startIndex: ind }
                            this.pageShow.push(obj)
                            num++
                            ind = ind + this.perPage
                            continue
                        }//koreksi
                        else if (i % this.perPage > 0) {
                            if (i < this.perPage) {
                                o++
                                break
                            }  //\koreksi
                            continue
                        }
                    }

                    for (o; o > 0; o--) {
                        var obj = { pageNumber: num, startIndex: ind }
                        this.pageShow.push(obj)
                        num++
                        ind = ind + this.perPage
                    }

                    var m = 1
                    this.pageNumbers = []
                    for (var l = 1; l <= this.pageShow.length; l++) {
                        var obj = { number: m }
                        this.pageNumbers.push(obj)
                        m++
                    }

                    i = this.pageShow.length
                    var k = 0
                    this.tableDataShow.splice(0, this.perPage)

                    for (var j = 0; j < i; j++) {
                        if (this.dataPage == this.pageShow[j].pageNumber) {
                            for (k = this.pageShow[j].startIndex; k < this.perPage; k++) {
                                if (this.tableData[k] == null) {
                                    break
                                }
                                this.tableDataShow.push(this.tableData[k])
                            }
                        }
                    }

                    if (k == (this.tableDataLength)) {
                        this.isEnd = true
                    }
                    else {
                        this.isEnd = false
                    }

                    // console.log(k)
                    // console.log(this.tableDataLength)
                });
            },
            nextPagination() {
                this.isBegin = false
                var k = 0

                this.dataPage++
                this.tableDataShow.splice(0, this.perPage)
                var i = this.pageShow.length
                for (var j = 0; j < i; j++) {
                    if (this.dataPage == this.pageShow[j].pageNumber) {
                        k = this.pageShow[j].startIndex
                        for (var counter = 0; counter < this.perPage; counter++) {
                            if (k == this.tableDataLength) {
                                break
                            }
                            this.tableDataShow.push(this.tableData[k])
                            k++
                        }
                    }
                }

                if (k == (this.tableDataLength)) {
                    this.isEnd = true
                }
            },
            previousPagination() {
                var k = 0

                this.dataPage--
                this.tableDataShow.splice(0, this.perPage)
                var i = this.pageShow.length
                for (var j = 0; j < i; j++) {
                    if (this.dataPage == this.pageShow[j].pageNumber) {
                        k = this.pageShow[j].startIndex
                        for (var counter = 0; counter < this.perPage; counter++) {
                            if (k == 0) {
                                this.isBegin = true
                            }
                            this.tableDataShow.push(this.tableData[k])
                            k++
                        }
                    }
                }
                if (k < this.tableDataLength) {
                    this.isEnd = false
                }
            },
            changePage(buttNum) {
                this.dataPage = buttNum
                this.isBegin = false
                var k = 0

                this.tableDataShow.splice(0, this.perPage)
                var i = this.pageShow.length
                for (var j = 0; j < i; j++) {
                    if (this.dataPage == this.pageShow[j].pageNumber) {
                        k = this.pageShow[j].startIndex
                        for (var counter = 0; counter < this.perPage; counter++) {
                            if (k == 0) {
                                this.isBegin = true
                            }
                            if (k == this.tableDataLength) {
                                break
                            }
                            this.tableDataShow.push(this.tableData[k])
                            k++
                        }
                    }
                }

                if (k == (this.tableDataLength)) {
                    this.isEnd = true
                }
                if (k < this.tableDataLength) {
                    this.isEnd = false
                }
            },
            addData() {
                var custId = this.model.customer.replace(/ .*/, '');
                var techId = this.model.technician.replace(/ .*/, '');
                var spartId = this.model.spart.replace(/ .*/, '');
                var sjobId = this.model.sjob.replace(/ .*/, '');
                var scatId = this.model.scategory.replace(/ .*/, '');
                this.axios.post("api/service", {
                    teller: this.model.teller,
                    customer: custId,
                    technician: techId,
                    spart: spartId,
                    kilometer: this.model.kilometer,
                    vehicle_license: this.model.vehicle_license,
                    sjob: sjobId,
                    vehicle_name: this.model.vehicle_name,
                    complaint_desc: this.model.complaint_desc,
                    scategory: scatId,
                    service_desc: this.model.service_desc
                })
                    .then(response => {
                        //close modal
                        this.modals.modal_add_service = false
                        this.loadData();
                        this.model.customer = '--- Pilih Nama Pelanggan ---',
                            this.model.technician = '--- Pilih Nama Teknisi ---',
                            this.model.spart = '--- Pilih Spare Part ---',
                            this.model.kilometer = '',
                            this.model.vehicle_license = '',
                            this.model.sjob = '--- Pilih Jasa Servis ---',
                            this.model.vehicle_name = '',
                            this.model.complaint_desc = '',
                            this.model.scategory = '--- Pilih Kategori Servis ---',
                            this.model.service_desc = ''
                        this.showAlertAdd = true
                    });
            },

            updatePost(index) {
                //Update data in database via API
                this.axios.post("/api/service/update", {
                    name: this.editPost,
                    address: this.editPost2,
                    phone: this.editPost3,
                    service_id: this.updateId
                }).then(response => {
                    this.loadData()
                });
                this.editOffset = -1
                this.editOffset2 = -1
                this.editOffset3 = -1
                this.editPostOri = {}
                this.editPostOri2 = {}
                this.editPostOri3 = {}
                this.editPost = {}
                this.editPost2 = {}
                this.editPost3 = {}
                this.showAlertUpdate = true
            },

        },
        computed: {
            filteredDataShow() {
                return this.tableDataShow.filter((datas) => {
                    if (this.searchFilter == '--- Filter Pencarian ---') {
                        return datas
                    } 
                    if (this.searchFilter == 'Servis Id') {
                        return datas.service_id.toString().match(this.searchKey)
                    }
                    if (this.searchFilter == 'Pelanggan') {
                        return datas.customer.match(this.searchKey)
                    }
                    if (this.searchFilter == 'Kendaraan') {
                        return datas.vehicle_name.match(this.searchKey)
                    } 
                    if (this.searchFilter == 'Teknisi') {
                        return datas.technician.match(this.searchKey)
                    }
                })
            }
        }
    }
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

    .cust-tr {
        background-color: rgb(245, 245, 245);
    }
</style>