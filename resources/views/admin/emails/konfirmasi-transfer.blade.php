<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran Membership</title>
    <style>
        body { font-family: 'Roboto', sans-serif; margin: 0; padding: 0; background-color: #f8f9fa; color: #343a40; line-height: 1.6; }
        .container { width: 80%; max-width: 600px; margin: 30px auto; background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #28a745; margin-bottom: 10px; }
        .header p { color: #6c757d; }
        .info-box { background-color: #f0f0f0; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .info-box h3 { color: #495057; margin-bottom: 10px; }
        .info-box p { color: #6c757d; }
        .transfer-info { border: 1px solid #ced4da; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .transfer-info h3 { color: #495057; margin-bottom: 10px; }
        .transfer-info p { color: #6c757d; margin-bottom: 10px; }
        .footer { text-align: center; margin-top: 30px; color: #868e96; font-size: 0.8em; }
        .button { display: inline-block; padding: 12px 24px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; margin-top: 20px; }
        .button:hover { background-color: #218838; }
         .logo { display: block; margin-left: auto; margin-right: auto; width: 150px;}
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
         <img src="[LOGO_URL]" class="logo" alt="Logo Perusahaan">
        <div class="header">
            <h1>Konfirmasi Pembayaran Membership</h1>
            <p>Terima kasih telah memilih membership kami. Kami sangat menghargai kepercayaan Anda.</p>
        </div>
        <div class="info-box">
            <h3>Detail Membership Anda</h3>
            <p>Anda telah memilih membership: <strong>{{ $membership_name }}</strong></p>
            <p>Dengan total biaya pendaftaran sebesar: <strong>Rp. {{ number_format($biaya_pendaftaran, 0, ',', '.') }}</strong></p>
        </div>

        <div class="transfer-info">
            <h3>Informasi Transfer</h3>
            <p>Silakan lakukan transfer ke rekening berikut untuk mengaktifkan membership Anda:</p>
            <p><strong>Nomor Rekening:</strong> {{ $account_number }}</p>
            <p><strong>Nama Pemilik Rekening:</strong> {{ $account_name }}</p>
            <p><strong>Nama Bank:</strong> {{ $bank_name }}</p>
        </div>
         <p>Setelah melakukan transfer, mohon konfirmasi pembayaran melalui tombol di bawah ini. Kami akan segera memproses aktivasi membership Anda.</p>
          <a href="{{ $link_konfirmasi }}" class="button">Konfirmasi Pembayaran</a>
         <p>Dengan membership ini, Anda akan menikmati berbagai keuntungan dan layanan yang sesuai dengan kebutuhan Anda. Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.</p>
        <div class="footer">
            © {{ date('Y') }} [Nama Perusahaan Anda]. All rights reserved.
        </div>
    </div>
</body>
</html>