@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <x-flash-message />
                <div class="card">
                    <div class="card-header">
                         <h3 class="text-dark">Edit Data Teknisi</h3>
                    </div>
                    <div class="card-body">
                         <form action="{{ route('teknisi.update', $teknisi->teknisi_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="operator_id" class="form-label">Operator</label>
                                <input type="text" class="form-control" id="operator_id" name="operator_id"
                                    value="{{ old('operatorName', $operatorName ?? '') }}"
                                    readonly>
                                  <input type="hidden" name="operator_id" value="{{auth()->user()->user_id}}">
                                @error('operator_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="teknisi_outlet_id" class="form-label">Outlet</label>
                                <input type="text" class="form-control" id="teknisi_outlet_id" name="teknisi_outlet_id"
                                    value="{{ old('outletName', $outletName ?? '') }}"
                                    readonly>
                                    <input type="hidden" name="teknisi_outlet_id" value="{{auth()->user()->outlet->outlet_id ?? ''}}">
                                @error('teknisi_outlet_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                             <div class="mb-3">
                                <label for="nama_teknisi" class="form-label">Nama Teknisi</label>
                                <input type="text" class="form-control" id="nama_teknisi" name="nama_teknisi"
                                    value="{{ old('nama_teknisi', $teknisi->nama_teknisi) }}" placeholder="Masukkan nama teknisi" required>
                                @error('nama_teknisi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kontak" class="form-label">Kontak</label>
                                <input type="text" class="form-control" id="kontak" name="kontak"
                                    value="{{ old('kontak', $teknisi->kontak) }}" placeholder="Masukkan kontak teknisi">
                                @error('kontak')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="/teknisi" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection