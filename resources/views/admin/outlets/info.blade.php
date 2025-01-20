@extends('layouts.layout')

@section('title', 'Informasi Outlet')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold text-gray-800">Informasi Outlet</h2>
                    <a href="{{ route('outlet.profile.edit') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Edit Profil
                    </a>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6 space-y-6">
                <!-- Logo dan Info Dasar -->
                <div class="flex items-start space-x-6">
                    <div class="flex-shrink-0">
                        @if($outlet->logo)
                            <img src="{{ asset('storage/' . $outlet->logo) }}" 
                                 alt="Logo {{ $outlet->outlet_name }}" 
                                 class="h-32 w-32 object-cover rounded-lg shadow">
                        @else
                            <div class="h-32 w-32 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $outlet->outlet_name }}</h3>
                        <div class="mt-2 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status Keanggotaan</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $outlet->subscription_status === 'active' ? 'bg-green-100 text-green-800' : 
                                           ($outlet->subscription_status === 'expiring_soon' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $outlet->getSubscriptionStatusTextAttribute() }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tipe Membership</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ optional($outlet->membership)->membership_name ?? 'Tidak ada' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Masa Berlaku</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($outlet->membership_expires_at)
                                        {{ $outlet->membership_expires_at->format('d M Y') }}
                                        <span class="text-xs text-gray-500">({{ $outlet->getDaysUntilExpiration() }} hari lagi)</span>
                                    @else
                                        Tidak ada
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Auto Renewal</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($outlet->auto_renewal)
                                        <span class="text-green-600">Aktif</span>
                                    @else
                                        <span class="text-red-600">Tidak Aktif</span>
                                    @endif
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Kontak -->
                <div class="border-t border-gray-200 pt-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Informasi Kontak</h4>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $outlet->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nomor Telepon</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $outlet->contact_info }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $outlet->address }}</dd>
                        </div>
                    </div>
                </div>

                <!-- Informasi Grup & Admin -->
                <div class="border-t border-gray-200 pt-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Informasi Tambahan</h4>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Grup Outlet</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ optional($outlet->outletGroup)->outlet_group_name ?? 'Tidak ada' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal Registrasi</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $outlet->created_at->format('d M Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status Outlet</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $outlet->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $outlet->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
