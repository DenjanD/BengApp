<template>
    <card shadow type="secondary">
        <div slot="header" class="bg-white border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">Data Spare Part</h3>
                </div>
            </div>
        </div>

        <!-- Alert after update table data -->
        <div v-show="showAlertUpdate==true" class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="notification-70"></i></span>
            <span class="alert-inner--text">Data spare part telah berhasil dirubah</span>
            <button type="button" @click="showAlertUpdate = false" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Alert after delete table data -->
        <div v-show="showAlertDelete==true" class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="notification-70"></i></span>
            <span class="alert-inner--text">Data spare part telah berhasil dihapus</span>
            <button type="button" @click="showAlertDelete = false" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="table-responsive">
            <base-table class="table align-items-center table-flush" :class="type === 'dark' ? 'table-dark': ''"
                :thead-classes="type === 'dark' ? 'thead-dark': 'thead-light'" tbody-classes="list"
                :data="tableDataShow">
                <template slot="columns">
                    <th>Nama Barang</th>
                    <th>Merek</th>
                    <th>Harga Jual</th>
                    <th>Jumlah</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </template>

                <template slot-scope="{row,index}">
                    <td>
                        <span v-show="editOffset != row.name">{{ row.name }}</span>
                        <input v-show="editOffset==row.name" class="form-control" type="text"
                            :id="'item-user-'+row.name" v-model="editPost">
                    </td>
                    <td>
                        <span v-show="editOffset2 != row.brand">{{ row.brand }}</span>
                        <input v-show="editOffset2==row.brand" class="form-control" type="text"
                            :id="'item-user-'+row.brand" v-model="editPost2">
                    </td>
                    <td>
                        <span v-show="editOffset3 != row.price">{{ row.price }}</span>
                        <input v-show="editOffset3==row.price" class="form-control" type="text"
                            :id="'item-user-'+row.price" v-model="editPost3">
                    </td>
                    <td>
                        <span v-show="editOffset4 != row.quantity">{{ row.quantity }}</span>
                        <input v-show="editOffset4==row.quantity" class="form-control" type="text"
                            :id="'item-user-'+row.quantity" v-model="editPost4">
                    </td>
                    <td>
                        <span v-show="editOffset5 != row.category_name">{{ row.category_name }}</span>
                        <select v-show="editOffset5==row.category_name" class="form-control cust-form" type="text"
                            :id="'item-user-'+row.category_name" v-model="editPost5">
                            <option selected>Pilih</option>
                            <option v-for="item in categories">
                                {{ item.sp_category_id }} {{ item.name }}
                            </option>
                        </select>
                    </td>
                    <td>
                        <span v-show="editOffset != row.name">
                            <base-button type="success" size="sm"
                                @click.prevent="startEditing(row.name,row.spart_id);startEditing2(row.brand);startEditing3(row.price);startEditing4(row.quantity);startEditing5(row.category_name)">
                                <i class="fa fa-pen"></i> Ubah
                            </base-button>
                            <base-button type="danger" size="sm" @click="deleteData(row.spart_id)">
                                <i class="fa fa-trash"></i> Hapus
                            </base-button>
                        </span>

                        <span v-show="editOffset == row.name">
                            <base-button type="success" size="sm"
                                @click.prevent="updatePost(row.spart_id, row.category_name)">
                                <i class="fa fa-check"></i>
                            </base-button>
                            <base-button type="secondary" size="sm" @click.prevent="cancelEditing">
                                <i class="fa fa-times"></i>
                            </base-button>
                        </span>
                    </td>
                </template>
            </base-table>

            <!-- Modal goes here -->
            <modal :show.sync="modals.modal_delete_spart">
                <template slot="header">
                    <h5 class="modal-title" id="modal_delete_spart">Hapus Data Spare Part</h5>
                </template>
                <div>
                    <label>Anda yakin ingin menghapus data spart ini?</label>
                </div>
                <template slot="footer">
                    <base-button type="secondary" @click="modals.modal_delete_spart = false">Batal</base-button>
                    <base-button type="danger" @click.prevent="deleteDataConfirm()">Ya, Hapus Data</base-button>
                </template>
            </modal>

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
    </card>
</template>
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
<script>
    export default {
        props: {
            type: {
                type: String
            },
            title: String
        },
        data() {
            return {
                modals: { name: '', modal_delete_spart: false },

                categories: [],

                //Paginations
                tableData: [],
                tableDataLength: 0,
                tableDataShow: [],
                pageShow: [],
                perPage: 10,
                pageNumbers: [],
                paginations: 0,
                dataPage: 1,
                isBegin: true,
                isEnd: true,
                selected: "",

                //Data Edit/Delete
                editOffset: -1,
                editOffset2: -1,
                editOffset3: -1,
                editOffset4: -1,
                editOffset5: -1,
                editPost: {},
                editPost2: {},
                editPost3: {},
                editPost4: {},
                editPost5: {},
                editPostOri: {},
                editPostOri2: {},
                editPostOri3: {},
                editPostOri4: {},
                editPostOri5: {},
                showAlertAdd: false,
                showAlertUpdate: false,
                showAlertDelete: false,
                updateId: {},
                deleteId: {}
            }
        },
        created() {
            this.loadData();
        },
        methods: {
            loadData() {
                this.axios.get("api/spart").then(
                    response => {
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
                        this.tableData = response.data.data;
                        this.categories = response.data.spartcategories

                        //Get data length
                        this.tableDataLength = this.tableData.length
                        var counter = 0
                        var num = 1
                        var ind = 0

                        //Declare total data index
                        if (this.tableDataLength == 1) {
                      var i = 1
                    }else {
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
                    }
                )
            },
            startEditing(name, id) {
                this.updateId = id
                this.editOffset = name
                this.editPost = name
                this.editPostOri = JSON.parse(JSON.stringify(this.editPost))
                //set focus to input element
                this.$nextTick(function () {
                    document.getElementById('item-user-' + this.editOffset).focus()
                }.bind(this))
            },
            startEditing2(brand) {
                this.editOffset2 = brand
                this.editPost2 = brand
                this.editPostOri2 = JSON.parse(JSON.stringify(this.editPost2))
                //set focus to input element
                this.$nextTick(function () {
                    document.getElementById('item-user-' + this.editOffset2).focus()
                }.bind(this))
            },
            startEditing3(price) {
                this.editOffset3 = price
                this.editPost3 = price
                this.editPostOri3 = JSON.parse(JSON.stringify(this.editPost3))
                //set focus to input element
                this.$nextTick(function () {
                    document.getElementById('item-user-' + this.editOffset3).focus()
                }.bind(this))
            },
            startEditing4(quantity) {
                this.editOffset4 = quantity
                this.editPost4 = quantity
                this.editPostOri4 = JSON.parse(JSON.stringify(this.editPost4))
                //set focus to input element
                this.$nextTick(function () {
                    document.getElementById('item-user-' + this.editOffset4).focus()
                }.bind(this))
            },
            startEditing5(kategori) {
                this.editOffset5 = kategori
                this.editPost5 = kategori
                this.editPostOri5 = JSON.parse(JSON.stringify(this.editPost5))
                //set focus to input element
                this.$nextTick(function () {
                    document.getElementById('item-user-' + this.editOffset5).focus()
                }.bind(this))
            },
            updatePost(index, catName) {
                if (this.editPost5 != catName) {
                    //get category id value from select
                    var limitSpacePosition = this.editPost5.indexOf(" ")
                    console.log(this.editPost5)
                    var catId = ""
                    for (var i = 0; i < limitSpacePosition; i++) {
                        catId = catId + this.editPost5.charAt(i)
                    }
                }

                //Update data in database via API
                this.axios.post("/api/spart/update", {
                    name: this.editPost,
                    brand: this.editPost2,
                    price: this.editPost3,
                    quantity: this.editPost4,
                    category: catId,
                    spart_id: this.updateId
                }).then(response => {
                    this.loadData()
                });
                this.editOffset = -1
                this.editOffset2 = -1
                this.editOffset3 = -1
                this.editOffset4 = -1
                this.editOffset5 = -1
                this.editPostOri = {}
                this.editPostOri2 = {}
                this.editPostOri3 = {}
                this.editPostOri4 = {}
                this.editPostOri5 = {}
                this.editPost = {}
                this.editPost2 = {}
                this.editPost3 = {}
                this.editPost4 = {}
                this.editPost5 = {}
                this.showAlertUpdate = true
            },
            cancelEditing() {
                this.$set(this.tableData, this.editOffset, this.editPostOri)
                this.editOffset = -1
                this.editOffset2 = -1
                this.editOffset3 = -1
                this.editOffset4 = -1
                this.editOffset5 = -1
                this.editPostOri = {}
                this.editPostOri2 = {}
                this.editPostOri3 = {}
                this.editPostOri4 = {}
                this.editPostOri5 = {}
                this.editPost = {}
                this.editPost2 = {}
                this.editPost3 = {}
                this.editPost4 = {}
                this.editPost5 = {}
            },
            deleteData(id) {
                this.modals.modal_delete_spart = true
                this.deleteId = id
            },
            deleteDataConfirm() {
                this.axios.delete("/api/spart/" + this.deleteId).then(response => {
                    this.loadData()
                    this.showAlertDelete = true
                    this.modals.modal_delete_spart = false
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
            }
        }
    }
</script>