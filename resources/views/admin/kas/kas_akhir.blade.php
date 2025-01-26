@extends('layouts.layout')

@section('title', 'Input Kas Akhir')

@push('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@endpush

@section('content')
<div class="flex justify-center mt-8">
  <div class="w-11/12">
    <!-- Form Tutup Kasir -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
      <div class="bg-red-600 px-6 py-4">
        <h3 class="text-xl font-semibold text-white">Kas Akhir</h3>
      </div>
      <div class="p-8">
        <!-- Flashdata -->
        <x-flashdata />
        @if(session('success') && str_contains(session('success'), 'selisih kas'))
        <div class="mt-4 bg-yellow-100 border-l-4 border-yellow-500 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        {{ session('success') }}
                        <a href="{{ route('kas.adjustments') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">
                            Klik disini untuk ke halaman penyesuaian
                        </a>
                    </p>
                </div>
            </div>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" 
             style="
                background-color: {{ session('selisih', 0) == 0 ? '#d4edda' : '#fff3cd' }};
                border-left: 5px solid {{ session('selisih', 0) == 0 ? '#28a745' : '#ffc107' }};
                color: {{ session('selisih', 0) == 0 ? '#155724' : '#856404' }};
                padding: 15px 20px;
                margin-bottom: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                animation: slideInRight 0.5s ease-out;
             ">
            <div style="display: flex; align-items: center;">
                <i class="fas {{ session('selisih', 0) == 0 ? 'fa-check-circle' : 'fa-exclamation-triangle' }}" 
                   style="font-size: 24px; margin-right: 10px;"></i>
                <div>
                    <strong>{{ session('selisih', 0) == 0 ? 'Berhasil!' : 'Perhatian!' }}</strong>
                    <br>
                    {{ session('success') }}
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <style>
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        </style>
        @endif

        <form action="{{ route('store.kas_akhir') }}" method="POST">
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
              <label for="nominal" class="block text-sm font-medium text-gray-700 mb-2">Nominal Kas Akhir</label>
              <input type="number" 
                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out
                @error('nominal') border-red-500 ring-red-100 @enderror" 
                id="nominal" 
                name="nominal" 
                placeholder="Masukkan nominal kas akhir" 
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
              class="w-full sm:w-auto px-6 py-2.5 bg-red-600 text-white text-sm font-semibold rounded-lg
                hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2
                transition duration-200 ease-in-out transform hover:-translate-y-0.5">
              Simpan
            </button>
          </div>
        </form>

        <!-- Tambahkan setelah form input kas akhir -->
        @if(isset($akurasi) && $akurasi['selisih'] != 0)
        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">
                        Perhatian: Terdapat Selisih Kas
                    </h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <p>Selisih: Rp {{ number_format($akurasi['selisih'], 0) }}</p>
                        <p>Status: {{ $akurasi['status'] }}</p>
                        <a href="{{ route('kas.adjustments') }}" 
                           class="inline-block mt-2 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                            Isi Form Penyesuaian
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Table section with DataTables -->
        <div class="mt-8">
            <table id="kasAkhirTable" class="w-full table-auto border-collapse bg-white shadow-sm rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nominal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Operator</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Keterangan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($kasAkhirRecords as $index => $kas)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kas->waktu }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <span class="font-medium">Rp {{ number_format($kas->nominal, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kas->creator->username }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kas->keterangan ?: '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                            <div class="flex space-x-2">
                                <a href="{{ route('edit.kas_akhir', $kas->kas_akhir_id) }}" 
                                    class="inline-flex items-center px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                
                                <form action="{{ route('delete.kas_akhir', $kas->kas_akhir_id) }}" 
                                      method="POST" 
                                      class="inline-block" 
                                      onsubmit="return confirmDelete('{{ $kas->date->format('d/m/Y') }}', '{{ number_format($kas->nominal, 2) }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
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

@push('scripts')
<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#kasAkhirTable').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
        },
        columnDefs: [
            {
                targets: -1,
                orderable: false,
                searchable: false
            }
        ],
        order: [[1, 'desc']], // Sort by waktu column descending
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]]
    });
});

function confirmDelete(date, amount) {
    return confirm(`Anda akan menghapus data kas akhir:\nTanggal: ${date}\nNominal: ${amount}\n\nApakah Anda yakin?`);
}
</script>
@endpush

@endsection
