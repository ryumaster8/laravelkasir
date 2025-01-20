@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h3 class="text-dark">Produk yang Mendapatkan Diskon Berdasarkan Kategori</h3>

    @foreach ($categoriesWithDiscount as $discount)
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <h5>Kategori: {{ $discount->category->category_name ?? '-' }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="bg-secondary text-white">
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
                        @php $products = $discount->category->products ?? []; @endphp
                        @forelse ($products as $index => $product)
                            @php
                                $discountedPrice = ($discount->type == 'percentage')
                                    ? $product->price * (1 - $discount->value / 100)
                                    : $product->price - $discount->value;
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_code }}</td>
                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
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
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada produk dalam kategori ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>

<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endsection
