@extends('layouts.layout')

@section('content')
    <x-flash-message />

    <div class="card">
        <div class="card-title">
            <h3>Pengambilan Servis</h3>
        </div>
        <div class="card-body">
            <form id="form-pengambilan" action="{{ route('service.updatePengambilan', $service->service_id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Faktur -->
                <div class="form-group">
                    <label for="faktur">Faktur</label>
                    <input type="text" id="faktur" class="form-control" value="{{ $service->faktur }}" readonly>
                </div>

                <!-- Outlet -->
                <div class="form-group">
                    <label for="outlet">Outlet</label>
                    <input type="text" id="outlet" class="form-control" value="{{ $outletName }}" readonly>
                </div>

                <!-- Operator -->
                <div class="form-group">
                    <label for="operator">Operator</label>
                    <input type="text" id="operator" class="form-control" value="{{ $operatorName }}" readonly>
                </div>

                <!-- Teknisi -->
                <div class="form-group">
                    <label for="teknisi">Nama Teknisi</label>
                    <input type="text" id="teknisi" class="form-control" value="{{ $teknisiName }}" readonly>
                </div>

                <!-- Tanggal Masuk -->
                <div class="form-group">
                    <label for="tanggal_masuk">Tanggal Masuk</label>
                    <input type="date" id="tanggal_masuk" class="form-control" value="{{ $tanggalMasuk }}" readonly>
                </div>

                <!-- Keterangan Pengambilan -->
                <div class="form-group">
                    <label for="description">Keterangan Pengambilan</label>
                    <textarea id="description" name="description" class="form-control">{{ old('description', $service->description ?? '') }}</textarea>
                </div>

                <!-- Status Servis -->
                <div class="form-group">
                    <label for="status_servis">Status Servis <span class="text-danger">*</span></label>
                    <select id="status_servis" name="status_servis" class="form-control" required>
                        <option value="">Pilih Status Servis</option>
                        <option value="Berhasil" {{ old('status_servis', $service->progress_status) === 'Selesai' ? 'selected' : '' }}>Berhasil</option>
                        <option value="Gagal" {{ old('status_servis', $service->progress_status) === 'Dibatalkan' ? 'selected' : '' }}>Gagal</option>
                        <option value="Dibatalkan" {{ old('status_servis', $service->progress_status) === 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>

                <!-- Biaya -->
                <div class="form-group">
                    <label for="biaya">Biaya</label>
                    <input type="number" id="biaya" name="biaya" class="form-control" value="{{ $service->biaya }}" readonly>
                </div>

                <!-- Uang Muka -->
                <div class="form-group">
                    <label for="uang_muka">Uang Muka</label>
                    <input type="number" id="uang_muka" name="uang_muka" class="form-control" value="{{ $service->uang_muka }}" readonly>
                </div>

                <!-- Sisa yang Harus Dibayar -->
                <div class="form-group">
                    <label for="sisa_pembayaran">Sisa yang Harus Dibayar</label>
                    <input type="number" id="sisa_pembayaran" name="sisa_pembayaran" class="form-control" value="0" readonly>
                    <small id="sisa_pembayaran_info" class="form-text text-muted"></small>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <button type="submit" form="form-pengambilan" class="btn btn-primary">Simpan</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusSelect = document.getElementById('status_servis');
            const biayaInput = document.getElementById('biaya');
            const uangMukaInput = document.getElementById('uang_muka');
            const sisaPembayaranInput = document.getElementById('sisa_pembayaran');
            const sisaPembayaranInfo = document.getElementById('sisa_pembayaran_info');

            function updateSisaPembayaran() {
                const status = statusSelect.value;
                const biaya = parseFloat(biayaInput.value) || 0;
                const uangMuka = parseFloat(uangMukaInput.value) || 0;

                if (status === 'Gagal' || status === 'Dibatalkan') {
                    sisaPembayaranInput.value = 0;
                    sisaPembayaranInfo.textContent = uangMuka > 0
                        ? `Uang yang harus dikembalikan kepada pelanggan sebesar Rp ${uangMuka.toLocaleString()}`
                        : 'Tidak ada uang yang harus dikembalikan kepada pelanggan.';
                } else if (status === 'Berhasil') {
                    const sisa = biaya - uangMuka;
                    sisaPembayaranInput.value = sisa > 0 ? sisa : 0;
                    sisaPembayaranInfo.textContent = `Sisa yang harus dibayar adalah total biaya dikurangi uang muka.`;
                } else {
                    sisaPembayaranInput.value = 0;
                    sisaPembayaranInfo.textContent = '';
                }
            }

            statusSelect.addEventListener('change', updateSisaPembayaran);
            updateSisaPembayaran();
        });
    </script>
@endsection
