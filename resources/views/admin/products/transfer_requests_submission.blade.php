@extends('layouts.layout')

@section('title', 'Pengajuan Pemindahan Stok')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Pengajuan Pemindahan Stok</h3>
    
    <x-flash-message />

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table id="transferRequestsTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barcode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator Pengirim</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Outlet Penerima</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator Penerima</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($transits as $key => $transit)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $key + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transit->product_id }}</td>
                             <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $transit->product->product_name }}
                                      <br>
                                    <span class="badge bg-{{ $transit->has_serial_number ? 'info' : 'secondary' }}">
                                      {{ $transit->has_serial_number ? 'Serial' : 'Non-Serial' }}
                                    </span>
                                 </td>
                                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                       @if($transit->has_serial_number)
                                            {{ $transit->serial?->serial_number ?? '-' }}
                                       @else
                                         {{ $transit->product->product_code ?? '-' }}
                                       @endif
                                 </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transit->operatorSender->username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transit->toOutlet->outlet_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transit->operatorReceiver->username ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transit->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $transit->status === 'transit' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($transit->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                       'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($transit->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $transit->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($transit->status === 'transit')
                                    <form action="{{ route('products.cancel-transfer', $transit->transit_id) }}" 
                                          method="POST" 
                                          onsubmit="return confirmCancel('{{ $transit->product->product_name }}', {{ $transit->quantity }}, '{{ $transit->toOutlet->outlet_name }}')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm">
                                            Batalkan
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function confirmCancel(productName, quantity, outletName) {
        return confirm(
            `Apakah Anda yakin ingin membatalkan pengajuan pemindahan stok ini?\n\n` +
            `Detail Pengajuan:\n` +
            `- Produk: ${productName}\n` +
            `- Jumlah: ${quantity}\n` +
            `- Tujuan: ${outletName}\n\n` +
            `Catatan: Stok akan dikembalikan ke outlet asal.`
        );
    }

    $(document).ready(function() {
        $('#transferRequestsTable').DataTable({
            responsive: true,
            pageLength: 10,
            ordering: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data yang ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data yang tersedia",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    });
</script>
@endpush
@endsection