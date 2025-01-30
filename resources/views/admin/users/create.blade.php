@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-2xl font-bold text-gray-800">Tambah Pengguna</h3>
        </div>

        <!-- Flash Message & Info -->
        <div class="px-6 py-4">
            <x-flash-message />
            @if(Auth::user()->role && (Auth::user()->role->role_name === 'superadmin' || Auth::user()->role->role_name === 'admin'))
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center text-blue-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm">
                            Jumlah pengguna saat ini: {{ $totalUsers ?? 0 }} | 
                            Jenis membership saat ini: {{ session('membership_name') ?? 'Tidak ada' }} |
                            Batas jumlah pengguna: {{ $userLimit ?? 0 }}
                        </span>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('user.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Username -->
                <div class="form-group">
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                    <div class="relative">
                        <input type="text" name="username" id="username" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white text-gray-800 placeholder-gray-400"
                            placeholder="Masukkan username">
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <input type="email" name="email" id="email" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white text-gray-800 placeholder-gray-400"
                            placeholder="contoh@email.com">
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white text-gray-800"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Password Confirmation -->
                <div class="form-group">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white text-gray-800"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="form-group">
                    <label for="phone_number" class="block text-sm font-semibold text-gray-700 mb-1">Nomor Telepon</label>
                    <div class="relative">
                        <input type="text" name="phone_number" id="phone_number" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white text-gray-800 placeholder-gray-400"
                            placeholder="08123456789">
                    </div>
                </div>

                <!-- Role -->
                <div class="form-group">
                    <label for="role_id" class="block text-sm font-semibold text-gray-700 mb-1">Role</label>
                    <select name="role_id" id="role_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white text-gray-800">
                        @foreach($roles as $role)
                            @if($role->role_name == 'admin' || $role->role_name == 'user')
                                <option value="{{ $role->role_id }}">{{ ucfirst($role->role_name) }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Outlet -->
                <div class="form-group">
                    <label for="outlet_id" class="block text-sm font-semibold text-gray-700 mb-1">Outlet</label>
                    <select name="outlet_id" id="outlet_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white text-gray-800">
                        @if(Auth::user()->outlet)
                            @foreach(Auth::user()->outlet->getSameGroupOutlets() as $outlet)
                                <option value="{{ $outlet->outlet_id }}">{{ $outlet->outlet_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <!-- Footer -->
                <div class="mt-8 border-t border-gray-200 pt-5">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('user.index') }}" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Batal
                        </a>
                        <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection