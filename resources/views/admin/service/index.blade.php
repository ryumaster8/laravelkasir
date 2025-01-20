@extends('layouts.layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <x-flash-message />
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Daftar Servis</h3>

        <a href="{{ route('services.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg mb-6">
            <span>Tambah Service</span>
        </a>

        <div class="overflow-x-auto shadow-md rounded-lg">
            <table id="serviceTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Faktur</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Outlet</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Teknisi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Perangkat</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Serial/IMEI</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi Masalah</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Servis</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Perangkat</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya Servis</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uang Muka</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Masuk</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Ambil</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator Pembatalan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pembatalan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator Pengambilan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if($services->isEmpty())
                        <tr>
                            <td colspan="21" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data servis.</td>
                        </tr>
                    @else
                        @foreach ($services as $key => $item)
                            <tr class="{{ in_array($item->progress_status, ['Selesai', 'Dibatalkan']) ? 'text-red-600' : 'text-gray-900' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $key + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->service_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->faktur }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->operator->username ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->outlet->outlet_name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->teknisi->nama_teknisi ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->customer_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->device_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->serial_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->progress_status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->status_servis }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->tipe_perangkat }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->biaya ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->uang_muka ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->tanggal_masuk }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->tanggal_ambil ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->operator_batal ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->tanggal_batal ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->operatorPengambilan->username ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('services.edit', $item->service_id) }}" 
                                           class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md disabled:opacity-50 disabled:cursor-not-allowed
                                           {{ in_array($item->progress_status, ['Selesai', 'Dibatalkan']) ? 'opacity-50 cursor-not-allowed' : '' }}">
                                           Edit
                                        </a>

                                        <form action="{{ route('services.destroy', $item->service_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md disabled:opacity-50 disabled:cursor-not-allowed
                                                    {{ in_array($item->progress_status, ['Selesai', 'Dibatalkan']) ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                Hapus
                                            </button>
                                        </form>

                                        <form action="{{ route('services.cancel.view', $item->service_id) }}" method="GET">
                                            @csrf
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md disabled:opacity-50 disabled:cursor-not-allowed
                                                    {{ in_array($item->progress_status, ['Selesai', 'Dibatalkan']) ? 'opacity-50 cursor-not-allowed' : '' }}">
                                                Batalkan
                                            </button>
                                        </form>

                                        <a href="{{ route('service.pengambilan', $item->service_id) }}" 
                                           class="inline-flex items-center px-3 py-1 bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-medium rounded-md disabled:opacity-50 disabled:cursor-not-allowed
                                           {{ in_array($item->progress_status, ['Selesai', 'Dibatalkan']) ? 'opacity-50 cursor-not-allowed' : '' }}">
                                           Pengambilan
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#serviceTable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                pageLength: 10,
            });
        });
    </script>
@endsection
