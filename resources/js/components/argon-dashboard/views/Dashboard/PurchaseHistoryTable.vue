<template>
  <div class="card">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col-7">
          <h3 class="mb-0">Data Pembelian Spare Part</h3>
        </div>
        <div class="col-5 text-right">
          <select class="cust-form w-40 mb-3" v-model="searchFilter">
            <option selected>--- Filter Pencarian ---</option>
            <option>Id Pembelian</option>
            <option>Nama</option>
            <option>Supplier</option>
          </select>
          <base-input placeholder="Cari" class="input-group-alternative" alternative="" addon-right-icon="fas fa-search"
            v-model="searchKey">
          </base-input>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table align-items-center table-flush">
        <tr class="cust-tr">
          <th>Id Pembelian</th>
          <th>Nama</th>
          <th>Supplier</th>
          <th>Tanggal Pembelian</th>
          <th>Jumlah</th>
          <th>Harga</th>
        </tr>
        <tr v-for="row in filteredDataShow">
          <td>
            {{row.purchase_id}}
          </td>
          <td>
            {{row.spart}}
          </td>
          <td>
            {{row.supplier}}
          </td>
          <td>
            {{row.purchase_date}}
          </td>
          <td>
            {{row.quantity}}
          </td>
          <td>
            {{row.buyPrice}}
          </td>
        </tr>
      </table>
    </div>

  </div>
</template>
<script>
  export default {
    name: 'page-visits-table',
    data() {
      return {
        searchKey: '',
        searchFilter: '--- Filter Pencarian ---',
        tableData: []
      }
    },
    created() {
      this.loadPurchases()
    },
    methods: {
      loadPurchases() {
        let reqConfig = {
          headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } 
        }
        this.axios.get("api/purchases", reqConfig).then(response => {
          this.tableData = response.data.data
        })
      }
    },
      computed: {
        filteredDataShow() {
          return this.tableData.filter((datas) => {
            if (this.searchFilter == '--- Filter Pencarian ---') {
              return datas
            }
            if (this.searchFilter == 'Id Pembelian') {
              return datas.purchase_id.toString().match(this.searchKey)
            }
            if (this.searchFilter == 'Nama') {
              return datas.spart.match(this.searchKey)
            }
            if (this.searchFilter == 'Supplier') {
              return datas.supplier.match(this.searchKey)
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