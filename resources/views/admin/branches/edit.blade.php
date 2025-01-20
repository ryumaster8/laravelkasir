@extends('layouts.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="text-dark card-title">Edit Cabang</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('branches.update', $outlet->outlet_id) }}" method="POST">
                    @csrf
                     @method('PUT')
                    <div class="mb-3">
                         <label for="parent_outlet_id" class="form-label">Induk Cabang</label>
                         <input type="text" class="form-control" id="parent_outlet_id" name="parent_outlet_id" value="{{$outlet->parentOutlet->outlet_name ?? 'Induk'}}"  readonly placeholder="Otomatis terisi">
                    </div>
                    <div class="mb-3">
                        <label for="outlet_name" class="form-label">Nama Cabang</label>
                        <input type="text" class="form-control" id="outlet_name" name="outlet_name" placeholder="Masukkan nama cabang" value="{{ $outlet->outlet_name}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="address" name="address" placeholder="Masukkan alamat cabang" required>{{ $outlet->address}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="contact_info" class="form-label">Kontak</label>
                        <input type="text" class="form-control" id="contact_info" name="contact_info" placeholder="Masukkan informasi kontak" value="{{ $outlet->contact_info}}" required>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('branches.index') }}" class="btn btn-secondary float-end">Kembali</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection