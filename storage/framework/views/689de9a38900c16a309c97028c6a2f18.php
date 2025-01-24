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
            background-color: #f8f9fa; /* Latar belakang putih ala Google */
            color: #212529; /* Warna teks gelap ala Google */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
             font-family: 'Roboto', sans-serif; /* Font Google */
        }
        .register-card {
           width: 100%;
            max-width: 400px;
            margin: 20px;
             padding: 30px; /* Padding untuk konten di dalam card */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
            border-radius: 8px;
            background-color: #fff; /* Latar belakang card putih */
             border: 1px solid #e0e0e0; /* Border tipis */

        }
        .card-header {
          background-color: transparent;
             color: #212529; /* Warna teks gelap ala Google */
            padding: 10px;
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
              position: relative; /* Tambahkan ini untuk styling bagian judul */

        }
       .card-header::before{
            content: ''; /* Tambahkan pseudo-element untuk style tambahan pada judul*/
            position: absolute;
             top: 0;
             left: 50%;
            transform: translateX(-50%);
            width: 100px; /* Lebar garis batas */
             height: 2px; /* Tebal garis batas */
             background-color: #4285f4; /* warna biru google */
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
              color: #212529; /* Warna ikon input */

        }
        .form-control {
           border: 1px solid #ced4da;
             padding: 12px 15px;
            border-radius: 4px;
            transition: border-color 0.3s ease; /* Transisi hover */
             box-shadow: none; /* hilangkan shadow default */
            color: #212529; /* Warna teks input */
        }

        .form-control::placeholder {
             color: #999; /* Warna placeholder abu-abu */
        }

        .form-control:focus {
          outline: none;
           border-color: #4285f4; /* Warna biru google saat focus */
           box-shadow: 0 0 0 0.2rem rgba(66, 133, 244, 0.25); /* Shadow pada input ketika focus*/
        }
         select.form-control {
          appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;utf8,<svg fill='#999' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
             background-repeat: no-repeat;
            background-position: right 10px top 50%;
             padding-right: 30px;
            color: #212529;
        }
        .btn-primary {
           background-color: #4285f4; /* Biru Google */
            border: none;
           padding: 12px 20px;
            border-radius: 4px;
            color: #fff;
            transition: background-color 0.3s ease;
             display: block;
            width: 100%;
             font-weight: 500; /* Font weight lebih tebal */

        }

         .btn-primary:hover {
           background-color: #3367d6; /* Warna biru google saat hover */
        }
        .text-muted {
            color: #999 !important;
        }

         .text-gray-300:hover {
               color: #4285f4;
             transition: color 0.3s ease;
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

                    <div class="mb-3 flex items-center hidden">
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