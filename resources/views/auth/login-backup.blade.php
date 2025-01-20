<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

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

        .login-card {
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

        .login-card .card-header {
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

        .login-card .card-body {
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
    </style>
</head>

<body class="hold-transition login-page">
    <div class="card login-card">
        <div class="card-header">
            <div class="brand-logo">
                <img src="https://th.bing.com/th/id/OIP.4dcJ_AHTJ81dikKbJ_xBtgAAAA?rs=1&pid=ImgDetMain"
                    alt="Logo Konter HP">
            </div>
        </div>
 
        <div class="card-body">
            <x-flash-message />
            <h5 class="text-center">Login</h5>
            
         

            <form action="/auth/doLogin" method="post">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3">Login</button>
            </form>

            <p class="text-center mt-3"><a href="#">Forgot Password?</a></p>
            <p class="text-center">Don't have an account? <a href="/auth/register">Sign Up</a></p>
        </div>
    </div>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>