<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            background: linear-gradient(to bottom, #1a1a1a, #3700b3);
             color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .register-card {
            width: 100%;
            max-width: 600px; /* Ukuran card dibuat lebih lebar */
            margin: 20px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            background-color: #2d2d2d;
        }

        .card-header{
            background-color: #2d2d2d;
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
             position: relative; /* Tambahkan ini untuk styling bagian judul */
             overflow: hidden; /* Tambahkan ini untuk memotong border */
            
        }
       .card-header::before{
           content: ''; /* Tambahkan pseudo-element untuk style tambahan pada judul*/
            position: absolute;
             top: 0;
             left: 0;
             width: 100%;
             height: 5px; /* Tebal garis batas */
             background: linear-gradient(to right, #4a148c, #6a1b9a); /* gradasi ungu*/

       }
        .card-header h1{
            margin-top: 20px;
            position: relative; /* Tambahkan ini untuk styling bagian judul */
           
        }


         .card-body {
            padding: 25px;
        }
        .input-group-text {
              background-color: #4a148c;
              color: #fff;
               border: none;
        }
        .form-control {
           background-color: #444;
            color: #fff;
            border: 1px solid #666;
        }

         .form-control::placeholder {
             color: #aaa;
        }

         .btn-primary {
              background-color: #4a148c;
              border: none;
        }
         .btn-primary:hover {
            background-color: #6a1b9a;
        }
        .text-muted {
            color: #aaa !important;
        }

    </style>
</head>
<body class="bg-gray-900 text-white">
    <div class="register-box">
        <div class="register-card">
            <div class="card-header text-center">
                 <a href="#" class="h1"><b>Daftar</b></a>
            </div>
            <div class="card-body">
                <x-flashdata />

                <form action="{{ route('process-register') }}" method="post">
                    @csrf
                    <div class="mb-3 flex items-center">
                         <div class="input-group-prepend mr-2">
                            <div class="input-group-text">
                                <span class="fas fa-store"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control flex-1 rounded-md py-2 px-3 focus:outline-none" placeholder="Nama Outlet" name="outlet_name"
                            value="{{ old('outlet_name') }}" required>
                    </div>
                    <div class="mb-3 flex items-center">
                         <div class="input-group-prepend mr-2">
                            <div class="input-group-text">
                                <span class="fas fa-map-marker-alt"></span>
                            </div>
                        </div>
                         <input type="text" class="form-control flex-1 rounded-md py-2 px-3 focus:outline-none" placeholder="Alamat" name="outlet_address"
                            value="{{ old('outlet_address') }}" required>
                    </div>

                     <div class="mb-3 flex items-center">
                         <div class="input-group-prepend mr-2">
                            <div class="input-group-text">
                                 <span class="fas fa-phone"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control flex-1 rounded-md py-2 px-3 focus:outline-none" placeholder="Kontak" name="outlet_phone"
                            value="{{ old('outlet_phone') }}" required>
                    </div>
                     <div class="mb-3 flex items-center">
                         <div class="input-group-prepend mr-2">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control flex-1 rounded-md py-2 px-3 focus:outline-none" placeholder="Username" name="username"
                            value="{{ old('username') }}" required>
                    </div>
                    <div class="mb-3 flex items-center">
                        <div class="input-group-prepend mr-2">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="email" class="form-control flex-1 rounded-md py-2 px-3 focus:outline-none" placeholder="Email" name="email"
                            value="{{ old('email') }}" required>
                    </div>

                     <div class="mb-3 flex items-center">
                         <div class="input-group-prepend mr-2">
                            <div class="input-group-text">
                                <span class="fas fa-id-card text-bg-dark"></span>
                            </div>
                        </div>
                         <select class="form-control flex-1 rounded-md py-2 px-3 focus:outline-none text-black" name="membership_id" required>
                            <option value="" disabled selected>Pilih Membership</option>
                            @foreach ($memberships as $membership)
                                <option value="{{ $membership->membership_id }}" {{ old('membership_id') == $membership->membership_id ? 'selected' : '' }}>{{ $membership->membership_name }}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="mb-3 flex items-center">
                        <div class="input-group-prepend mr-2">
                             <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" class="form-control flex-1 rounded-md py-2 px-3 focus:outline-none" placeholder="Password" name="password" required>
                    </div>

                   <div class="mb-3 flex items-center">
                       <div class="input-group-prepend mr-2">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" class="form-control flex-1 rounded-md py-2 px-3 focus:outline-none" placeholder="Konfirmasi Password"
                            name="password_confirmation" required>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn-primary w-full py-2 px-4 rounded-md">Daftar</button>
                    </div>
                </form>

                <a href="{{ route('login') }}" class="text-center block mt-4 text-gray-300">Saya sudah punya membership</a>
            </div>
        </div>
    </div>
</body>
</html>