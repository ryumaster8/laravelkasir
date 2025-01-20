@extends('layouts.layout')

@section('title', 'Riwayat Permintaan Pemindahan Stok')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="text-dark">Riwayat Permintaan Pemindahan Stok</h3>
        </div>
        <div class="card-body">
            <x-flash-message />
            <table id="transitsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                         <th>Nomer Serial</th>
                        <th>Dari Outlet</th>
                        <th>Ke Outlet</th>
                         <th>Status</th>
                          <th>Operator Pengirim</th>
                          <th>Waktu Pengiriman</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($transits as $key => $transit)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $transit->product->product_name }}</td>
                            <td>{{ $transit->serial->serial_number ?? '-' }}</td>
                            <td>{{ $transit->fromOutlet->outlet_name ?? '-' }}</td>
                            <td>{{ $transit->toOutlet->outlet_name ?? '-' }}</td>
                            <td>
                                <span class="badge {{ $transit->status == 'pending' ? 'bg-warning' : ($transit->status == 'transit' ? 'bg-info' : ($transit->status == 'received' ? 'bg-success' : 'bg-danger')) }}">
                                    {{ $transit->status }}
                                </span>
                            </td>
                             <td>{{ $transit->operatorSender->username ?? '-' }}</td>
                            <td>{{ $transit->created_at }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
             <a href="{{ route('self-products') }}" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Kembali
           </a>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#transitsTable').DataTable();
        } );
    </script>
@endsection