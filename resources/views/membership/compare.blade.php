@extends('layouts_dashboard_owner.layout_owner')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
            <h4 class="text-xl font-semibold text-white">Perbandingan Paket Membership</h4>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($memberships as $membership)
                <div class="border rounded-lg p-4 {{ $membership->rank == 'premium' ? 'border-yellow-500 bg-yellow-50' : '' }}">
                    <h3 class="text-xl font-bold mb-4">{{ $membership->membership_name }}</h3>
                    <div class="space-y-2">
                        <p>✓ Max Cabang: {{ $membership->branch_limit }}</p>
                        <p>✓ Max User: {{ $membership->user_limit }}</p>
                        <p>✓ Max Transaksi/Hari: {{ $membership->daily_transaction_limit }}</p>
                        <p class="{{ $membership->service_feature ? 'text-green-600' : 'text-red-600' }}">
                            {{ $membership->service_feature ? '✓' : '✗' }} Fitur Service
                        </p>
                        <!-- Tambahkan fitur lainnya -->
                        <div class="mt-4 pt-4 border-t">
                            <p class="font-bold">Biaya Bulanan:</p>
                            <p class="text-2xl font-bold text-blue-600">
                                Rp {{ number_format($membership->biaya_bulanan, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
