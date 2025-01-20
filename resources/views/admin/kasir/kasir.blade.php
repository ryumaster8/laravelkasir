<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <style>
        /* CSS Kustom */
        body {
           font-family: sans-serif;
        }
        header {
            background-color: #f8f9fa;
            padding: 15px 0;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 20px;
        }
        .card {
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
            border: 1px solid #dee2e6;
            margin-bottom: 15px;
            border-radius: 8px;
        }
        .card-header {
          background-color: #e9ecef;
          font-weight: bold;
            border-bottom: 1px solid #dee2e6;
            padding: 10px 15px;
            border-top-left-radius: 8px;
             border-top-right-radius: 8px;
        }

        .card-body {
            padding: 15px;
        }

         .text-end h1 {
            font-size: 5em;
            margin-bottom: 0;
            font-weight: bold;
        }

        .modal-content {
          border-radius: 8px;
          box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
          border: 1px solid #dee2e6;
        }

        .modal-header {
           background-color: #e9ecef;
            font-weight: bold;
             border-bottom: 1px solid #dee2e6;
              border-top-left-radius: 8px;
             border-top-right-radius: 8px;
        }

         @media (max-width: 768px) {
          .text-end h1 {
              font-size: 3em;
          }
         }
        @media (max-width: 576px) {
          .text-end h1 {
              font-size: 2em;
          }
         }

    </style>
</head>
<body>
    <div class="container">
      <header class="py-3 d-flex justify-content-between align-items-center">
          <h1 style="margin-bottom:0px;">[LOGO TOKO]</h1>
          <p style="margin-bottom:0px;">
               Tanggal: 2023-10-26 | Waktu: 10:30:00 |
               No. Transaksi: 123456 | Kasir: [Nama Kasir]
            </p>
        </header>

        <div class="row">
             <div class="col-md-8">
                 <div class="card mb-3">
                     <div class="card-body">
                         <div class="d-flex justify-content-end">
                               <div class="text-end">
                                   <h1 style="margin-bottom:0px;">Subtotal: <span id="subtotal">50.000</span></h1>
                              </div>
                         </div>
                     </div>
               </div>

                <div class="card">
                     <div class="card-header">Daftar Item</div>
                    <div class="card-body">
                        <table class="table">
                          <thead>
                            <tr>
                                <th>Nama Item</th>
                               <th>Jumlah</th>
                                <th>Harga/Item</th>
                              <th>Total</th>
                            </tr>
                           </thead>
                            <tbody>
                              <tr>
                                   <td>Produk A</td>
                                   <td>2</td>
                                   <td>10.000</td>
                                    <td>20.000</td>
                               </tr>
                               <tr>
                                   <td>Produk B</td>
                                  <td>1</td>
                                   <td>15.000</td>
                                   <td>15.000</td>
                                </tr>
                                <tr>
                                    <td>Produk C</td>
                                    <td>3</td>
                                     <td>5.000</td>
                                      <td>15.000</td>
                                </tr>
                           </tbody>
                      </table>
                    </div>
                </div>
            </div>
           <div class="col-md-4">
                <div class="card">
                      <div class="card-header">Pembayaran</div>
                      <div class="card-body">
                         <div class="mb-3">
                              <label class="form-label">Scan Barcode:</label>
                              <input type="text" class="form-control" id="barcode_input">
                          </div>
                           <div class="d-grid gap-2">
                                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCariProduk">Cari Produk</button>
                           </div>
                            <div class="mt-3">
                                 <label class="form-label">Jumlah Tunai Diterima:</label>
                                 <input type="number" class="form-control" id="jumlah_tunai">
                                 <p>Kembalian: <span id="kembalian">0</span></p>
                            </div>
                            <div class="d-grid gap-2 mt-3">
                                 <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalPembayaran">Proses Pembayaran</button>
                             </div>
                       </div>
                 </div>
            </div>
        </div>
    </div>
   <!-- Modal Cari Produk -->
    <div class="modal fade" id="modalCariProduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                 <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Cari Produk</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <table id="tableProduk" class="display">
                          <thead>
                                <tr>
                                      <th>Nama Item</th>
                                      <th>Harga</th>
                                      <th>Aksi</th>
                                  </tr>
                             </thead>
                            <tbody>
                                 <tr>
                                       <td>Produk A</td>
                                       <td>10.000</td>
                                       <td><button class="btn btn-sm btn-success">Tambah</button></td>
                                   </tr>
                                   <tr>
                                        <td>Produk B</td>
                                       <td>15.000</td>
                                        <td><button class="btn btn-sm btn-success">Tambah</button></td>
                                    </tr>
                                   <tr>
                                        <td>Produk C</td>
                                        <td>5.000</td>
                                        <td><button class="btn btn-sm btn-success">Tambah</button></td>
                                  </tr>
                             </tbody>
                        </table>
                   </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                   </div>
           </div>
         </div>
    </div>
    <!-- Modal Pembayaran -->
   <div class="modal fade" id="modalPembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Total yang harus dibayar: <span id="total_bayar">55.000</span></p>
                    <label class="form-label">Uang yang diterima:</label>
                    <input type="number" class="form-control" id="uang_diterima">
                   <p>Uang kembalian: <span id="uang_kembalian">0</span></p>
                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran:</label>
                        <select class="form-select" aria-label="Default select example">
                           <option selected>Tunai</option>
                             <option value="1">Kartu</option>
                           <option value="2">Digital</option>
                        </select>
                     </div>
                 </div>
               <div class="modal-footer">
                     <button type="button" class="btn btn-primary">Simpan dan Cetak Struk</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
               </div>
           </div>
        </div>
   </div>
   <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
     <script>
        $(document).ready( function () {
              $('#tableProduk').DataTable();
        } );
    </script>
</body>
</html>