@extends('layouts.layout')

@section('content')
<div class="d-flex justify-content-center mt-4">
  <div class="col-md-11">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title text-dark">Edit Cash Register</h3>
      </div>
      <div class="card-body">
        <!-- Flashdata -->
        <x-flashdata />

        <!-- Form Edit Cash Register -->
        <form action="{{ route('update.cash_register', $register->cash_register_id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label for="date">Tanggal</label>
            <input type="text" class="form-control" id="date" name="date" value="{{ $register->date }}" readonly>
          </div>
          <div class="form-group">
            <label for="opening_balance">Saldo Awal</label>
            <input type="number" class="form-control @error('opening_balance') is-invalid @enderror" id="opening_balance" name="opening_balance" value="{{ $register->opening_balance }}" required>
            @error('opening_balance')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="card-footer text-left">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('bukakasir') }}" class="btn btn-secondary">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
