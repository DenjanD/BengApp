<template>
    <div>
        <base-header type="gradient-danger" class="pb-6 pb-8 pt-5 pt-md-8">
        </base-header>

        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <supplier-table title="Data Supplier"></supplier-table>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import SupplierTable from './Tables/SupplierTable'
    export default {
        name: 'tables',
        components: {
            SupplierTable
        }
    };
</script>
<style></style>