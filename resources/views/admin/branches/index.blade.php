@extends('layouts.layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <x-flash-message />
        
        <div class="mb-6">
            @if(Auth::user()->outlet->status === 'induk')
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Daftar Cabang</h2>
                <div class="flex flex-wrap gap-4 mb-4 text-sm text-gray-600">
                    <p>Jumlah Cabang Saat Ini: <span class="font-semibold">{{ $currentBranchCount ?? 0 }}</span></p>
                    @if(isset($branchLimit))
                        <p>Batas Maksimal Cabang: <span class="font-semibold">{{ $branchLimit }}</span></p>
                    @endif
                </div>
                <a href="{{ route('branches.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200">
                    Tambah Cabang
                </a>
            @else
                <h2 class="text-2xl font-bold text-gray-800">Daftar Cabang</h2>
            @endif
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table id="branchesTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Cabang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($outlets as $key => $outlet)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $key + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $outlet->outlet_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $outlet->outlet_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $outlet->address }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $outlet->contact_info }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('branches.edit', $outlet->outlet_id) }}"
                                       class="px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition duration-200">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <button onclick="confirmDelete({{ $outlet->outlet_id }},'{{$outlet->outlet_name}}' )"
                                            class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>

                                <form id="delete-form-{{ $outlet->outlet_id }}"
                                      action="{{ route('branches.destroy', $outlet->outlet_id) }}"
                                      method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3mJeWygKik8xZ0qOGevIE=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script>
        $(document).ready(function() {
            $('#branchesTable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                pageLength: 10,
            });
        });

        function confirmDelete(outletId, outletName) {
            if (confirm('Apakah Anda yakin ingin menghapus cabang "' + outletName + '" dengan ID ' + outletId + '?')) {
                document.getElementById('delete-form-' + outletId).submit();
            }
        }
    </script>
@endpush