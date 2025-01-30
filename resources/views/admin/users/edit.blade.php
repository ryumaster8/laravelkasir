@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-2xl font-bold text-gray-800">Edit Pengguna</h3>
        </div>

        <!-- Form Content -->
        <form action="{{ route('user.update', $user->user_id) }}" method="POST" class="p-6">
            @csrf
            @method('POST')
            
            <x-flash-message />

            <div class="space-y-6">
                <!-- Username -->
                <div class="form-group">
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                    <div class="relative">
                        <input type="text" name="username" id="username" 
                            value="{{ old('username', $user->username) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white text-gray-800"
                            required>
                        @error('username')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <input type="email" name="email" id="email" 
                            value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white text-gray-800"
                            required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">
                        Password <span class="text-gray-500 text-xs">(Biarkan kosong jika tidak ingin mengganti)</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="password" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white text-gray-800">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password Confirmation -->
                <div class="form-group">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white text-gray-800">
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="form-group">
                    <label for="phone_number" class="block text-sm font-semibold text-gray-700 mb-1">Nomor Telepon</label>
                    <div class="relative">
                        <input type="text" name="phone_number" id="phone_number" 
                            value="{{ old('phone_number', $user->phone_number) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white text-gray-800"
                            placeholder="Contoh: 08123456789">
                        @error('phone_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Role -->
                <div class="form-group">
                    <label for="role_id" class="block text-sm font-semibold text-gray-700 mb-1">Role</label>
                    <select name="role_id" id="role_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white text-gray-800">
                        @foreach($roles as $role)
                            @if($role->role_name == 'admin' || $role->role_name == 'user')
                                <option value="{{ $role->role_id }}" {{ old('role_id', $user->role_id) == $role->role_id ? 'selected' : '' }}>
                                    {{ ucfirst($role->role_name) }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Outlet -->
                <div class="form-group">
                    <label for="outlet_id" class="block text-sm font-semibold text-gray-700 mb-1">Outlet</label>
                    <select name="outlet_id" id="outlet_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white text-gray-800">
                        @foreach($outlets as $outlet)
                            <option value="{{ $outlet->outlet_id }}" 
                                {{ old('outlet_id', $user->outlet_id) == $outlet->outlet_id ? 'selected' : '' }}
                                {{ $outlet->outlet_id === $user->outlet_id ? 'selected' : '' }}>
                                {{ $outlet->outlet_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('outlet_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="mt-8 border-t border-gray-200 pt-5">
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('user.index') }}" 
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                    <button type="submit" 
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        Update Pengguna
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection