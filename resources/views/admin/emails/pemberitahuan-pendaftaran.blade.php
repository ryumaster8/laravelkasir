<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Pendaftaran Pelanggan Baru</title>
    <style>
         body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { width: 80%; margin: 20px auto; background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { color: #333; margin-bottom: 20px; }
        p { line-height: 1.6; color: #555; margin-bottom: 15px; }
        strong { font-weight: bold; color: #333; }
        .detail-container { background-color: #f9f9f9; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
        .detail-item { margin-bottom: 8px; }
        .footer { text-align: center; margin-top: 30px; color: #888; }
          .logo { display: block; margin-left: auto; margin-right: auto; width: 150px;}
    </style>
</head>
<body>
    <div class="container">
         <img src="[LOGO_URL]" class="logo" alt="Logo Perusahaan"> <!-- Ganti [LOGO_URL] dengan URL logo Anda -->
        <h2>Pemberitahuan Pendaftaran Pelanggan Baru</h2>
        <p>Telah ada pelanggan baru yang mendaftar:</p>
        <div class="detail-container">
          <div class="detail-item"><strong>Username:</strong> {{ $username }}</div>
          <div class="detail-item"><strong>Email:</strong> {{ $email }}</div>
        </div>
    </div>
     <div class="footer">
        © {{ date('Y') }} [Nama Perusahaan Anda]. All rights reserved.
    </div>
</body>
</html>