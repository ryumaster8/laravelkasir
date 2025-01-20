 @extends('layouts.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-dark">Edit Data Pelanggan Grosir</h3>
        </div>
        <div class="card-body">
             <x-flash-message/>
            <form action="/wholesale-customer/{{ $customer->wholesale_customer_id }}" method="POST">
                 @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="operator_id" class="form-label">Operator</label>
                    <input type="text" class="form-control" id="operator_id" name="operator_id"
                        value="{{ $customer->operator->username }}" readonly placeholder="Operator otomatis terisi">
                    <input type="hidden" name="operator_id" value="{{ $customer->operator->user_id }}">
                </div>
                 <div class="mb-3">
                    <label for="customer_outlet_id" class="form-label">Outlet</label>
                    <input type="text" class="form-control" id="customer_outlet_id" name="customer_outlet_id"
                        value="{{ $customer->outlet->outlet_name }}" readonly placeholder="Outlet otomatis terisi">
                    <input type="hidden" name="customer_outlet_id" value="{{ $customer->outlet->outlet_id }}">
                </div>
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name"
                        value="{{ $customer->customer_name }}" placeholder="Masukkan nama pelanggan">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ $customer->email }}" required placeholder="Masukkan email pelanggan">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="contact_info" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="contact_info" name="contact_info"
                        value="{{ $customer->contact_info }}" placeholder="Masukkan nomor telepon pelanggan">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea class="form-control" id="address" name="address" rows="3"
                        placeholder="Masukkan alamat pelanggan">{{ $customer->address }}</textarea>
                </div>

        </div>
        <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/wholesale-customer" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection