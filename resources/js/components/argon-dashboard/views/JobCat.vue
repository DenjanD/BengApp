<template>
  <div>
    <base-header type="gradient-default" class="pb-6 pb-8 pt-5 pt-md-8">
    </base-header>
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-md-6">
          <s-job-table title="Data Jasa Servis"></s-job-table>
        </div>
        <div class="col-md-6">
          <s-cat-table></s-cat-table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import SJobTable from './Tables/SJobTable'
  import SCatTable from './Tables/SCatTable'
  export default {
    name: 'tables',
    components: {
      SJobTable,
      SCatTable
    }
  };
</script>
<style></style>