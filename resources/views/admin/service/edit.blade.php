@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-dark">
            <h3>Edit Data Service</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('services.update', $service->service_id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Faktur -->
                <div class="form-group">
                    <label for="faktur">Faktur</label>
                    <input type="text" id="faktur" name="faktur" class="form-control" value="{{ $service->faktur }}" readonly>
                </div>

                <!-- Nama Pelanggan -->
                <div class="form-group">
                    <label for="nama_pelanggan">Nama Pelanggan</label>
                    <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control" value="{{ $service->customer_name }}" required>
                </div>

                <!-- Nama Perangkat -->
                <div class="form-group">
                    <label for="nama_perangkat">Nama Perangkat</label>
                    <input type="text" id="nama_perangkat" name="nama_perangkat" class="form-control" value="{{ $service->device_name }}" required>
                </div>

                <!-- Tipe Perangkat -->
                <div class="form-group">
                    <label for="tipe_perangkat">Tipe Perangkat</label>
                    <select id="tipe_perangkat" name="tipe_perangkat" class="form-control" required>
                        <option value="">Pilih Tipe Perangkat</option>
                        <option value="Handphone" {{ $service->tipe_perangkat == 'Handphone' ? 'selected' : '' }}>Handphone</option>
                        <option value="Laptop" {{ $service->tipe_perangkat == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                        <option value="PC" {{ $service->tipe_perangkat == 'PC' ? 'selected' : '' }}>PC</option>
                        <option value="Lainnya" {{ $service->tipe_perangkat == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <!-- Serial Number -->
                <div class="form-group">
                    <label for="serial_number">Nomor Serial/IMEI</label>
                    <input type="text" id="serial_number" name="serial_number" class="form-control" value="{{ $service->serial_number }}" required>
                </div>

                <!-- Keluhan -->
                <div class="form-group">
                    <label for="keluhan">Keluhan</label>
                    <textarea id="keluhan" name="keluhan" class="form-control" rows="3" required>{{ $service->keluhan }}</textarea>
                </div>

                <!-- Kerusakan -->
                <div class="form-group">
                    <label for="kerusakan">Kerusakan</label>
                    <textarea id="kerusakan" name="kerusakan" class="form-control" rows="3">{{ $service->kerusakan }}</textarea>
                </div>

                <!-- Sparepart -->
                <div class="form-group">
                    <label for="sparepart">Sparepart</label>
                    <textarea id="sparepart" name="sparepart" class="form-control" rows="3">{{ $service->sparepart }}</textarea>
                </div>

                <!-- Kelengkapan Perangkat -->
                <div class="form-group">
                    <label for="kelengkapan_perangkat">Kelengkapan Perangkat</label>
                    <textarea id="kelengkapan_perangkat" name="kelengkapan_perangkat" class="form-control" rows="3" required>{{ $service->equipment_included }}</textarea>
                </div>

                <!-- Biaya -->
                <div class="form-group">
                    <label for="biaya">Biaya</label>
                    <input type="number" id="biaya" name="biaya" class="form-control" value="{{ $service->biaya }}" required>
                </div>

                <!-- Status Pembayaran -->
                <div class="form-group">
                    <label for="status_pembayaran">Status Pembayaran</label>
                    <select id="status_pembayaran" name="status_pembayaran" class="form-control">
                        <option value="Belum Lunas" {{ $service->status_pembayaran == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="Uang Muka" {{ $service->status_pembayaran == 'Uang Muka' ? 'selected' : '' }}>Uang Muka</option>
                        <option value="Lunas" {{ $service->status_pembayaran == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" rows="3">{{ $service->description }}</textarea>
                </div>
            </form>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('services.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" form="form-edit-service" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</div>
@endsection
