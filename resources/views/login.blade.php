<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Page Title -->
    <title>BengApp - Login</title>
    <!-- Dependencies CSS -->
    <link rel="stylesheet" href="{{url('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <!-- Custom Style -->
    <style>
        body {
            background-color: white;
        }

        input[type="text"],
        select.form-control {
            background: transparent;
            border: none;
            border-bottom: 2px solid #0193DE;
            -webkit-box-shadow: none;
            box-shadow: none;
            border-radius: 0;
        }

        input[type="password"],
        select.form-control {
            background: transparent;
            border: none;
            border-bottom: 2px solid #0193DE;
            -webkit-box-shadow: none;
            box-shadow: none;
            border-radius: 0;
        }

        input[type="text"]:focus,
        select.form-control:focus {
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        input[type="password"]:focus,
        select.form-control:focus {
            -webkit-box-shadow: none;
            box-shadow: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row align-items-center h-100">
            <div class="col-12 mx-auto">
                <div class="card border-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <p>
                                    <img src="img/logo.png" style="max-width: 150px; max-height: 150px;">
                                    <h2 class="text-left font-weight-bold">
                                        BengkelApp
                                    </h2>
                                    <p class="lead">Atur Servis Lebih Mudah.</p>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <!-- <h1 class="mb-5">Login</h1> -->

                                <div class="form-group mt-4">
                                    <label for="inputID">Nama</label>
                                    <input class="form-control" id="kolnama" name="nama" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="inputPASS">Password</label>
                                    <input class="form-control" id="kolpassword" name="password" type="password">
                                </div>
                                <div class="alert-danger">

                                </div>
                                <div class="form-group mt-1">
                                    <button class="btn btn-primary btn-block btn-lg" onclick="login()">Login</button>
                                </div>

                                <!-- Script Cek Kolom Kosong -->
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        var tokenCheck = localStorage.getItem('token');
                                        if (tokenCheck) {
                                            window.location.href = '/';
                                        }
                                    });

                                    function login() {
                                        if (cekkolom() == true) {
                                            var nameS = document.getElementById("kolnama").value;
                                            var passwordS = document.getElementById("kolpassword").value;
                                            $.ajax({
                                                url: '{{ url("api/login") }}',
                                                type: 'POST',
                                                data: {
                                                    name: nameS,
                                                    password: passwordS,
                                                    confirmation: passwordS
                                                },
                                                success: function (result) {
                                                    localStorage.setItem('token', result.token);
                                                    window.location.href = '/';
                                                }
                                            })
                                        }
                                    }

                                    function cekkolom() {
                                        //ambil value tiap kolom
                                        var userlog = document.getElementById("kolnama").value;
                                        var passlog = document.getElementById("kolpassword").value;

                                        //cek kolom jika kosong
                                        if (userlog == '') {
                                            swal('Peringatan', 'Kolom Nama masih kosong!', 'warning');
                                            return false;
                                        }
                                        else if (passlog == '') {
                                            swal('Peringatan', 'Kolom Password masih kosong!', 'warning');
                                            return false;
                                        }
                                        else {
                                            return true;
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Include JS -->
    <script src="{{url('js/jquery-3.4.1.js')}}"></script>
    <script src="{{url('js/sweetalert.min.js')}}"></script>
</body>

</html>