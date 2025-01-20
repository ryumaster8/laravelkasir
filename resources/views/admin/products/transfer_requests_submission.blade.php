@extends('layouts.layout')

@section('title', 'Pengajuan Pemindahan Stok')

@section('content')
    <div class="container">
        <h3 class="text-dark">Pengajuan Pemindahan Stok</h3>
         <x-flash-message />
        <div class="table-responsive">
            <table id="transferRequestsTable" class="table table-bordered table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Product ID</th>
                    <th>Produk</th>
                    <th>Barcode</th>
                    <th>Operator Pengirim</th>
                    <th>Outlet Penerima</th>
                    <th>Operator Penerima</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
                </thead>
                <tbody>
                  @forelse($transits as $key => $transit)
                        <tr>
                          <td>{{ $key + 1 }}</td>
                            <td>{{ $transit->product_id }}</td>
                                <td>
                                {{ $transit->product->product_name }}
                                  <br>
                                <span class="badge bg-{{ $transit->has_serial_number ? 'info' : 'secondary' }}">
                                  {{ $transit->has_serial_number ? 'Serial' : 'Non-Serial' }}
                                </span>
                              </td>
                            <td>
                                  @if($transit->has_serial_number)
                                        {{ $transit->serial?->serial_number ?? '-' }}
                                   @else
                                     {{ $transit->product->product_code ?? '-' }}
                                   @endif
                             </td>
                             <td>{{ $transit->operatorSender->username }}</td>
                            <td>{{ $transit->toOutlet->outlet_name }}</td>
                              <td>{{ $transit->operatorReceiver->username ?? '-' }}</td>
                            <td>{{ $transit->quantity }}</td>
                             <td><span class="badge  {{ $transit->status == 'transit' ? 'bg-warning' : ($transit->status == 'rejected' ? 'bg-danger' : 'bg-success') }}">
                                  {{ $transit->status }}
                                </span>
                            </td>
                            <td>{{ $transit->created_at }}</td>
                         </tr>
                            @empty
                               <tr>
                                  <td colspan="10" class="text-center">Tidak ada data</td>
                               </tr>
                         @endforelse
                </tbody>
            </table>
        </div>
    </div>

   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
      <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
      
      <script>
           $(document).ready( function () {
             $('#transferRequestsTable').DataTable();
           } );
      </script>
@endsection