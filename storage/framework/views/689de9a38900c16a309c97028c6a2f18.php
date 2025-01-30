<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
     <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #1a1c1e;
            background-image: 
                radial-gradient(circle at 25px 25px, rgba(255, 255, 255, 0.2) 2%, transparent 0%),
                radial-gradient(circle at 75px 75px, rgba(255, 255, 255, 0.2) 2%, transparent 0%),
                linear-gradient(135deg, rgba(66, 133, 244, 0.3) 0%, rgba(45, 52, 54, 0.8) 100%);
            background-size: 100px 100px, 100px 100px, 100% 100%;
            background-position: 0 0;
            background-attachment: fixed; /* Keep background fixed while scrolling */
            animation: animateBackground 30s linear infinite;
            color: #e4e6eb;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Roboto', sans-serif;
            position: relative;
            padding: 20px 0; /* Add padding to prevent content touching edges */
            overflow-y: auto; /* Enable vertical scrolling */
            overflow-x: hidden; /* Prevent horizontal scroll */
        }

        /* Modify floating shapes to stay fixed */
        body::before,
        body::after {
            content: '';
            position: fixed; /* Keep elements fixed while scrolling */
            width: 300px;
            height: 300px;
            background: rgba(66, 133, 244, 0.1);
            border-radius: 50%;
            z-index: -1;
        }

        body::before {
            top: -100px;
            right: -100px;
            animation: float 15s infinite;
        }

        body::after {
            bottom: -100px;
            left: -100px;
            animation: float 20s infinite reverse;
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

        .register-box {
            width: 100%;
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-card {
            width: 100%;
            max-width: 500px; /* Increased from 400px */
            margin: 20px;
            padding: 40px; /* Increased padding */
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .card-header {
            background-color: transparent;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
            position: relative;
        }
        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 2px;
            background-color: #4285f4;
        }
        .card-header h1 {
             margin-top: 10px; /* Tambahkan margin top untuk styling bagian judul */
             font-weight: 500; /* Font weight lebih tebal */
        }
          .card-body {
           padding: 0;
        }
          .input-group-text {
           background-color: transparent; /* Latar belakang transparan pada input-group */
            border: none;
              color: #ffffff; /* Warna ikon input */
            font-size: 1.2rem; /* Larger icons */
            padding: 0 12px; /* Adjusted padding */
            width: 40px; /* Fixed width for icons container */
            height: 55px; /* Match input height */
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .input-group-prepend {
            margin-right: 15px; /* Increased spacing */
            display: flex;
            align-items: center;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
            padding: 16px 20px; /* Increased padding */
            font-size: 1.1rem; /* Larger font size */
            height: 55px; /* Fixed height for all inputs */
            line-height: 1.5;
            width: 100%;
            box-sizing: border-box;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #4285f4; /* Warna biru google saat focus */
            color: #ffffff;
        }
         select.form-control {
            background-color: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            height: 55px; /* Fixed height for select */
            font-size: 1.1rem;
            padding-right: 40px; /* Space for dropdown arrow */
        }
        select.form-control option {
            background-color: #2d3436;
            color: #ffffff;
        }
        .btn-primary {
            background: linear-gradient(45deg, #4285f4, #34495e);
            border: none;
            padding: 16px 24px; /* Larger button */
            font-size: 1.1rem;
            border-radius: 4px;
            color: #fff;
            transition: all 0.3s ease;
            height: 55px; /* Match input height */
            display: flex;
            align-items: center;
            justify-content: center;
        }

         .btn-primary:hover {
            background: linear-gradient(45deg, #34495e, #4285f4);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(66, 133, 244, 0.3);
        }
        .text-muted {
            color: #999 !important;
        }

         .text-gray-300 {
            color: rgba(255, 255, 255, 0.7);
        }

         .text-gray-300:hover {
            color: #4285f4;
            transition: color 0.3s ease;
        }

        /* Add flex container class for consistent alignment */
        .flex.items-center {
            min-height: 55px;
        }
    </style>
</head>
<body>
    <div class="register-box">
        <div class="register-card">
            <div class="card-header text-center">
                  <a href="#" class="h1"><b>Daftar</b></a>
            </div>
            <div class="card-body">
                <?php if (isset($component)) { $__componentOriginalcff26fc34c3f6c37ef09be86276b72c9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcff26fc34c3f6c37ef09be86276b72c9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flashdata','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flashdata'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcff26fc34c3f6c37ef09be86276b72c9)): ?>
<?php $attributes = $__attributesOriginalcff26fc34c3f6c37ef09be86276b72c9; ?>
<?php unset($__attributesOriginalcff26fc34c3f6c37ef09be86276b72c9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcff26fc34c3f6c37ef09be86276b72c9)): ?>
<?php $component = $__componentOriginalcff26fc34c3f6c37ef09be86276b72c9; ?>
<?php unset($__componentOriginalcff26fc34c3f6c37ef09be86276b72c9); ?>
<?php endif; ?>

                <form action="<?php echo e(route('process-register')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3 flex items-center">
                        <div class="input-group-prepend mr-2">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control flex-1 focus:outline-none" 
                            placeholder="Nama Lengkap" name="name"
                            value="<?php echo e(old('name')); ?>" required>
                    </div>
                    <div class="mb-3 flex items-center">
                         <div class="input-group-prepend mr-2">
                            <div class="input-group-text">
                                <span class="fas fa-store"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control flex-1 focus:outline-none" placeholder="Nama Outlet" name="outlet_name"
                            value="<?php echo e(old('outlet_name')); ?>" required>
                    </div>
                    <div class="mb-3 flex items-center">
                         <div class="input-group-prepend mr-2">
                            <div class="input-group-text">
                                <span class="fas fa-map-marker-alt"></span>
                            </div>
                        </div>
                         <input type="text" class="form-control flex-1 focus:outline-none" placeholder="Alamat" name="outlet_address"
                            value="<?php echo e(old('outlet_address')); ?>" required>
                    </div>

                     <div class="mb-3 flex items-center">
                         <div class="input-group-prepend mr-2">
                            <div class="input-group-text">
                                 <span class="fas fa-phone"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control flex-1 focus:outline-none" placeholder="Kontak" name="outlet_phone"
                            value="<?php echo e(old('outlet_phone')); ?>" required>
                    </div>
                     <div class="mb-3 flex items-center">
                         <div class="input-group-prepend mr-2">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control flex-1 focus:outline-none" placeholder="Username" name="username"
                            value="<?php echo e(old('username')); ?>" required>
                    </div>
                    <div class="mb-3 flex items-center">
                        <div class="input-group-prepend mr-2">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="email" class="form-control flex-1 focus:outline-none" placeholder="Email" name="email"
                            value="<?php echo e(old('email')); ?>" required>
                    </div>

                    <div class="mb-3 flex items-center"> <!-- removed 'hidden' class -->
                         <div class="input-group-prepend mr-2">
                            <div class="input-group-text">
                                <span class="fas fa-id-card text-bg-dark"></span>
                            </div>
                        </div>
                        <select class="form-control flex-1 focus:outline-none text-black" name="membership_id" required>
                            <option value="" disabled>Pilih Membership</option>
                            <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($membership->membership_id); ?>" <?php echo e(old('membership_id', '1') == $membership->membership_id ? 'selected' : ''); ?>><?php echo e($membership->membership_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3 flex items-center">
                        <div class="input-group-prepend mr-2">
                             <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" class="form-control flex-1 focus:outline-none" placeholder="Password" name="password" required>
                    </div>

                   <div class="mb-3 flex items-center">
                       <div class="input-group-prepend mr-2">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" class="form-control flex-1 focus:outline-none" placeholder="Konfirmasi Password"
                            name="password_confirmation" required>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn-primary w-full">Daftar</button>
                    </div>
                </form>

                <a href="<?php echo e(route('login')); ?>" class="text-center block mt-4 text-gray-300">Saya sudah punya membership</a>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/auth/register.blade.php ENDPATH**/ ?>