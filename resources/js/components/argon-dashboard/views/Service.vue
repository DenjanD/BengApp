<template>
    <div>
        <base-header type="gradient-blue" class="pb-6 pb-8 pt-5 pt-md-8">
        </base-header>

        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <service-table title="Antrian Servis"></service-table>
                    <service-history-table class="mt-4" title="Riwayat Servis"></service-history-table>    
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    import ServiceTable from './Tables/ServiceTable'
    import ServiceHistoryTable from './Tables/ServiceHistoryTable'

  import Vue from 'vue'
  import VueClipboard from 'vue-clipboard2'
  import BTooltipDirective from 'bootstrap-vue'
  Vue.use(VueClipboard)
  export default {
    name: 'service',
    components: {
        ServiceTable,
        ServiceHistoryTable
    },
    directives: {
      'b-tooltip': BTooltipDirective
    },
    data() {
      return {
        
      }
    },
    methods: {
      onCopy() {
        this.$notify({
          type: 'success',
          title: 'Copied to clipboard'
        })
      }
    }
  };
</script>
<style></style>
