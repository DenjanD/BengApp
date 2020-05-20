<template>
  <div class="card">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col-7">
          <h3 class="mb-0">Data Penjualan Spare Part</h3>
        </div>
        <div class="col-5 text-right">
          <select class="cust-form w-40 mb-3" v-model="searchFilter">
            <option selected>--- Filter Pencarian ---</option>
            <option>Kode Penjualan</option>
            <option>Id Penjualan</option>
            <option>Barang</option>
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
          <th>Kode Penjualan</th>
          <th>Id Penjualan</th>
          <th>Barang</th>
          <th>Jumlah</th>
          <th>Total</th>
          <th>Tgl Penjualan</th>
        </tr>
        <tr v-for="row in filteredDataShow">
          <td>
            {{row.id}}
          </td>
          <td>
            {{row.sale_id}}
          </td>
          <td>
            {{row.name}}
          </td>
          <td>
            {{row.quantity}}
          </td>
          <td>
            {{row.total_price}}
          </td>
          <td>
            {{row.sold_date}}
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
        this.axios.get("api/salesd", reqConfig).then(response => {
          this.tableData = response.data
        })
      }
    },
      computed: {
        filteredDataShow() {
          return this.tableData.filter((datas) => {
            if (this.searchFilter == '--- Filter Pencarian ---') {
              return datas
            }
            if (this.searchFilter == 'Kode Penjualan') {
              return datas.id.toString().match(this.searchKey)
            }
            if (this.searchFilter == 'Id Penjualan') {
              return datas.sale_id.toString().match(this.searchKey)
            }
            if (this.searchFilter == 'Barang') {
              return datas.name.match(this.searchKey)
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