@extends('layouts.layout')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Upgrade / Downgrade Membership</h1>
        <button onclick="openGuideModal()" 
                class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Panduan
        </button>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Current Membership Info -->
    <div class="mb-8 bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Membership Saat Ini</h2>
            <div class="bg-blue-50 p-6 rounded-lg">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <span class="text-xl font-semibold text-blue-900">{{ $outlet->membership->membership_name }}</span>
                        <p class="text-blue-600 mt-1">
                            Rp {{ number_format($outlet->membership->biaya_bulanan, 0, ',', '.') }}/bulan
                        </p>
                    </div>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Active</span>
                </div>

                <!-- Basic Limits -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <p class="text-sm text-gray-600">Batas Cabang / Jumlah Saat Ini</p>
                        <p class="text-lg font-semibold">
                            {{ $outlet->membership->branch_limit }} / {{ $outlet->branch_count }}
                        </p>
                        @php
                            $branchPercent = ($outlet->membership->branch_limit > 0) 
                                ? ($outlet->branch_count / $outlet->membership->branch_limit) * 100 
                                : 0;
                        @endphp
                        <div class="mt-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-600 rounded-full" 
                                 style="width: {{ min($branchPercent, 100) }}%">
                            </div>
                        </div>
                        @if($branchPercent >= 80)
                            <p class="text-xs text-yellow-600 mt-1">
                                Mendekati batas maksimal
                            </p>
                        @endif
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <p class="text-sm text-gray-600">Batas User / Jumlah Saat Ini</p>
                        <p class="text-lg font-semibold">
                            {{ $outlet->membership->user_limit }} / 
                            {{ App\Models\ModelUser::getOutletGroupUserCount($outlet->outlet_group_id) }}
                        </p>
                        @php
                            $userPercent = ($outlet->membership->user_limit > 0) 
                                ? (App\Models\ModelUser::getOutletGroupUserCount($outlet->outlet_group_id) / $outlet->membership->user_limit) * 100 
                                : 0;
                        @endphp
                        <div class="mt-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-600 rounded-full" 
                                 style="width: {{ min($userPercent, 100) }}%">
                            </div>
                        </div>
                        @if($userPercent >= 80)
                            <p class="text-xs text-yellow-600 mt-1">
                                Mendekati batas maksimal
                            </p>
                        @endif
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <p class="text-sm text-gray-600">Transaksi/Hari</p>
                        <p class="text-lg font-semibold">
                            {{ $outlet->membership->daily_transaction_limit }} / 
                            {{ \App\Models\ModelTransaction::getTodayTransactionCount($outlet->outlet_group_id) }}
                        </p>
                        @php
                            $transactionPercent = ($outlet->membership->daily_transaction_limit > 0) 
                                ? (\App\Models\ModelTransaction::getTodayTransactionCount($outlet->outlet_group_id) / $outlet->membership->daily_transaction_limit) * 100 
                                : 0;
                        @endphp
                        <div class="mt-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-600 rounded-full" 
                                 style="width: {{ min($transactionPercent, 100) }}%">
                            </div>
                        </div>
                        @if($transactionPercent >= 80)
                            <p class="text-xs text-yellow-600 mt-1">
                                Mendekati batas maksimal
                            </p>
                        @endif
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <p class="text-sm text-gray-600">Produk/Hari</p>
                        <p class="text-lg font-semibold">
                            {{ $outlet->membership->daily_product_addition_limit }} / 
                            {{ \App\Models\ModelProduct::getTodayProductCount($outlet->outlet_group_id) }}
                        </p>
                        @php
                            $productPercent = ($outlet->membership->daily_product_addition_limit > 0) 
                                ? (\App\Models\ModelProduct::getTodayProductCount($outlet->outlet_group_id) / $outlet->membership->daily_product_addition_limit) * 100 
                                : 0;
                        @endphp
                        <div class="mt-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-600 rounded-full" 
                                 style="width: {{ min($productPercent, 100) }}%">
                            </div>
                        </div>
                        @if($productPercent >= 80)
                            <p class="text-xs text-yellow-600 mt-1">
                                Mendekati batas maksimal
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Main Features -->
                    <div>
                        <h3 class="font-medium text-blue-900 mb-3">Fitur Utama</h3>
                        <div class="space-y-2">
                            @foreach([
                                'service_feature' => 'Fitur Service',
                                'wholesale_feature' => 'Fitur Grosir',
                                'service_receipt_printing' => 'Cetak Struk Service',
                                'cashier_receipt_printing_feature' => 'Cetak Struk Kasir',
                                'discount_feature' => 'Fitur Diskon',
                                'product_image_feature' => 'Gambar Produk',
                                'low_stock_reminder_feature' => 'Pengingat Stok Menipis',
                                'stock_correction_feature' => 'Koreksi Stok'
                            ] as $key => $label)
                            <div class="flex items-center text-sm">
                                @if($outlet->membership->$key)
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                @else
                                <svg class="w-4 h-4 text-gray-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                @endif
                                <span class="{{ $outlet->membership->$key ? 'text-gray-900' : 'text-gray-400' }}">
                                    {{ $label }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Additional Features -->
                    <div>
                        <h3 class="font-medium text-blue-900 mb-3">Fitur Tambahan</h3>
                        <div class="space-y-2">
                            @foreach([
                                'chat_feature' => 'Live Chat Support',
                                'sales_report_feature' => 'Laporan Penjualan',
                                'transaction_report_feature' => 'Laporan Transaksi',
                                'shortcut_feature' => 'Fitur Shortcut',
                                'custom_shortcut_feature' => 'Shortcut Kustom',
                                'log_activity_feature' => 'Log Aktivitas',
                                'customer_contact_feature' => 'Kontak Pelanggan'
                            ] as $key => $label)
                            <div class="flex items-center text-sm">
                                @if($outlet->membership->$key)
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                @else
                                <svg class="w-4 h-4 text-gray-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                @endif
                                <span class="{{ $outlet->membership->$key ? 'text-gray-900' : 'text-gray-400' }}">
                                    {{ $label }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($pendingRequest)
        <!-- Pending Request Alert -->
        <div class="mb-8 bg-yellow-50 border border-yellow-200 rounded-lg p-6">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h3 class="text-lg font-medium text-yellow-900">Permintaan Perubahan Membership Dalam Proses</h3>
                    <p class="text-yellow-700">
                        Anda telah mengajukan {{ $pendingRequest->change_type === 'upgrade' ? 'upgrade' : 'downgrade' }} 
                        ke paket {{ $pendingRequest->requestedMembership->membership_name }}.
                    </p>
                    <div class="mt-2 space-y-1">
                        <p class="text-sm text-yellow-600">
                            Status Perubahan: 
                            <span class="font-semibold">
                                @switch($pendingRequest->change_status)
                                    @case('waiting_payment')
                                        Menunggu Pembayaran
                                        @break
                                    @case('payment_uploaded')
                                        Bukti Pembayaran Diunggah
                                        @break
                                    @case('payment_verified')
                                        Pembayaran Terverifikasi
                                        @break
                                    @case('processing')
                                        Sedang Diproses
                                        @break
                                    @case('completed')
                                        Selesai
                                        @break
                                    @default
                                        {{ ucfirst($pendingRequest->change_status) }}
                                @endswitch
                            </span>
                        </p>
                        <p class="text-sm text-yellow-600">
                            Status Pembayaran: 
                            <span class="font-semibold">
                                @switch($pendingRequest->payment_status)
                                    @case('unpaid')
                                        Belum Dibayar
                                        @break
                                    @case('paid')
                                        Menunggu Verifikasi
                                        @break
                                    @case('verified')
                                        Terverifikasi
                                        @break
                                @endswitch
                            </span>
                        </p>
                        <p class="text-sm text-yellow-600">
                            Biaya: Rp {{ number_format($pendingRequest->change_fee, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Membership Options -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Pilihan Membership</h2>
            
            <!-- Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button
                        onclick="switchTab('upgrade')"
                        id="upgrade-tab"
                        class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Upgrade Membership
                    </button>
                    <button
                        onclick="switchTab('downgrade')"
                        id="downgrade-tab"
                        class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Downgrade Membership
                    </button>
                </nav>
            </div>

            <!-- Upgrade Options -->
            <div id="upgrade-content" class="tab-content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($upgradeMemberships as $membership)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ $membership->membership_name }}</h3>
                            <div class="space-y-3 mb-6">
                                <!-- Basic Features -->
                                <div class="flex items-center text-sm">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>{{ $membership->branch_limit }} Cabang</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>{{ $membership->user_limit }} User</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>{{ $membership->daily_transaction_limit }} Transaksi/hari</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>{{ $membership->daily_product_addition_limit }} Produk/hari</span>
                                </div>

                                <!-- Divider -->
                                <div class="border-t border-gray-200 my-4"></div>

                                <!-- Main Features -->
                                <div class="space-y-2">
                                    <h4 class="font-medium text-sm text-gray-700 mb-2">Fitur Utama:</h4>
                                    @foreach([
                                        'service_feature' => 'Fitur Service',
                                        'wholesale_feature' => 'Fitur Grosir',
                                        'service_receipt_printing' => 'Cetak Struk Service',
                                        'cashier_receipt_printing_feature' => 'Cetak Struk Kasir',
                                        'discount_feature' => 'Fitur Diskon',
                                        'product_image_feature' => 'Gambar Produk',
                                        'low_stock_reminder_feature' => 'Pengingat Stok Menipis',
                                        'stock_correction_feature' => 'Koreksi Stok',
                                    ] as $key => $label)
                                    <div class="flex items-center text-sm">
                                        @if($membership->$key)
                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        @else
                                        <svg class="w-4 h-4 text-gray-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        @endif
                                        <span class="{{ $membership->$key ? 'text-gray-900' : 'text-gray-400' }}">{{ $label }}</span>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Divider -->
                                <div class="border-t border-gray-200 my-4"></div>

                                <!-- Additional Features -->
                                <div class="space-y-2">
                                    <h4 class="font-medium text-sm text-gray-700 mb-2">Fitur Tambahan:</h4>
                                    @foreach([
                                        'chat_feature' => 'Live Chat Support',
                                        'sales_report_feature' => 'Laporan Penjualan',
                                        'transaction_report_feature' => 'Laporan Transaksi',
                                        'shortcut_feature' => 'Fitur Shortcut',
                                        'custom_shortcut_feature' => 'Shortcut Kustom',
                                        'log_activity_feature' => 'Log Aktivitas',
                                        'customer_contact_feature' => 'Kontak Pelanggan'
                                    ] as $key => $label)
                                    <div class="flex items-center text-sm">
                                        @if($membership->$key)
                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        @else
                                        <svg class="w-4 h-4 text-gray-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        @endif
                                        <span class="{{ $membership->$key ? 'text-gray-900' : 'text-gray-400' }}">{{ $label }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Upgrade Pricing Section -->
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex flex-col gap-1 mb-4">
                                    <div>
                                        <span class="text-3xl font-bold text-gray-900">
                                            Rp {{ number_format($membership->biaya_bulanan, 0, ',', '.') }}
                                        </span>
                                        <span class="text-gray-500">/bulan</span>
                                    </div>
                                    <div class="text-sm">
                                        <span class="text-gray-500">Biaya Upgrade:</span>
                                        <span class="font-semibold text-indigo-600"> 
                                            Rp {{ number_format($membership->biaya_upgrade, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <form action="{{ route('outlet.request-upgrade') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="membership_id" value="{{ $membership->membership_id }}">
                                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition duration-150">
                                        Upgrade Sekarang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Downgrade Options -->
            <div id="downgrade-content" class="tab-content hidden">
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Perhatian! Downgrade membership akan mengurangi fitur yang tersedia. Pastikan Anda telah mempertimbangkan hal ini dengan baik.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($downgradeMemberships as $membership)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ $membership->membership_name }}</h3>
                            <div class="space-y-3 mb-6">
                                <!-- Basic Features -->
                                <div class="flex items-center text-sm">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>{{ $membership->branch_limit }} Cabang</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>{{ $membership->user_limit }} User</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>{{ $membership->daily_transaction_limit }} Transaksi/hari</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>{{ $membership->daily_product_addition_limit }} Produk/hari</span>
                                </div>

                                <!-- Divider -->
                                <div class="border-t border-gray-200 my-4"></div>

                                <!-- Main Features -->
                                <div class="space-y-2">
                                    <h4 class="font-medium text-sm text-gray-700 mb-2">Fitur Utama:</h4>
                                    @foreach([
                                        'service_feature' => 'Fitur Service',
                                        'wholesale_feature' => 'Fitur Grosir',
                                        'service_receipt_printing' => 'Cetak Struk Service',
                                        'cashier_receipt_printing_feature' => 'Cetak Struk Kasir',
                                        'discount_feature' => 'Fitur Diskon',
                                        'product_image_feature' => 'Gambar Produk',
                                        'low_stock_reminder_feature' => 'Pengingat Stok Menipis',
                                        'stock_correction_feature' => 'Koreksi Stok',
                                    ] as $key => $label)
                                    <div class="flex items-center text-sm">
                                        @if($membership->$key)
                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        @else
                                        <svg class="w-4 h-4 text-gray-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        @endif
                                        <span class="{{ $membership->$key ? 'text-gray-900' : 'text-gray-400' }}">{{ $label }}</span>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Divider -->
                                <div class="border-t border-gray-200 my-4"></div>

                                <!-- Additional Features -->
                                <div class="space-y-2">
                                    <h4 class="font-medium text-sm text-gray-700 mb-2">Fitur Tambahan:</h4>
                                    @foreach([
                                        'chat_feature' => 'Live Chat Support',
                                        'sales_report_feature' => 'Laporan Penjualan',
                                        'transaction_report_feature' => 'Laporan Transaksi',
                                        'shortcut_feature' => 'Fitur Shortcut',
                                        'custom_shortcut_feature' => 'Shortcut Kustom',
                                        'log_activity_feature' => 'Log Aktivitas',
                                        'customer_contact_feature' => 'Kontak Pelanggan'
                                    ] as $key => $label)
                                    <div class="flex items-center text-sm">
                                        @if($membership->$key)
                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        @else
                                        <svg class="w-4 h-4 text-gray-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        @endif
                                        <span class="{{ $membership->$key ? 'text-gray-900' : 'text-gray-400' }}">{{ $label }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Downgrade Pricing Section -->
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex flex-col gap-1 mb-4">
                                    <div>
                                        <span class="text-3xl font-bold text-gray-900">
                                            Rp {{ number_format($membership->biaya_bulanan, 0, ',', '.') }}
                                        </span>
                                        <span class="text-gray-500">/bulan</span>
                                    </div>
                                    <div class="text-sm">
                                        <span class="text-gray-500">Biaya Downgrade:</span>
                                        <span class="font-semibold text-red-600"> 
                                            Rp {{ number_format($membership->biaya_downgrade, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>

                                <button 
                                    onclick="confirmDowngrade({{ $membership->membership_id }}, {{ $membership->biaya_downgrade }}, '{{ $membership->membership_name }}')"
                                    class="w-full bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-150">
                                    Downgrade ke Paket Ini
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Downgrade Confirmation Modal -->
        <div id="downgradeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Downgrade</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500">
                            Apakah Anda yakin ingin menurunkan paket membership ke <span id="packageName" class="font-semibold"></span>? 
                        </p>
                        <p class="text-sm text-gray-500 mt-2">
                            Biaya downgrade akan dikenakan sebesar <span id="downgradeFee" class="font-semibold text-red-600"></span>
                        </p>
                        <p class="text-sm text-gray-500 mt-2">
                            Beberapa fitur mungkin tidak akan tersedia setelah downgrade.
                        </p>
                    </div>
                    <div class="flex justify-center gap-4 mt-4">
                        <form id="downgradeForm" action="{{ route('outlet.request-downgrade') }}" method="POST">
                            @csrf
                            <input type="hidden" name="membership_id" id="downgrade_membership_id">
                            <button type="button" 
                                onclick="closeDowngradeModal()"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                                Batal
                            </button>
                            <button type="submit" 
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 ml-2">
                                Ya, Downgrade
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Guide Modal -->
        <div id="guideModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
            <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-lg rounded-md bg-white max-h-[90vh] overflow-y-auto">
                <div class="mt-3">
                    <div class="flex justify-between items-center border-b pb-3">
                        <h3 class="text-2xl font-bold text-gray-900">Panduan Perubahan Membership</h3>
                        <button onclick="closeGuideModal()" class="text-gray-400 hover:text-gray-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="mt-4 space-y-6">
                        <!-- Proses Upgrade -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-lg">
                            <h4 class="text-xl font-semibold text-blue-900 mb-4">Proses Upgrade Membership</h4>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                        <span class="w-6 h-6 text-blue-600 font-semibold flex items-center justify-center">1</span>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg font-medium text-gray-900">Pilih Paket</h5>
                                        <p class="text-gray-600">Pilih paket membership yang lebih tinggi dari paket Anda saat ini. Bandingkan fitur dan manfaat yang ditawarkan.</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                        <span class="w-6 h-6 text-blue-600 font-semibold flex items-center justify-center">2</span>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg font-medium text-gray-900">Ajukan Permintaan</h5>
                                        <p class="text-gray-600">Klik tombol "Upgrade Sekarang" pada paket yang Anda inginkan. Sistem akan memproses permintaan Anda.</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                        <span class="w-6 h-6 text-blue-600 font-semibold flex items-center justify-center">3</span>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg font-medium text-gray-900">Pembayaran</h5>
                                        <p class="text-gray-600">Lakukan pembayaran sesuai dengan biaya upgrade yang tertera. Upload bukti transfer pada halaman konfirmasi pembayaran.</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                        <span class="w-6 h-6 text-blue-600 font-semibold flex items-center justify-center">4</span>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg font-medium text-gray-900">Verifikasi</h5>
                                        <p class="text-gray-600">Tim kami akan memverifikasi pembayaran Anda. Setelah terverifikasi, paket akan diaktifkan secara otomatis.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Proses Downgrade -->
                        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-6 rounded-lg">
                            <h4 class="text-xl font-semibold text-yellow-900 mb-4">Proses Downgrade Membership</h4>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-yellow-100 rounded-full p-2">
                                        <span class="w-6 h-6 text-yellow-600 font-semibold flex items-center justify-center">1</span>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg font-medium text-gray-900">Pertimbangkan Baik-baik</h5>
                                        <p class="text-gray-600">Pastikan Anda telah mempertimbangkan dampak pengurangan fitur yang akan terjadi setelah downgrade.</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-yellow-100 rounded-full p-2">
                                        <span class="w-6 h-6 text-yellow-600 font-semibold flex items-center justify-center">2</span>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg font-medium text-gray-900">Ajukan Downgrade</h5>
                                        <p class="text-gray-600">Pilih paket yang lebih rendah dan klik "Downgrade ke Paket Ini". Konfirmasi keputusan Anda.</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-yellow-100 rounded-full p-2">
                                        <span class="w-6 h-6 text-yellow-600 font-semibold flex items-center justify-center">3</span>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg font-medium text-gray-900">Biaya Administrasi</h5>
                                        <p class="text-gray-600">Bayar biaya administrasi downgrade jika ada. Upload bukti pembayaran untuk diproses.</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-yellow-100 rounded-full p-2">
                                        <span class="w-6 h-6 text-yellow-600 font-semibold flex items-center justify-center">4</span>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg font-medium text-gray-900">Proses Perubahan</h5>
                                        <p class="text-gray-600">Setelah disetujui, perubahan akan diproses. Pastikan Anda telah mencadangkan data penting.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Tambahan -->
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 rounded-lg">
                            <h4 class="text-xl font-semibold text-gray-900 mb-4">Informasi Penting</h4>
                            <ul class="space-y-3 text-gray-600">
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Perubahan membership akan efektif setelah pembayaran terverifikasi.</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Pastikan memahami perbedaan fitur antar paket sebelum melakukan perubahan.</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Hubungi support kami jika membutuhkan bantuan dalam proses perubahan membership.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function switchTab(tab) {
                // Hide all tab contents
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });
                
                // Remove active state from all tabs
                document.querySelectorAll('.tab-button').forEach(button => {
                    button.classList.remove('border-indigo-500', 'text-indigo-600');
                    button.classList.add('border-transparent', 'text-gray-500');
                });
                
                // Show selected tab content and activate tab
                document.getElementById(`${tab}-content`).classList.remove('hidden');
                document.getElementById(`${tab}-tab`).classList.remove('border-transparent', 'text-gray-500');
                document.getElementById(`${tab}-tab`).classList.add('border-indigo-500', 'text-indigo-600');
            }

            function confirmDowngrade(membershipId, downgradeFee, packageName) {
                document.getElementById('downgrade_membership_id').value = membershipId;
                document.getElementById('downgradeFee').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(downgradeFee);
                document.getElementById('packageName').textContent = packageName;
                document.getElementById('downgradeModal').classList.remove('hidden');
            }

            function closeDowngradeModal() {
                document.getElementById('downgradeModal').classList.add('hidden');
            }

            function openGuideModal() {
                document.getElementById('guideModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeGuideModal() {
                document.getElementById('guideModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        </script>
    @endif
</div>
@endsection
