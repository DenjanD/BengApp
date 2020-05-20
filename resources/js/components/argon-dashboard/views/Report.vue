<template>
    <div>
        <base-header type="gradient-danger" class="pb-6 pb-8 pt-5 pt-md-8">
        </base-header>

        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div>
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <h3>Buat Laporan</h3>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <tabs fill class="flex-column flex-md-row">
                                        <card shadow>
                                            <tab-pane>
                                                <span slot="title">
                                                    <i class="ni ni-cloud-upload-96">
                                                        Laporan Servis</i>
                                                </span>
                                                <p class="description">Raw denim you probably haven't heard of them jean
                                                    shorts
                                                    Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.
                                                    Mustache
                                                    cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
                                                    butcher retro
                                                    keffiyeh dreamcatcher synth.</p>
                                            </tab-pane>

                                            <tab-pane title="Profile">
                                                <span slot="title">
                                                    <i class="ni ni-bell-55 mr-2">
                                                        Laporan Pembelian</i>
                                                </span>
                                                <p class="description">Cosby sweater eu banh mi, qui irure terry
                                                    richardson ex
                                                    squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis
                                                    cardigan
                                                    american apparel, butcher voluptate nisi qui.</p>
                                            </tab-pane>

                                            <tab-pane>
                                                <span slot="title">
                                                    <i class="ni ni-calendar-grid-58">
                                                        Laporan Penjualan</i>
                                                </span>
                                                <p class="description">Raw denim you probably haven't heard of them jean
                                                    shorts
                                                    Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.
                                                    Mustache
                                                    cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
                                                    butcher retro
                                                    keffiyeh dreamcatcher synth.</p>
                                            </tab-pane>
                                        </card>
                                    </tabs>
                                </div>
                            </div>
                            <div class="card footer">

                            </div>
                        </div>
                    </div>
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