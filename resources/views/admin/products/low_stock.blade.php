@extends('layouts.layout')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Pengingat Stok Menipis</h2>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok Tersedia</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batas Minimum</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($products as $product)
                    <tr>
                        <td class="px-6 py-4">{{ $product['product_name'] }}</td>
                        <td class="px-6 py-4">{{ $product['type'] === 'serial' ? 'Serial' : 'Non-Serial' }}</td>
                        <td class="px-6 py-4">{{ $product['available_stock'] }}</td>
                        <td class="px-6 py-4">{{ $product['min_stock'] }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $product['status'] === 'critical' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $product['status'] === 'low' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                {{ $product['status'] === 'critical' ? 'Kritis' : 'Menipis' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <button onclick="showMinStockModal({{ json_encode($product) }})" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                Update Min. Stok
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Update Min Stock -->
<div id="minStockModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-96">
        <h3 class="text-lg font-bold mb-4">Update Batas Minimum Stok</h3>
        <form id="updateMinStockForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Nama Produk: <span id="modalProductName"></span>
                </label>
                <input type="number" name="min_stock" id="minStockInput"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       required min="0">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeMinStockModal()"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Batal
                </button>
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function showMinStockModal(product) {
    document.getElementById('modalProductName').textContent = product.product_name;
    document.getElementById('minStockInput').value = product.min_stock;
    document.getElementById('updateMinStockForm').action = `/dashboard/products/${product.product_id}/update-min-stock`;
    document.getElementById('minStockModal').style.display = 'flex';
}

function closeMinStockModal() {
    document.getElementById('minStockModal').style.display = 'none';
}

// Close modal when clicking outside
document.getElementById('minStockModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeMinStockModal();
    }
});
</script>
@endpush
@endsection
