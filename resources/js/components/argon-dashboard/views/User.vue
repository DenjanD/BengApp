<template>
  <div>
    <base-header type="gradient-primary" class="pb-6 pb-8 pt-5 pt-md-8">
    </base-header>
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-md-6 mt-4">
            <role-table title="Data Role User"></role-table>
        </div>
        <div class="col-md-6 mt-4">
            <user-table title="Data User Aplikasi"></user-table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import UserTable from './Tables/UserTable'
  import RoleTable from './Tables/RoleTable'
  export default {
    name: 'tables',
    components: {
      UserTable,
      RoleTable
    }
  };
</script>
<style></style>