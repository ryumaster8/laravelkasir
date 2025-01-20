@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Informasi Session</h1>
            <div class="h-1 w-20 bg-blue-500"></div>
        </div>

        <!-- Form Pencarian dengan Live Search -->
        <div class="mb-6">
            <div class="flex gap-2">
                <div class="flex-1 relative">
                    <input 
                        type="text" 
                        id="sessionSearchInput"
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari session key..." 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    >
                    <!-- Tombol Clear Search -->
                    <button 
                        type="button" 
                        id="sessionClearSearch" 
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Session Items -->
        <div class="space-y-4" id="sessionItems">
            @if(count($sessions) > 0)
                @php $i = 1; @endphp
                @foreach ($sessions as $key => $value)
                    <div class="session-item bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition duration-150" data-key="{{ strtolower($key) }}">
                        <div class="flex items-start">
                            <!-- Nomor -->
                            <span class="flex-shrink-0 bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-3">
                                {{ $i }}
                            </span>
                            
                            <!-- Konten -->
                            <div class="flex-grow">
                                <strong class="text-gray-700 font-medium">{{ $key }}</strong>
                                <div class="mt-2">
                                    @if (is_array($value) || is_object($value))
                                        <pre class="bg-gray-800 text-green-400 rounded-md p-4 overflow-x-auto text-sm">
                                            {{ json_encode($value, JSON_PRETTY_PRINT) }}
                                        </pre>
                                    @else
                                        <span class="text-gray-600">{{ $value }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $i++; @endphp
                @endforeach
            @endif
        </div>

        <!-- Tambahkan Script di bagian bawah content -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('sessionSearchInput');
            const clearButton = document.getElementById('sessionClearSearch');
            const sessionItems = document.querySelectorAll('.session-item');

            // Fungsi untuk menampilkan/menyembunyikan tombol clear
            function toggleSessionClearButton() {
                if (searchInput.value) {
                    clearButton.classList.remove('hidden');
                } else {
                    clearButton.classList.add('hidden');
                }
            }

            // Cek status tombol clear saat halaman dimuat
            toggleSessionClearButton();

            // Event listener untuk input pencarian
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                toggleSessionClearButton();

                sessionItems.forEach(item => {
                    const key = item.getAttribute('data-key');
                    if (key.includes(searchTerm)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Tampilkan pesan jika tidak ada hasil
                const visibleItems = document.querySelectorAll('.session-item[style=""]').length;
                let noResultsMessage = document.getElementById('sessionNoResults');
                
                if (visibleItems === 0) {
                    if (!noResultsMessage) {
                        noResultsMessage = document.createElement('div');
                        noResultsMessage.id = 'sessionNoResults';
                        noResultsMessage.className = 'bg-yellow-50 border-l-4 border-yellow-400 p-4 mt-4';
                        noResultsMessage.innerHTML = `
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        Tidak ada data session yang ditemukan.
                                    </p>
                                </div>
                            </div>
                        `;
                        document.getElementById('sessionItems').appendChild(noResultsMessage);
                    }
                } else if (noResultsMessage) {
                    noResultsMessage.remove();
                }
            });

            // Event listener untuk tombol clear
            clearButton.addEventListener('click', function() {
                searchInput.value = '';
                searchInput.focus();
                toggleSessionClearButton();
                
                // Tampilkan kembali semua items
                sessionItems.forEach(item => {
                    item.style.display = '';
                });

                // Hapus pesan "tidak ada hasil" jika ada
                const noResultsMessage = document.getElementById('sessionNoResults');
                if (noResultsMessage) {
                    noResultsMessage.remove();
                }
            });
        });
        </script>
    </div>
</div>
@endsection