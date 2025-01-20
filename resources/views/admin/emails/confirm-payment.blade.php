<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
     <style>
         body { font-family: 'Roboto', sans-serif; margin: 0; padding: 0; background-color: #f8f9fa; color: #343a40; line-height: 1.6; }
         .container { width: 80%; max-width: 800px; margin: 30px auto; background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
         h1 { text-align: center; margin-bottom: 30px; color: #28a745; }
         .form-group { margin-bottom: 20px; }
        .form-group label { font-weight: bold; color: #495057; margin-bottom: 5px; }
        .form-group input[type="text"], .form-group input[type="file"],.form-group select { width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 5px; }
         .form-group input[type="text"]:focus, .form-group input[type="file"]:focus ,.form-group select:focus { border-color: #28a745; outline: none; box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25); }
         .btn-primary { padding: 12px 24px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; border: none;}
          .btn-primary:hover { background-color: #218838; }
          .footer { text-align: center; margin-top: 30px; color: #868e96; font-size: 0.8em; }
     </style>
</head>
<body>
    <div class="container">
        <h1>Konfirmasi Pembayaran</h1>
        <p>Terima kasih telah melakukan pendaftaran membership. Silakan lengkapi form di bawah ini untuk melakukan konfirmasi pembayaran.</p>
        <form action="{{ route('process.confirm.payment', ['user_id' => $user_id]) }}" method="post" enctype="multipart/form-data">
             @csrf
             <div class="form-group">
               <label for="bank_name">Pilih Bank:</label>
              <select class="form-control" id="bank_name" name="bank_name" required>
                <option value="" disabled selected>Pilih Bank</option>
                  <option value="BCA">BCA</option>
                  <option value="BRI">BRI</option>
                  <option value="Mandiri">Mandiri</option>
                 <option value="BNI">BNI</option>
                  <option value="Lainnya">Lainnya</option>
               </select>
             </div>
             <div class="form-group">
                 <label for="method_transfer">Metode Transfer:</label>
                <select class="form-control" id="method_transfer" name="method_transfer" required>
                    <option value="" disabled selected>Pilih Metode Transfer</option>
                     <option value="m-banking">M-Banking</option>
                     <option value="atm">ATM</option>
                      <option value="lainnya">Lainnya</option>
                 </select>
             </div>
            <div class="form-group">
                <label for="account_name">Nama Pemilik Rekening:</label>
                <input type="text" class="form-control" id="account_name" name="account_name" required>
            </div>
             <div class="form-group">
                <label for="account_number">Nomor Rekening:</label>
                <input type="text" class="form-control" id="account_number" name="account_number" required>
            </div>
            <div class="form-group">
                <label for="bukti_transfer">Upload Bukti Transfer:</label>
                <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" accept="image/*" required>
            </div>
           <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
        </form>
        <div class="footer">
            © {{ date('Y') }} [Nama Perusahaan Anda]. All rights reserved.
        </div>
    </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>