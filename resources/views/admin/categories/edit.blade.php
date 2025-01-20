@extends('layouts.layout')

@section('title', 'Edit Category')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <h3 class="text-xl font-semibold text-white">Edit Category</h3>
            </div>

            <form action="{{ route('categories.update',$category->category_id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="p-6 space-y-6">
                    <!-- Outlet Field -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Outlet</label>
                        <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50" 
                               value="{{ $outletName ?? '' }}" readonly>
                        <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                    </div>

                    <!-- Operator Field -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Operator</label>
                        <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50"
                               value="{{ $username ?? '' }}" readonly>
                        <input type="hidden" name="user_id" value="{{ session('user_id') }}">
                    </div>

                    <!-- Category Name Field -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Category Name</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('category_name') border-red-500 @enderror"
                               name="category_name" 
                               value="{{ old('category_name', $category->category_name) }}"
                               placeholder="Enter category name">
                        @error('category_name')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t flex justify-end space-x-3">
                    <a href="{{ url()->previous() }}" 
                       class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection