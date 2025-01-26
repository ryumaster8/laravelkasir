@extends('layouts.layout')

@section('title', 'Input Kas Awal')

@section('content')
<div class="flex justify-center mt-8">
  <div class="w-11/12">
    <!-- Form Buka Kasir -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
      <div class="bg-blue-600 px-6 py-4">
        <h3 class="text-xl font-semibold text-white">Kas Awal</h3>
      </div>
      <div class="p-8">
        <!-- Flashdata -->
        <x-flashdata />

        <form action="{{ route('store.kas_awal') }}" method="POST">
          @csrf
          <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
          <input type="hidden" name="created_by" value="{{ session('user_id') }}">

          <div class="space-y-6">
            <div>
              <label for="outlet_name" class="block text-sm font-medium text-gray-700 mb-2">Outlet</label>
              <input type="text" 
                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out" 
                id="outlet_name" 
                name="outlet_name" 
                value="{{ $outletName }}" 
                readonly>
            </div>

            <div>
              <label for="operator_name" class="block text-sm font-medium text-gray-700 mb-2">Operator</label>
              <input type="text" 
                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out" 
                id="operator_name" 
                name="operator_name" 
                value="{{ $operatorName }}" 
                readonly>
            </div>

            <div>
              <label for="nominal" class="block text-sm font-medium text-gray-700 mb-2">Nominal Kas Awal</label>
              <input type="number" 
                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out
                @error('nominal') border-red-500 ring-red-100 @enderror" 
                id="nominal" 
                name="nominal" 
                placeholder="Masukkan nominal kas awal" 
                value="{{ old('nominal') }}" 
                required>
              @error('nominal')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
              <textarea 
                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out"
                id="keterangan"
                name="keterangan"
                rows="3"
                placeholder="Masukkan keterangan (opsional)">{{ old('keterangan') }}</textarea>
            </div>
          </div>

          <div class="mt-8">
            <button type="submit" 
              class="w-full sm:w-auto px-6 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg
                hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                transition duration-200 ease-in-out transform hover:-translate-y-0.5">
              Simpan
            </button>
          </div>
        </form>

        <!-- Table section -->
        <div class="mt-8">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nominal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Operator</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($kasAwalRecords as $index => $kas)
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $kas->waktu }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">Rp {{ number_format($kas->nominal, 2) }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $kas->creator->username }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $kas->keterangan ?: '-' }}</td>
                <td class="px-6 py-4 text-sm space-x-2">
                  <a href="{{ route('edit.kas_awal', $kas->kas_awal_id) }}" 
                    class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-sm font-medium rounded-md hover:bg-yellow-600">
                    Edit
                  </a>
                  <form action="{{ route('delete.kas_awal', $kas->kas_awal_id) }}" method="POST" 
                    class="inline-block" onsubmit="return confirmDelete('{{ $kas->date->format('d/m/Y') }}', '{{ number_format($kas->nominal, 2) }}')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                      class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600">
                      Delete
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function confirmDelete(date, openingBalance) {
    return confirm(`Anda akan menghapus data cash register:\nTanggal: ${date}\nSaldo Awal: ${openingBalance}\n\nApakah Anda yakin?`);
  }
</script>
@endsection
