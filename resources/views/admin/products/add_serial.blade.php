@extends('layouts.layout')

@section('title', 'Tambah Nomor Seri')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="text-dark">Tambah Nomer Seri untuk Produk ID: {{ $product->product_id }} - {{ $product->product_name }}</h3>
            </div>
            <div class="card-body">
                <x-flash-message />
                <form action="{{ route('self-products.store-serial', $product->product_id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="product_id" class="form-label">Produk ID</label>
                        <input type="text" class="form-control" id="product_id" name="product_id"
                            value="{{ $product->product_id }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="operator" class="form-label">Operator</label>
                        <input type="text" class="form-control" id="operator" name="operator"
                            value="{{ $user->username }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="outlet" class="form-label">Outlet</label>
                        <input type="text" class="form-control" id="outlet" name="outlet"
                            value="{{ $user->outlet ? $user->outlet->outlet_name : '' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="serial_number" class="form-label">Nomor Seri</label>
                        <input type="text" class="form-control @error('serial_number') is-invalid @enderror"
                            id="serial_number" name="serial_number" value="{{ old('serial_number') }}"
                            placeholder="Masukkan Nomer Seri">
                        @error('serial_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Nomer Seri
                    </button>

                </form>

                <hr>
                <h4>Data Nomer Seri yang Sudah Ada</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomer Seri</th>
                            <th>Outlet</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->serials as $key => $serial)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $serial->serial_number }}</td>
                                <td>{{ $serial->outlet->outlet_name ?? '-' }}</td>
                                <td>
                                    <span
                                        class="badge {{ $serial->status == 'available' ? 'bg-success' : ($serial->status == 'sold' ? 'bg-danger' : 'bg-warning') }}">
                                        {{ $serial->status }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" title="Delete Serial Number"
                                        onclick="confirmDelete({{ $serial->serial_id }}, '{{ $serial->serial_number }}')">
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