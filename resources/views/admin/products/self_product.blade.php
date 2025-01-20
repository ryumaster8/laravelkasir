@extends('layouts.layout')

@section('title', 'Daftar Produk Outlet')

@section('content')
<div class="container">
    <h1>Daftar Produk Outlet</h1>
      <x-flash-message />
    <table id="productsTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk ID</th>
                <th>Barcode</th>
                <th>Nama Produk</th>
                <th>Merk</th>
                <th>Kategori</th>
                <th>Supplier</th>
                <th>Nomer Serial</th>
                <th>Stok</th>
                <th>Harga Modal</th>
                <th>Harga Grosir</th>
                <th>Harga Ecer</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $key => $product)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $product->product_id }}</td>
                    <td>{{ $product->product_code }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->brand }}</td>
                    <td>{{ $product->category->category_name ?? '-' }}</td>
                    <td>{{ $product->supplier->supplier_name ?? '-' }}</td>
                    <td>
                        @if ($product->has_serial_number)
                            @foreach ($product->serials as $serial)
                                {{ $serial->serial_number }}{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($product->has_serial_number)
                            {{ $product->serials->where('status', 'available')->count() }}
                        @else
                            {{ $product->stock }}
                        @endif
                    </td>
                    <td>{{ number_format($product->price_modal, 2) }}</td>
                    <td>{{ number_format($product->price_grosir, 2) }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>
                        @if ($product->has_serial_number)
                            <div class="btn-group" role="group">
                                  <button class="btn btn-sm btn-primary" title="Edit Produk">
       <a href="{{ route('self-products.edit', $product->product_id) }}" class="text-white">
         <i class="fas fa-edit"></i>
         Edit
      </a>
    </button>
                                   <button class="btn btn-sm btn-success" title="Tambah Nomor Seri">
         <a href="{{ route('self-products.add-serial', $product->product_id) }}" class="text-white">
              <i class="fas fa-plus"></i>
                Tambah Seri
        </a>
   </button>
                                    <button class="btn btn-sm btn-warning" title="Kurangi Unit">
          <a href="{{ route('self-products.reduce-unit', $product->product_id) }}" class="text-white">
             <i class="fas fa-minus"></i>
              Kurangi Unit
          </a>
   </button>
                                    <button class="btn btn-sm btn-info" title="Pindah Unit">
        <a href="{{ route('self-products.transfer-unit', $product->product_id) }}" class="text-white">
          <i class="fas fa-exchange-alt"></i>
               Pindah Unit
         </a>
   </button>
                            </div>
                        @else
                            <div class="btn-group" role="group">
                                 <button class="btn btn-sm btn-primary" title="Edit Produk">
    <a href="{{ route('self-products.edit-non-serial', $product->product_id) }}" class="text-white">
        <i class="fas fa-edit"></i>
        Edit
    </a>
 </button>
                                      <button class="btn btn-sm btn-success" title="Tambah Stok">
            <a href="{{ route('self-products.add-stock', $product->product_id) }}" class="text-white">
                 <i class="fas fa-plus"></i>
                    Tambah Stok
             </a>
        </button>
                                    <button class="btn btn-sm btn-warning" title="Kurangi Stok">
          <a href="{{ route('self-products.reduce-stock', $product->product_id) }}" class="text-white">
              <i class="fas fa-minus"></i>
                Kurangi Stok
          </a>
       </button>
                                   <button class="btn btn-sm btn-info" title="Pindah Stok">
         <a href="{{ route('self-products.transfer-stock', $product->product_id) }}" class="text-white">
           <i class="fas fa-exchange-alt"></i>
              Pindah Stok
          </a>
   </button>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

 <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
 <script src="https://kit.fontawesome.com/e4bb0d77af.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#productsTable').DataTable();
    });
</script>
@endsection