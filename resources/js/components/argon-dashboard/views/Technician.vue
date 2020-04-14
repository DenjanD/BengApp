<template>
  <div>
    <base-header type="gradient-info" class="pb-6 pb-8 pt-5 pt-md-8">
    </base-header>
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <technician-table title="Data Teknisi"></technician-table>

        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import TechnicianTable from './Tables/TechnicianTable'
  export default {
    name: 'tables',
    components: {
      TechnicianTable,
    }
  };
</script>
<style></style>