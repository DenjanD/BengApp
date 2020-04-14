<template>
    <!-- Sidebar  -->
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <img src='images/logo.png' style="max-width: 50px; max-height: 50px;">
                <b>BengMotor</b>
            </div>

            <ul class="list-unstyled components">
                <li class="text-center">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                        <i class="fa fa-chart-bar fa-2x" style="margin-right: 0px;"></i>
                        <p>Peminjaman</p>
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li class="">
                            <a href="#">
                                <i class="fa fa-archive fa-2x" style="margin-right: 0px;"></i>
                                <p>Order Peminjaman</p>
                            </a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fa fa-archive fa-2x" style="margin-right: 0px;"></i>
                                <p>Riwayat Peminjaman</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="text-center">
                    <a href="#">
                        <i class="fa fa-archive fa-2x" style="margin-right: 0px;"></i>
                        <p>Data Inventaris</p>
                    </a>
                </li>
                <li class="text-center">
                    <a href="#">
                        <i class="fa fa-cart-plus fa-2x" style="margin-right: 0px;"></i>
                        <p>Pembelian</p>
                    </a>
                </li>
                <li class="text-center">
                    <router-link to="/laporan">
                        <i class="fa fa-book fa-2x" style="margin-right: 0px;"></i>
                        <p>Laporan</p>
                    </router-link>
                </li>
                <li class="text-center">
                    <a href="#">
                        <i class="fa fa-user fa-2x" style="margin-right: 0px;"></i>
                        <p>Data Peminjam</p>
                    </a>
                </li>
                <li class="text-center logout">
                    <a href="#" v-on:click="logout()">
                        <i class="fa fa-power-off fa-2x" style="margin-right: 0px;"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <div id="content">
            <router-view></router-view>
        </div>

    </div>
</template>
<script>
    export default {
        created() {
            var tokenCheck = localStorage.getItem('token');
            if(!tokenCheck){
                window.location.href='/login';
            }
        },
        methods: {
            logout() {
                axios
                    .post("http://localhost:8000/api/logout")
                    .then(response => {
                        localStorage.removeItem('token');
                        window.location.href='/login';
                    });
            }
        }
    }
</script>