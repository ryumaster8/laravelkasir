@extends('layouts.layout')

@section('title', 'Pindah Unit Produk')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="text-dark">Ajukan Pemindahan Unit {{ $product->product_id }} - {{ $product->product_name }}</h3>
        </div>
        <div class="card-body">
            <x-flash-message />
             <form action="{{ route('self-products.store-transfer-unit', $product->product_id) }}" method="POST">
                 @csrf

                 <div class="mb-3">
                    <label for="product_id" class="form-label">Produk ID</label>
                     <input type="text" class="form-control" id="product_id" name="product_id" value="{{ $product->product_id }}" readonly>
                </div>

                 <div class="mb-3">
                       <label for="operator" class="form-label">Operator</label>
                     <input type="text" class="form-control" id="operator" name="operator" value="{{ $user->username }}" readonly>
                   </div>

                  <div class="mb-3">
                        <label for="outlet" class="form-label">Outlet</label>
                        <input type="text" class="form-control" id="outlet" name="outlet" value="{{ $user->outlet ? $user->outlet->outlet_name : '' }}" readonly>
                  </div>

                   <div class="mb-3">
                        <label for="to_outlet_id" class="form-label">Outlet Tujuan</label>
                        <select class="form-control @error('to_outlet_id') is-invalid @enderror" id="to_outlet_id" name="to_outlet_id">
                             <option value="">-- Pilih Outlet --</option>
                             @foreach ($outlets as $outlet)
                                <option value="{{ $outlet->outlet_id }}" {{ old('to_outlet_id') == $outlet->outlet_id ? 'selected' : '' }}>{{ $outlet->outlet_name }} - {{ $outlet->outlet_id }}</option>
                              @endforeach
                      </select>
                        @error('to_outlet_id')
                             <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                   </div>
                  <table class="table table-striped table-bordered">
                     <thead>
                        <tr>
                         <th><input type="checkbox" id="select-all"> Pilih Semua</th>
                            <th>Nomer Serial</th>
                            <th>Status</th>
                         </tr>
                     </thead>
                      <tbody>
                         @foreach ($serials as $serial)
                             <tr>
                                 <td><input type="checkbox" name="selected_serials[]" value="{{ $serial->serial_id }}"></td>
                                    <td>{{ $serial->serial_number }}</td>
                                    <td>
                                        <span class="badge {{ $serial->status == 'available' ? 'bg-success' : ($serial->status == 'sold' ? 'bg-danger' : 'bg-warning') }}">
                                        {{ $serial->status }}
                                        </span>
                                  </td>
                             </tr>
                       @endforeach
                      </tbody>
               </table>

                <button type="submit" class="btn btn-primary" id="submit-transfer" disabled>Ajukan Pemindahan</button>
                <a href="{{ route('self-products') }}" class="btn btn-secondary">Cancel</a>
            </form>

        </div>
    </div>
</div>
   <script>
         document.addEventListener('DOMContentLoaded', function () {
             const selectAllCheckbox = document.getElementById('select-all');
             const serialCheckboxes = document.querySelectorAll('input[name="selected_serials[]"]');
             const submitButton = document.getElementById('submit-transfer');

             // Event listener untuk checkbox pilih semua
              selectAllCheckbox.addEventListener('change', function () {
                 serialCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                  });
                  updateSubmitButtonState();
              });

             // Event listener untuk setiap checkbox serial
              serialCheckboxes.forEach(checkbox => {
                  checkbox.addEventListener('change', function() {
                      updateSelectAllCheckbox();
                       updateSubmitButtonState();
                  });
               });
              // Fungsi untuk update checkbox pilih semua
               function updateSelectAllCheckbox() {
                   const allChecked = Array.from(serialCheckboxes).every(checkbox => checkbox.checked);
                   selectAllCheckbox.checked = allChecked;
                }
                 // Fungsi untuk update tombol submit
                function updateSubmitButtonState() {
                     const anyChecked = Array.from(serialCheckboxes).some(checkbox => checkbox.checked);
                     submitButton.disabled = !anyChecked;
                 }
          });
    </script>
@endsection