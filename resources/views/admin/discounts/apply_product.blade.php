@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h3 class="text-dark">Produk yang Mendapatkan Diskon Aktif</h3>
    <table id="applyProductTable" class="table table-bordered table-striped">
        <thead class="bg-primary text-white">
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kode Produk</th>
                <th>Harga Sebelum Diskon</th>
                <th>Diskon</th>
                <th>Harga Setelah Diskon</th>
                <th>Diskon Berlaku Sampai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productsWithDiscount as $index => $discount)
                @php
                    $product = $discount->product;
                    $discountedPrice = $product ? 
                        ($discount->type == 'percentage' 
                            ? $product->price * (1 - $discount->value / 100) 
                            : $product->price - $discount->value) 
                        : 0;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->product_name ?? '-' }}</td>
                    <td>{{ $product->product_code ?? '-' }}</td>
                    <td>Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</td>
                    <td>
                        @if ($discount->type === 'percentage')
                            {{ $discount->value }}%
                        @else
                            Rp {{ number_format($discount->value, 0, ',', '.') }}
                        @endif
                    </td>
                    <td>Rp {{ number_format($discountedPrice, 0, ',', '.') }}</td>
                    <td>{{ $discount->end_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#applyProductTable').DataTable();
    });
</script>

<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endsection
