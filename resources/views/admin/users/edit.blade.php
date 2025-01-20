@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <!-- Card Header -->
            <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600">
                <h3 class="text-xl font-semibold text-white">Edit Pengguna</h3>
            </div>

            <form action="{{ route('user.update', $user->user_id) }}" method="POST">
                @csrf
                @method('POST')
                
                <x-flash-message />

                <!-- Card Body -->
                <div class="p-6 space-y-6">
                    <!-- Username -->
                    <div class="space-y-1">
                        <label for="username" class="text-sm font-medium text-gray-700">Username</label>
                        <input type="text" name="username" id="username" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('username') border-red-500 @enderror"
                            value="{{ old('username', $user->username) }}" required>
                        @error('username')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-1">
                        <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('email') border-red-500 @enderror"
                            value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-1">
                        <label for="password" class="text-sm font-medium text-gray-700">Password (Biarkan kosong jika tidak ingin mengganti)</label>
                        <input type="password" name="password" id="password" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="space-y-1">
                        <label for="password_confirmation" class="text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>

                    <!-- Phone Number -->
                    <div class="space-y-1">
                        <label for="phone_number" class="text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" name="phone_number" id="phone_number" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('phone_number') border-red-500 @enderror"
                            value="{{ old('phone_number', $user->phone_number) }}">
                        @error('phone_number')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="space-y-1">
                        <label for="role_id" class="text-sm font-medium text-gray-700">Role</label>
                        <select name="role_id" id="role_id" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('role_id') border-red-500 @enderror">
                            @foreach($roles as $role)
                                @if($role->role_name == 'admin' || $role->role_name == 'user')
                                    <option value="{{$role->role_id}}" {{ old('role_id', $user->role_id) == $role->role_id ? 'selected' : '' }}>
                                        {{ ucfirst($role->role_name) }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('role_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Outlet -->
                    <div class="space-y-1">
                        <label for="outlet_id" class="text-sm font-medium text-gray-700">Outlet</label>
                        <select name="outlet_id" id="outlet_id" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('outlet_id') border-red-500 @enderror">
                            @foreach($outlets as $outlet)
                                <option value="{{$outlet->outlet_id}}" {{ old('outlet_id', $user->outlet_id) == $outlet->outlet_id ? 'selected' : '' }}>
                                    {{$outlet->outlet_name}}
                                </option>
                            @endforeach
                        </select>
                        @error('outlet_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="px-6 py-4 bg-gray-50 flex justify-start space-x-3">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Update Pengguna
                    </button>
                    <a href="{{ route('user.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection