{{-- filepath: /c:/xampp/htdocs/laravelkasir/resources/views/owner/dashboard.blade.php --}}
@extends('layouts_dashboard_owner.layout_owner')

@section('title', 'Dashboard Owner')

@section('content')
<div class="p-4">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Selamat Datang, {{ session('username') }}</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card Outlet -->
            <div class="bg-blue-100 p-4 rounded-lg">
                <h3 class="font-semibold text-blue-800">Total Outlet</h3>
                <p class="text-2xl text-blue-600">{{ session('outlet_count', 0) }}</p>
            </div>
            
            <!-- Card Transaksi -->
            <div class="bg-green-100 p-4 rounded-lg">
                <h3 class="font-semibold text-green-800">Total Transaksi</h3>
                <p class="text-2xl text-green-600">{{ session('transaction_count', 0) }}</p>
            </div>
            
            <!-- Card Produk -->
            <div class="bg-purple-100 p-4 rounded-lg">
                <h3 class="font-semibold text-purple-800">Total Produk</h3>
                <p class="text-2xl text-purple-600">{{ session('product_count', 0) }}</p>
            </div>
            
            <!-- Card Pendapatan -->
            <div class="bg-yellow-100 p-4 rounded-lg">
                <h3 class="font-semibold text-yellow-800">Total Pendapatan</h3>
                <p class="text-2xl text-yellow-600">Rp {{ number_format(session('total_revenue', 0), 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection