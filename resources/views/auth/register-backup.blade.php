<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Custom Styles -->
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(to right, #ffe0b2, #ffcc80);
            /* Gradasi orange lembut */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .register-card {
            width: 100%;
            max-width: 400px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #fff;
            /* Warna dasar putih untuk card */
        }

        .brand-logo {
            display: flex;
            justify-content: center;
        }

        .brand-logo img {
            max-width: 100px;
            /* Ukuran logo diperkecil */
            margin-bottom: 10px;
        }

        .register-card .card-header {
            background-color: #fff;
            /* Background header putih */
            color: #007bff;
            /* Warna teks biru */
            border-bottom: none;
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .register-card .card-body {
            padding: 25px;
        }

        .input-group-text {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Warna hover yang lebih gelap */
        }

        .text-muted {
            color: #6c757d !important;
        }

        .alert {
            margin-bottom: 20px;
        }
       /* Style untuk mengubah warna font pada select option */
    .input-group select.form-control option {
        color: #000;
    }
    </style>
</head>
<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary register-card">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>Register</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>
                
                {{-- Memanggil Komponen Flashdata --}}
                 <x-flashdata />

                <form action="{{ route('process-register') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-store"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Nama Outlet" name="outlet_name"
                            value="{{ old('outlet_name') }}" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-map-marker-alt"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Alamat" name="outlet_address"
                            value="{{ old('outlet_address') }}" required>
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Kontak" name="outlet_phone"
                            value="{{ old('outlet_phone') }}" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" name="username"
                            value="{{ old('username') }}" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="email" class="form-control" placeholder="Email" name="email"
                            value="{{ old('email') }}" required>
                    </div>
                      <div class="input-group mb-3 text-bg-dark">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-bg-dark">
                                    <span class="fas fa-id-card text-bg-dark"></span>
                                </div>
                            </div>
                            <select class="form-control" name="membership_id" required>
                                <option value="" disabled selected>Pilih Membership</option>
                                @foreach ($memberships as $membership)
                                    <option value="{{ $membership->membership_id }}" {{ old('membership_id') == $membership->membership_id ? 'selected' : '' }}>{{ $membership->membership_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" class="form-control" placeholder="Confirm Password"
                            name="password_confirmation" required>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->


    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>