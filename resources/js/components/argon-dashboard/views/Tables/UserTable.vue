<template>
  <div class="card shadow" :class="type === 'dark' ? 'bg-default': ''">
    <div class="card-header border-0" :class="type === 'dark' ? 'bg-transparent': ''">
      <div class="row align-items-center">
        <div class="col">
          <div class="row align-items-center">
            <div class="col-5">
              <h3 class="mb-0">Daftar User Aplikasi</h3>
            </div>
            <div class="col-7 text-right">
              <select class="cust-form w-40 mb-3" v-model="searchFilter">
                <option selected>--- Filter Pencarian ---</option>
                <option>Id User</option>
                <option>Nama</option>
                <option>Role User</option>
              </select>
              <base-button type="primary" size="sm" @click="modals.modal_add_user = true"><i class="ni ni-fat-add"
                  style="vertical-align: middle;"></i>Tambah Data</base-button>
              <base-input placeholder="Cari" class="input-group-alternative" alternative=""
                addon-right-icon="fas fa-search" v-model="searchKey">
              </base-input>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Alert after add table data -->
    <div v-show="showAlertAdd==true" class="alert alert-success alert-dismissible fade show" user="alert">
      <span class="alert-inner--icon"><i class="notification-70"></i></span>
      <span class="alert-inner--text">Data user telah berhasil disimpan</span>
      <button type="button" @click="showAlertAdd = false" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <!-- Alert after update table data -->
    <div v-show="showAlertUpdate==true" class="alert alert-success alert-dismissible fade show" user="alert">
      <span class="alert-inner--icon"><i class="notification-70"></i></span>
      <span class="alert-inner--text">Data user telah berhasil dirubah</span>
      <button type="button" @click="showAlertUpdate = false" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <!-- Alert after delete table data -->
    <div v-show="showAlertDelete==true" class="alert alert-success alert-dismissible fade show" user="alert">
      <span class="alert-inner--icon"><i class="notification-70"></i></span>
      <span class="alert-inner--text">Data user telah berhasil dihapus</span>
      <button type="button" @click="showAlertDelete = false" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <div class="table-responsive">
      <table class="table align-items-center table-flush">
        <tr class="cust-tr">
          <th>User Id</th>
          <th>Name</th>
          <th>Role User</th>
          <th>Aksi</th>
        </tr>
        <tr v-for="(row, index) in filteredDataShow">
          <td>
            {{row.user_id}}
          </td>
          <td>
            <span v-show="editOffset != row.name">{{row.name}}</span>
            <input v-show="editOffset==row.name" class="form-control" type="text" :id="'item-user-'+row.name"
              v-model="editPost">
          </td>
          <td>
            {{ row.role }}
          </td>
          <td>

            <span v-show="editOffset != row.name">

              <base-button type="danger" v-show="index != 0" size="sm" @click="deleteData(row.user_id)">
                <i class="fa fa-trash"></i> Hapus
              </base-button>
            </span>

            <span v-show="editOffset == row.name">
              <base-button type="success" size="sm" @click.prevent="updatePost(index)">
                <i class="fa fa-check"></i>
              </base-button>
              <base-button type="secondary" size="sm" @click.prevent="cancelEditing">
                <i class="fa fa-times"></i>
              </base-button>
            </span>

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

    <!-- Modal goes here -->
    <modal :show.sync="modals.modal_add_user">
      <template slot="header">
        <h5 class="modal-title" id="modal_add_user">Tambah User Baru</h5>
      </template>
      <div>
        <label>Nama User Baru</label>
        <form user="form">
          <base-input v-model="modals.newname" placeholder="Ketik nama di sini">
          </base-input>

          <label>Password User Baru</label>
          <base-input v-model="modals.newpass" placeholder="Ketik password di sini">
          </base-input>

          <label>Konfirmasi Password User</label>
          <base-input v-model="modals.newpassconf" placeholder="Ketik password di sini">
          </base-input>

          <label>Role User Baru</label>
          <select class="form-control" v-model="modals.newrole">
            <option selected>--- Pilih Role User ---</option>
            <option v-for="roles in roleData">
              {{ roles.role_id }} - {{ roles.name }}
            </option>
          </select>
        </form>
      </div>
      <template slot="footer">
        <base-button type="secondary" @click="modals.modal_add_user = false">Batal</base-button>
        <base-button type="primary" @click.prevent="addNewUser()">Simpan Data</base-button>
      </template>
    </modal>

    <modal :show.sync="modals.modal_delete_user">
      <template slot="header">
        <h5 class="modal-title" id="modal_delete_user">Hapus Data Teknisi</h5>
      </template>
      <div>
        <label>Anda yakin ingin menghapus data user ini?</label>
      </div>
      <template slot="footer">
        <base-button type="secondary" @click="modals.modal_delete_user = false">Batal</base-button>
        <base-button type="danger" @click.prevent="deleteDataConfirm()">Ya, Hapus Data</base-button>
      </template>
    </modal>

  </div>
</template>
<script>
  export default {
    data() {
      return {
        searchKey: '',
        searchFilter: '--- Filter Pencarian ---',
        roleData: {},
        modals: { modal_add_user: false, newname: '', newpass: '', newpassconf: '', newrole: '--- Pilih Role User ---', modal_delete_user: false },

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

        editOffset: -1,
        editPost: {},
        editPostOri: {},
        showAlertAdd: false,
        showAlertUpdate: false,
        showAlertDelete: false,
        updateId: {},
        deleteId: {}
      };
    },
    created() {
      this.loadRole();
      this.loadData();
    },
    name: 'user-table',
    props: {
      type: {
        type: String
      },
      title: String
    },
    methods: {
      addNewUser() {
        var roleid = this.modals.newrole.replace(/ .*/, '')
        var postData = {
          name: this.modals.newname,
          password: this.modals.newpass,
          password_confirmation: this.modals.newpassconf,
          role: roleid
        }
        let reqConfig = {
          headers: { Authorization: 'Bearer ' + localStorage.getItem('token') }
        }
        this.axios.post("api/register", postData, reqConfig)
          .then(response => {
            this.modals.modal_add_user = false
            this.loadData();
            this.modals.newname = '',
              this.modals.newpass = '',
              this.modals.newpassconf = '',
              this.modals.newrole = '--- Pilih Role User ---'
            this.showAlertAdd = true
          })
      },
      loadRole() {
        let reqConfig = {
          headers: { Authorization: 'Bearer ' + localStorage.getItem('token') }
        }
        this.axios.get("api/role", reqConfig).then(response => {
          this.roleData = response.data
        })
      },
      loadData() {
        var i = 0
        let reqConfig = {
          headers: { Authorization: 'Bearer ' + localStorage.getItem('token') }
        }
        //Get user data from database
        this.axios.get("api/users", reqConfig).then(response => {

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
        var postData = {
          name: this.modals.name
        }
        let reqConfig = {
          headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } 
        }
        this.axios.post("api/register", postData, reqConfig)
          .then(response => {
            //close modal
            this.modals.modal_add_user = false
            this.loadData();
            this.modals.name = ''
            this.showAlertAdd = true
          });
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
      updatePost(index) {
        //Update data in database via API
        var postData = {
          name: this.editPost,
          user_id: this.updateId
        }
        let reqConfig = {
          headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } 
        }
        this.axios.post("/api/user/update", postData, reqConfig).then(response => {
          this.loadData()
        });
        this.editOffset = -1
        this.editPostOri = {}
        this.editPost = {}
        this.showAlertUpdate = true
      },
      cancelEditing() {
        this.$set(this.tableData, this.editOffset, this.editPostOri)
        this.editOffset = -1
        this.editPostOri = {}
        this.editPost = {}
      },
      deleteData(id) {
        this.modals.modal_delete_user = true
        this.deleteId = id
      },
      deleteDataConfirm() {
        let reqConfig = {
          headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } 
        }
        this.axios.delete("/api/users/" + this.deleteId, reqConfig).then(response => {
          this.loadData()
          this.showAlertDelete = true
          this.modals.modal_delete_user = false
        });
      }
    },
    computed: {
      filteredDataShow() {
        return this.tableDataShow.filter((datas) => {
          if (this.searchFilter == '--- Filter Pencarian ---') {
            return datas
          }
          if (this.searchFilter == 'Id User') {
            return datas.user_id.toString().match(this.searchKey)
          }
          if (this.searchFilter == 'Nama') {
            return datas.name.match(this.searchKey)
          }
          if (this.searchFilter == 'Role User') {
            return datas.role.toString().match(this.searchKey)
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