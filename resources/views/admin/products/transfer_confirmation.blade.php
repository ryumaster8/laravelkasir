@extends('layouts.layout')

@section('title', 'Konfirmasi Pemindahan Unit')

@section('content')
  <div class="container">
    <div class="card">
          <div class="card-header">
                Konfirmasi Pemindahan Unit
        </div>
          <div class="card-body">
                <x-flash-message />
                 <p>
                    Produk ID : {{ $product->product_id }} - {{ $product->product_name }} Berhasil Dipindahkan Oleh {{ $user->username }}
                  </p>

                 <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomer Serial</th>
                            <th>Dari Outlet</th>
                             <th>Ke Outlet</th>
                            <th>Status</th>
                            <th>Bukti Transfer</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($transits as $key => $transit)
                             <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $transit->serial->serial_number }}</td>
                                 <td>{{ $transit->fromOutlet->outlet_name }}</td>
                                <td>{{ $transit->toOutlet->outlet_name }}</td>
                                <td>
                                    <span class="badge {{ $transit->status == 'pending' ? 'bg-warning' : ($transit->status == 'transit' ? 'bg-info' : ($transit->status == 'received' ? 'bg-success' : 'bg-danger')) }}">
                                    {{ $transit->status }}
                                    </span>
                              </td>
                              <td>
                                    @if($transit->payment_proof)  <!-- Changed from transfer_evidence to payment_proof -->
                                        <img src="{{ asset('storage/bukti_transfer/' . $transit->payment_proof) }}" 
                                             alt="Bukti Transfer" 
                                             class="img-thumbnail" 
                                             style="max-width: 100px;">
                                    @else
                                        <span class="text-muted">Tidak ada bukti</span>
                                    @endif
                                </td>
                            </tr>
                         @endforeach
                   </tbody>
               </table>

               <a href="{{ route('self-products') }}" class="btn btn-secondary">Kembali</a>
           </div>
   </div>
</div>
@endsection