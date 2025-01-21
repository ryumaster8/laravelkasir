@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Kirim Saran</h1>

        <form action="{{ route('saran.store') }}" method="POST">
            @csrf
            
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="mb-6">
                <label for="saran" class="block text-gray-700 text-sm font-bold mb-2">
                    Saran Anda
                </label>
                <textarea 
                    id="saran" 
                    name="saran" 
                    rows="4" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Masukkan saran Anda di sini..."
                    required
                >{{ old('saran') }}</textarea>
            </div>

            <div class="flex items-center justify-end">
                <button 
                    type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >
                    Kirim Saran
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
