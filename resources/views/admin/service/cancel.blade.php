@extends('layouts.layout')

@section('content')
    <div class="container">
        <h3>Konfirmasi Pembatalan Servis</h3>
        <div class="card">
            <div class="card-body">
                <p><strong>Faktur:</strong> {{ $service->faktur }}</p>
                <p><strong>Pelanggan:</strong> {{ $service->customer_name }}</p>
                <p><strong>Perangkat:</strong> {{ $service->device_name }}</p>
                <p><strong>Masalah:</strong> {{ $service->keluhan }}</p>

                <form action="{{ route('services.cancel', $service->service_id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="alasan_pembatalan">Alasan Pembatalan</label>
                        <textarea name="alasan_pembatalan" id="alasan_pembatalan" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">Konfirmasi Pembatalan</button>
                    <a href="{{ route('services.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
