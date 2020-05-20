<template>
  <div class="wrapper" :class="{ 'nav-open': $sidebar.showSidebar }">
    <side-bar
      :background="sidebarBackground"
      short-title="BengApp"
      title="BengApp"
    >
      <template slot="links">
        <sidebar-item
          :link="{
            name: 'Dashboard',
            icon: 'ni ni-tv-2 text-primary',
            path: '/dashboard'
          }"
        />

        <sidebar-item :link="{name: 'Servis', icon: 'ni ni-settings text-blue', path: '/service'}"/>
        <sidebar-item :link="{name: 'Jasa & Kategori Servis', icon: 'ni ni-collection text-default', path: '/jobcat'}"/>
        <sidebar-item :link="{name: 'Penjualan', icon: 'ni ni-money-coins text-orange', path: '/sales'}"/>
        <sidebar-item :link="{name: 'Spare Part', icon: 'ni ni-settings-gear-65 text-yellow', path: '/spart'}"/>
        <sidebar-item :link="{name: 'Supplier', icon: 'ni ni-box-2 text-red', path: '/supplier'}"/>
        <sidebar-item :link="{name: 'Teknisi', icon: 'ni ni-single-02 text-info', path: '/technician'}"/>
        <sidebar-item :link="{name: 'User', icon: 'ni ni-circle-08 text-primary', path: '/user'}"/>
        <sidebar-item :link="{name: 'Pelanggan', icon: 'ni ni-circle-08 text-success', path: '/customer'}"/>
        <sidebar-item :link="{name: 'Laporan', icon: 'ni ni-single-copy-04', path: '/report'}"/>

      </template>
    </side-bar>
    <div class="main-content" :data="sidebarBackground">
      <dashboard-navbar></dashboard-navbar>

      <div @click="toggleSidebar">
        <fade-transition :duration="200" origin="center top" mode="out-in">
          <!-- your content here -->
          <router-view></router-view>
        </fade-transition>
        <content-footer v-if="!$route.meta.hideFooter"></content-footer>
      </div>
    </div>
  </div>
</template>
<script>
  import DashboardNavbar from './DashboardNavbar.vue';
  import ContentFooter from './ContentFooter.vue';
  import { FadeTransition } from 'vue2-transitions';

  export default {
    components: {
      DashboardNavbar,
      ContentFooter,
      FadeTransition
    },
    data() {
      return {
        sidebarBackground: 'blue' //vue|blue|orange|green|red|primary
      };
    },
    methods: {
      toggleSidebar() {
        if (this.$sidebar.showSidebar) {
          this.$sidebar.displaySidebar(false);
        }
      }
    }
  };
</script>
<style lang="scss">
</style>
