<template>
  <div>
    <base-header type="gradient-warning" class="pb-6 pb-8 pt-5 pt-md-8">
    </base-header>

    <!-- Container Tag -->
    <div class="container-fluid mt--7">
      <div class="row">

        <!-- Input Sale Card -->
        <div class="col-xl-4 order-xl-1 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col-md-12">
                  <h3 class="mt-3 mb-3">Tambah Penjualan</h3>
                  <hr class="my-4" />
                </div>
              </div>
              <div class="row">
                <div class="col-10">
                  <base-input alternative="" label="Kode Barang" placeholder="Ketik kode barang"
                    input-classes="form-control-alternative" v-model="spartCode"/>
                </div>
                <div class="col-2">
                  <button v-on:click="getSpartData" class="btn btn-primary btn-sm ml-n4 mt-5"><i class="fa fa-search"></i></button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <base-input alternative="" label="Nama Barang"
                    input-classes="form-control-alternative" v-model="spartName" disabled />
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <base-input alternative="" label="Harga"
                    input-classes="form-control-alternative" v-model="spartPrice" disabled />
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <base-input alternative="" label="Stok"
                    input-classes="form-control-alternative" v-model="spartQty" disabled />
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <base-input alternative="" type="number" label="Jumlah" v-model="spartBuyQty" placeholder="Ketik jumlah barang"
                    input-classes="form-control-alternative" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-primary btn-block" v-on:click="addToCart">Tambah Barang</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /Input Sale Card -->

        <!-- Cart Card -->
        <div class="col-xl-8 order-xl-1">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col-6">
                  <h3 class="mb-0">
                    Keranjang Belanja
                  </h3>
                </div>
                <div class="col-6 text-right">
                  <base-button type="primary" size="sm" v-if="tableData.length != 0" v-on:click="saveSale()">Simpan Penjualan</base-button>
                </div>
                <div class="col-12 mt-4">
                <!-- Alert after add save sale data -->
                  <div v-show="showAlertAdd==true" class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-inner--icon"><i class="notification-70"></i></span>
                    <span class="alert-inner--text">Data penjualan telah berhasil disimpan</span>
                    <button type="button" @click="showAlertAdd = false" class="close" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <label class="form-label">Total Tagihan :</label>
                  <input type="number" class="form-control" v-model="saleTotal" disabled>
                </div>
              </div>
            </div>

            <div class="table-responsive">
              <base-table class="table align-items-center table-flush"
               tbody-classes="list" :data="tableData">
                <template slot="columns">
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                  <th>Hapus</th>
                </template>

                <template slot-scope="{row}">
                  <td scope="row">
                    {{ row.no }}
                  </td>
                  <td>
                    {{ row.spartName }}
                  </td>
                  <td>
                    {{ row.spartPrice }}
                  </td>
                  <td>
                    {{ row.spartBuyQty }}
                  </td>

                  <td>
                    <button class="btn btn-danger btn-sm" v-on:click="deleteItem( row.spartCode )"><i class="fa fa-trash"></i></button>
                  </td>

                </template>

              </base-table>
            </div>

            <div class="card-footer d-flex justify-content-end">
           
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</template>
<script>
  export default {
      data() {
          return {
            tableData : [],

            spartCode: '',
            spartName: '',
            spartPrice: '',
            spartQty: '',
            spartBuyQty: 0,
            saleTotal: 0,
            cartItemNum: 1,

            showAlertAdd: false
          }
      },
      methods: {
        getSpartData() {
          this.axios.post("api/sales/getspart", {
            spartid: this.spartCode
          }).then(response => {
            this.spartName = response.data.spartData.spartName
            this.spartPrice = response.data.spartData.spartPrice
            this.spartQty = response.data.spartData.spartQty
          })
        },
        addToCart() {
          var newItem = {
            no: this.cartItemNum,
            spartCode: this.spartCode,
            spartName: this.spartName,
            spartPrice: this.spartPrice,
            spartBuyQty: Number(this.spartBuyQty)
          }

          //exceptions
          if (this.spartName == '' && this.spartPrice == '' && this.spartQty == '') {
            return swal('Peringatan','Barang belum ditambahkan. Silakan input kode barang terlebih dahulu','warning')
          }

          if (this.spartBuyQty < 1) {
            return swal('Peringatan','Jumlah penjualan barang minimal 1 (satu) buah','warning')
          }

          if (this.spartBuyQty > this.spartQty) {
            return swal('Peringatan','Jumlah penjualan tidak bisa lebih dari jumlah stok','warning')
          }

          //if spart is already added to the cart
          for (var i=0;i<this.tableData.length;i++) {
            if (this.spartCode == this.tableData[i].spartCode) {

              if (this.tableData[i].spartBuyQty + Number(this.spartBuyQty) > this.spartQty) {
                return swal('Peringatan','Periksa stok barang dengan jumlah penjualan','warning')
              }
              
              this.tableData[i].spartBuyQty += Number(this.spartBuyQty)
              this.saleTotal += this.tableData[i].spartPrice * this.spartBuyQty
              this.cartItemNum += 1
              this.spartCode = ''
              this.spartName = ''
              this.spartPrice = ''
              this.spartQty = ''
              this.spartBuyQty = 0
              return
            }
            //if spart doens't exists
            if (this.spartName == 'N/A') {
              // return alert('Barang tidak ditemukan, coba periksa kembali kode barang')
              return swal('Peringatan','Barang tidak ditemukan, coba periksa kembali kode barang','warning')
            }
          } 
          //if spart doens't exists
          if (this.spartName == 'N/A') {
              // return alert('Barang tidak ditemukan, coba periksa kembali kode barang')
              return swal('Peringatan','Barang tidak ditemukan, coba periksa kembali kode barang','warning')
            }
          
          //if spart doesn't added yet
          if (this.tableData.push(newItem)) {
            this.saleTotal += this.spartPrice * this.spartBuyQty
            this.cartItemNum += 1
            this.spartCode = ''
            this.spartName = ''
            this.spartPrice = ''
            this.spartQty = ''
            this.spartBuyQty = 0
          }      
        },
        deleteItem(spartCode) {
          for (var j=0;j<this.tableData.length;j++) {
            if (spartCode == this.tableData[j].spartCode) {
              this.saleTotal -= this.tableData[j].spartBuyQty * this.tableData[j].spartPrice
              this.tableData.splice(j,1)
            }
          }
        },
        saveSale(){
          this.axios.post("api/sales",{
            totalBill: this.saleTotal,
            saleData: this.tableData
          }).then(response => {
            this.tableData = []
            this.saleTotal = 0
            this.spartCode = ''
            this.spartName = ''
            this.spartPrice = ''
            this.spartQty = ''
            this.showAlertAdd = true
          })
        }
      }
  }
</script>
<style>
</style>