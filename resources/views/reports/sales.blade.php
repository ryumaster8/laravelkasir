{{-- resources/views/reports/sales.blade.php --}}

@extends('layouts.layout')

@section('title', 'Laporan Penjualan')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Laporan Penjualan Harian</h1>

        <div class="mb-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h5 class="text-lg font-semibold text-gray-700 mb-4">Ringkasan Penjualan</h5>
                <div class="flex flex-wrap -mx-2">
                    <div class="w-full sm:w-1/2 md:w-1/4 px-2 mb-4 md:mb-0">
                        <p class="text-gray-600">
                            <strong>Total Transaksi:</strong> {{ $summary['total_transactions'] }}
                        </p>
                    </div>
                    <div class="w-full sm:w-1/2 md:w-1/4 px-2 mb-4 md:mb-0">
                        <p class="text-gray-600">
                            <strong>Total Penjualan:</strong> Rp {{ number_format($summary['total_sales'], 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="w-full sm:w-1/2 md:w-1/4 px-2 mb-4 md:mb-0">
                        <p class="text-gray-600">
                            <strong>Penjualan Eceran:</strong> Rp {{ number_format($summary['retail_sales'], 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="w-full sm:w-1/2 md:w-1/4 px-2">
                        <p class="text-gray-600">
                            <strong>Penjualan Grosir:</strong> Rp {{ number_format($summary['wholesale_sales'], 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @if($dailySummaries->isEmpty())
            <p class="text-center text-gray-600">Tidak ada data penjualan.</p>
        @else
            <div class="overflow-x-auto">
                <table id="salesTable" class="min-w-full bg-white shadow rounded-lg border border-gray-200 display">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Tanggal</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Total Transaksi</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Total Penjualan</th>
                             <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dailySummaries as $date => $dailySummary)
                            <tr class="border-b border-gray-200">
                                <td class="px-4 py-3 text-center text-gray-700">{{ $dailySummary['date'] }}</td>
                                <td class="px-4 py-3 text-center text-gray-700">{{ count($dailySummary['transactions']) }}</td>
                                <td class="px-4 py-3 text-center text-gray-700">Rp {{ number_format($dailySummary['total_amount'], 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('transactions.daily.show', ['date' => $dailySummary['date']]) }}" 
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline text-sm">
                                        <i class="fas fa-eye mr-1"></i>Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Sales Chart Section -->
        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Grafik Penjualan 30 Hari Terakhir</h3>
            <div class="w-full h-[400px]">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Monthly Statistics Section -->
        <div class="mt-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Statistik Bulan {{ \Carbon\Carbon::now()->format('F Y') }}</h3>
                <div class="text-sm text-gray-500 mb-4">
                    Periode: {{ $monthlyStats['period']['start'] }} - {{ $monthlyStats['period']['end'] }}
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Highest Sale -->
                    <div class="bg-blue-50 rounded-lg p-4">
                        <h4 class="font-medium text-blue-700 mb-2">Penjualan Tertinggi</h4>
                        @if($monthlyStats['highest_sale'])
                            <p class="text-2xl font-bold text-blue-800">
                                {{ number_format($monthlyStats['highest_sale']['total'], 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-blue-600">{{ $monthlyStats['highest_sale']['date'] }}</p>
                        @else
                            <p class="text-gray-500">Tidak ada data</p>
                        @endif
                    </div>

                    <!-- Top Operator -->
                    <div class="bg-green-50 rounded-lg p-4">
                        <h4 class="font-medium text-green-700 mb-2">Operator Terbaik</h4>
                        @if($monthlyStats['top_operator'])
                            <p class="text-2xl font-bold text-green-800">
                                {{ $monthlyStats['top_operator']['operator'] }}
                            </p>
                            <p class="text-sm text-green-600">
                                {{ $monthlyStats['top_operator']['count'] }} transaksi
                                (Rp {{ number_format($monthlyStats['top_operator']['total'], 0, ',', '.') }})
                            </p>
                        @else
                            <p class="text-gray-500">Tidak ada data</p>
                        @endif
                    </div>

                    <!-- Best Selling Product -->
                    <div class="bg-purple-50 rounded-lg p-4">
                        <h4 class="font-medium text-purple-700 mb-2">Produk Terlaris</h4>
                        @if($monthlyStats['best_product'])
                            <p class="text-2xl font-bold text-purple-800">
                                {{ $monthlyStats['best_product']['name'] }}
                            </p>
                            <p class="text-sm text-purple-600">
                                Terjual {{ $monthlyStats['best_product']['quantity'] }} unit
                            </p>
                        @else
                            <p class="text-gray-500">Tidak ada data</p>
                        @endif
                    </div>

                    <!-- Busiest Hour -->
                    <div class="bg-orange-50 rounded-lg p-4">
                        <h4 class="font-medium text-orange-700 mb-2">Jam Tersibuk</h4>
                        @if($monthlyStats['busiest_hour'])
                            <p class="text-2xl font-bold text-orange-800">
                                {{ $monthlyStats['busiest_hour']['hour'] }}
                            </p>
                            <p class="text-sm text-orange-600">
                                {{ $monthlyStats['busiest_hour']['count'] }} transaksi
                            </p>
                        @else
                            <p class="text-gray-500">Tidak ada data</p>
                        @endif
                    </div>

                    <!-- Daily Average -->
                    <div class="bg-red-50 rounded-lg p-4">
                        <h4 class="font-medium text-red-700 mb-2">Rata-rata Harian</h4>
                        <p class="text-2xl font-bold text-red-800">
                            Rp {{ number_format($monthlyStats['daily_average'], 0, ',', '.') }}
                        </p>
                        <p class="text-sm text-red-600">per hari</p>
                    </div>

                    <!-- Payment Method Distribution -->
                    <div class="bg-indigo-50 rounded-lg p-4">
                        <h4 class="font-medium text-indigo-700 mb-2">Metode Pembayaran Terpopuler</h4>
                        @if($monthlyStats['payment_methods'])
                            <p class="text-2xl font-bold text-indigo-800">
                                {{ $monthlyStats['payment_methods']['method'] }}
                            </p>
                            <p class="text-sm text-indigo-600">
                                {{ number_format($monthlyStats['payment_methods']['percentage'], 1) }}% transaksi
                            </p>
                        @else
                            <p class="text-gray-500">Tidak ada data</p>
                        @endif
                    </div>

                    <!-- Customer Type Distribution -->
                    <div class="bg-yellow-50 rounded-lg p-4">
                        <h4 class="font-medium text-yellow-700 mb-2">Distribusi Tipe Pelanggan</h4>
                        @if($monthlyStats['customer_types'])
                            <div class="space-y-2">
                                <p class="flex justify-between">
                                    <span class="text-yellow-800">Eceran:</span>
                                    <span class="font-bold">{{ number_format($monthlyStats['customer_types']['retail_percentage'], 1) }}%</span>
                                </p>
                                <p class="flex justify-between">
                                    <span class="text-yellow-800">Grosir:</span>
                                    <span class="font-bold">{{ number_format($monthlyStats['customer_types']['wholesale_percentage'], 1) }}%</span>
                                </p>
                            </div>
                        @else
                            <p class="text-gray-500">Tidak ada data</p>
                        @endif
                    </div>

                    <!-- Peak Days -->
                    <div class="bg-teal-50 rounded-lg p-4">
                        <h4 class="font-medium text-teal-700 mb-2">Hari Tersibuk</h4>
                        @if($monthlyStats['peak_days'])
                            <p class="text-2xl font-bold text-teal-800">
                                {{ $monthlyStats['peak_days']['day'] }}
                            </p>
                            <p class="text-sm text-teal-600">
                                Rata-rata {{ number_format($monthlyStats['peak_days']['avg_transactions']) }} transaksi
                            </p>
                        @else
                            <p class="text-gray-500">Tidak ada data</p>
                        @endif
                    </div>

                    <!-- Growth Rate -->
                    <div class="bg-pink-50 rounded-lg p-4">
                        <h4 class="font-medium text-pink-700 mb-2">Pertumbuhan dari Bulan Lalu</h4>
                        @if(isset($monthlyStats['growth_rate']))
                            <p class="text-2xl font-bold {{ $monthlyStats['growth_rate'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $monthlyStats['growth_rate'] >= 0 ? '+' : '' }}{{ number_format($monthlyStats['growth_rate'], 1) }}%
                            </p>
                            <p class="text-sm {{ $monthlyStats['growth_rate'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $monthlyStats['growth_rate'] >= 0 ? 'Kenaikan' : 'Penurunan' }} dari bulan sebelumnya
                            </p>
                        @else
                            <p class="text-gray-500">Tidak ada data perbandingan</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleTransactions(date) {
            const element = document.getElementById('transactions-' + date);
            element.classList.toggle('hidden');
        }

        $(document).ready(function() {
            // Initialize DataTables for the main sales table
            let salesTable = $('#salesTable').DataTable({
                responsive: true,
                pageLength: 10,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
                },
                order: [[0, 'desc']], // Sort by date descending
                columnDefs: [
                    {
                        targets: -1, // Last column (Detail column)
                        orderable: false,
                        searchable: false
                    }
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            // Handle detail button clicks
            $('#salesTable').on('click', 'button[data-toggle="collapse"]', function() {
                let targetId = $(this).data('target');
                $(targetId).toggleClass('show');
            });
        });
    </script>

    <!-- Add Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Existing DataTables initialization
        // ...existing datatable code...

        // Initialize Sales Chart
        const chartData = @json($chartData);
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [
                    {
                        label: 'Total Penjualan (Rp)',
                        data: chartData.sales,
                        backgroundColor: 'rgba(59, 130, 246, 0.5)',
                        borderColor: 'rgb(59, 130, 246)',
                        borderWidth: 1,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Jumlah Transaksi',
                        data: chartData.counts,
                        type: 'line',
                        borderColor: 'rgb(220, 38, 38)',
                        backgroundColor: 'rgba(220, 38, 38, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Total Penjualan (Rp)'
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Jumlah Transaksi'
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                let value = context.parsed.y;
                                if (label.includes('Total Penjualan')) {
                                    return label + ': Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                }
                                return label + ': ' + value;
                            }
                        }
                    }
                }
            }
        });
    });
    </script>
@endpush