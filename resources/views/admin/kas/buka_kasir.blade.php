@extends('layouts.layout')

@section('content')
<div class="flex justify-center mt-8">
  <div class="w-11/12">
    <!-- Form Buka Kasir -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
      <div class="bg-blue-600 px-6 py-4">
        <h3 class="text-xl font-semibold text-white">Buka Kasir</h3>
      </div>
      <div class="p-6">
        <!-- Flashdata -->
        <x-flashdata />

        <form action="{{ route('store.kas_awal') }}" method="POST">
          @csrf
          <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
          <input type="hidden" name="user_id" value="{{ session('user_id') }}">

          <div class="space-y-4">
            <div>
              <label for="outlet_name" class="block text-sm font-medium text-gray-700">Outlet</label>
              <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                id="outlet_name" name="outlet_name" value="{{ $outletName }}" readonly>
            </div>

            <div>
              <label for="operator_name" class="block text-sm font-medium text-gray-700">Operator</label>
              <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                id="operator_name" name="operator_name" value="{{ $operatorName }}" readonly>
            </div>

            <div>
              <label for="opening_balance" class="block text-sm font-medium text-gray-700">Saldo Awal</label>
              <input type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 
                @error('opening_balance') border-red-500 @enderror" 
                id="opening_balance" name="opening_balance" placeholder="Masukkan saldo awal" 
                value="{{ old('opening_balance') }}" required>
              @error('opening_balance')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="mt-6">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Data Cash Register -->
    <div class="mt-8 bg-white rounded-lg shadow-md overflow-hidden">
      <div class="bg-blue-600 px-6 py-4">
        <h3 class="text-xl font-semibold text-white">Data Cash Register</h3>
      </div>
      <div class="p-6">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo Awal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo Akhir</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($cashRegisters as $index => $register)
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $register->date }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($register->opening_balance, 2) }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($register->closing_balance, 2) }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($register->status) }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                  <a href="{{ route('edit.cash_register', $register->cash_register_id) }}" 
                    class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-sm font-medium rounded-md hover:bg-yellow-600">
                    Edit
                  </a>
                  <form action="{{ route('delete.cash_register', $register->cash_register_id) }}" method="POST" 
                    class="inline-block" onsubmit="return confirmDelete('{{ $register->date }}', '{{ $register->opening_balance }}')">
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
