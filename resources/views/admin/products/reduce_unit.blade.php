@extends('layouts.layout')

@section('title', 'Kurangi Unit Produk')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-danger text-white">
           Kurangi Unit untuk Produk ID: {{ $product->product_id }} - {{ $product->product_name }}
        </div>
        <div class="card-body">
              <x-flash-message />
    
             <h5>Daftar Unit yang Bisa Dihapus (  <small>Sisa Stok Serial : {{ $availableSerials }}</small>)</h5>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Unit Barcode</th>
                        <th>Outlet</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product->serials()->where('status', 'available')->get() as $key => $serial)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $serial->serial_number }}</td>
                            <td>{{ $serial->outlet->outlet_name ?? '-' }}</td>
                            <td>
                                 <span class="badge {{ $serial->status == 'available' ? 'bg-success' : ($serial->status == 'sold' ? 'bg-danger' : 'bg-warning') }}">
                                   {{ $serial->status }}
                                </span>
                             </td>
                            <td>
                                <button class="btn btn-sm btn-danger" title="Delete Serial Number" onclick="confirmDelete({{ $serial->serial_id }}, '{{ $serial->serial_number }}')">
                                  <i class="fas fa-trash"></i>
                                </button>
                             </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
             <a href="{{ route('self-products') }}" class="btn btn-secondary">
                   <i class="fas fa-arrow-left"></i> Kembali
             </a>
        </div>
    </div>
</div>

<script>
     function confirmDelete(serialId, serialNumber) {
        if (confirm('Anda yakin ingin menghapus serial number : ' + serialNumber + '?')) {
              window.location.href = '/self-products/delete-serial/' + serialId;
            }
     }
</script>
@endsection