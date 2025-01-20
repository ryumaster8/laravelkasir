<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
     <style>
        body { font-family: 'Roboto', sans-serif; margin: 0; padding: 0; background-color: #f8f9fa; color: #343a40; line-height: 1.6; }
        .container { width: 80%; max-width: 800px; margin: 30px auto; background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h1 { text-align: center; margin-bottom: 30px; color: #28a745; }
         p { text-align: center; margin-bottom: 30px; color: #343a40; }
       .btn-primary { display: block; margin: 20px auto; width: fit-content; padding: 12px 24px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; border: none;}
       .btn-primary:hover { background-color: #218838; }
       .footer { text-align: center; margin-top: 30px; color: #868e96; font-size: 0.8em; }
     </style>
</head>
<body>
    <div class="container">
        <h1>Konfirmasi Pembayaran Berhasil</h1>
        <p>Terima kasih telah melakukan konfirmasi pembayaran. Kami akan segera memproses aktivasi membership Anda.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Kembali</a>
        <div class="footer">
            © {{ date('Y') }} [Nama Perusahaan Anda]. All rights reserved.
         </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>