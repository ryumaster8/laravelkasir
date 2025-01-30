<!DOCTYPE html>
<html lang="id">

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
            background: #1a1c1e;
            background-image: 
                radial-gradient(circle at 25px 25px, rgba(255, 255, 255, 0.1) 2%, transparent 0%),
                radial-gradient(circle at 75px 75px, rgba(255, 255, 255, 0.1) 2%, transparent 0%),
                linear-gradient(135deg, #007bff 0%, #00264d 100%);
            background-size: 100px 100px, 100px 100px, 100% 100%;
            background-attachment: fixed;
            animation: animateBackground 30s linear infinite;
            position: relative;
            overflow-x: hidden;
        }

        /* Floating elements */
        .floating-shapes::before,
        .floating-shapes::after {
            content: '';
            position: fixed;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            z-index: -1;
            opacity: 0.5;
        }

        .floating-shapes::before {
            background: linear-gradient(45deg, #007bff, transparent);
            top: -100px;
            right: -100px;
            animation: float 15s infinite;
        }

        .floating-shapes::after {
            background: linear-gradient(45deg, #00264d, transparent);
            bottom: -100px;
            left: -100px;
            animation: float 20s infinite reverse;
        }

        /* Animated circles */
        .circles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .circles li {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: animate 25s linear infinite;
            bottom: -150px;
        }

        @keyframes animateBackground {
            0% {
                background-position: 0 0, 0 0, 0 0;
            }
            100% {
                background-position: 100px 100px, -100px -100px, 0 0;
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(100px, 50px) rotate(90deg);
            }
            50% {
                transform: translate(50px, 100px) rotate(180deg);
            }
            75% {
                transform: translate(-50px, 50px) rotate(270deg);
            }
        }

        .login-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 100%;
            max-width: 400px;
            margin: 20px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border-radius: 15px;
        }

        .card-header {
            background: transparent !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            padding: 25px 20px !important;
        }

        .card-header h3 {
            color: #fff;
            font-size: 24px;
            font-weight: 600;
            margin: 0;
            text-align: center;
        }

        .card-body {
            padding: 30px !important;
        }

        .card-body h5 {
            color: #fff;
            font-size: 18px;
            margin-bottom: 25px;
        }

        .input-group {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .input-group-text {
            background: transparent;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            padding: 12px 15px;
        }

        .form-control {
            background: transparent;
            border: none;
            color: #fff;
            padding: 12px 15px;
            height: auto;
            font-size: 16px;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            box-shadow: none;
            color: #fff;
        }

        .btn-primary {
            background: linear-gradient(45deg, #007bff, #00264d);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #00264d, #007bff);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
        }

        .card-body a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .card-body a:hover {
            color: #fff;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="floating-shapes"></div>
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="card login-card">
        <div class="card-header">
            <h3>Login</h3>
        </div>
 
        <div class="card-body">
            <?php if (isset($component)) { $__componentOriginalbb0843bd48625210e6e530f88101357e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbb0843bd48625210e6e530f88101357e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash-message','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flash-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbb0843bd48625210e6e530f88101357e)): ?>
<?php $attributes = $__attributesOriginalbb0843bd48625210e6e530f88101357e; ?>
<?php unset($__attributesOriginalbb0843bd48625210e6e530f88101357e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbb0843bd48625210e6e530f88101357e)): ?>
<?php $component = $__componentOriginalbb0843bd48625210e6e530f88101357e; ?>
<?php unset($__componentOriginalbb0843bd48625210e6e530f88101357e); ?>
<?php endif; ?>
            <form action="/auth/doLogin" method="post">
                <?php echo csrf_field(); ?>
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

            <p class="text-center mt-3"><a href="#">Lupa Password?</a></p>
            <p class="text-center">Belum punya akun? <a href="/auth/register">Daftar</a></p>
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

</html><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/auth/login.blade.php ENDPATH**/ ?>