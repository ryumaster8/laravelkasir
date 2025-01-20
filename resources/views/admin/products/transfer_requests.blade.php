@extends('layouts.layout')

@section('title', 'Permintaan Pemindahan Stok')

@section('content')
    <div class="container">
        <h3 class="text-dark">Permintaan Pemindahan Stok</h3>
         <x-flash-message />
        <div class="table-responsive">
            <table id="transitsTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                         <th>No</th>
                        <th>Produk</th>
                         <th>Nomer Serial</th>
                        <th>Dari Outlet</th>
                        <th>Status</th>
                         <th>Operator Pengirim</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transits as $key => $transit)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                             <td>{{ $transit->product->product_name }}</td>
                              <td>{{ $transit->serial->serial_number ?? '-' }}</td>
                             <td>{{ $transit->fromOutlet->outlet_name ?? '-' }}</td>
                           <td>
                               <span class="badge {{ $transit->status == 'pending' ? 'bg-warning' : ($transit->status == 'transit' ? 'bg-info' : ($transit->status == 'received' ? 'bg-success' : 'bg-danger')) }}">
                                    {{ $transit->status }}
                               </span>
                           </td>
                           <td>{{ $transit->operatorSender->username ?? '-' }}</td>
                            <td>
                                  <div class="btn-group" role="group">
                                      <a href="{{ route('products.approve-transfer', $transit->transit_id) }}" class="btn btn-success btn-sm">
                                           Terima
                                        </a>
                                       <a href="{{ route('products.reject-transfer', $transit->transit_id) }}" class="btn btn-danger btn-sm">
                                          Tolak
                                        </a>
                                  </div>
                             </td>
                        </tr>
                    @endforeach
                </tbody>
           </table>
        </div>
        <a href="{{ route('self-products') }}" class="btn btn-secondary">
           <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
      <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
      
      <script>
          $(document).ready( function () {
              $('#transitsTable').DataTable();
        } );
    </script>
@endsection