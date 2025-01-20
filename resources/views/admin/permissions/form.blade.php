@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="text-dark">
                     {{ isset($userPermission) ? 'Edit' : 'Tambah' }} Pengaturan Akses Pengguna
               </h3>
            </div>
            <div class="card-body">
                <x-flash-message />
                   <form action="{{ isset($userPermission) ? route('user-permissions.update', $userPermission->user_permission_id) : route('user-permissions.store') }}" method="POST">
                    @csrf
                     @if(isset($userPermission))
                      @method('PUT')
                    @endif
                     <div class="form-group">
                        <label for="operator">Operator</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->username }}" readonly>
                     </div>
                       <div class="form-group">
                            <label for="role_id">Role</label>
                              <select class="form-control" name="role_id" id="role_id" required>
                                  <option value="">Pilih Role</option>
                                  @foreach($roles as $role)
                                       @if($role->role_name !== 'superadmin')
                                            <option value="{{$role->role_id}}" {{ old('role_id', isset($userPermission) ? $userPermission->role_id : '') == $role->role_id ? 'selected' : '' }}>{{$role->role_name}}</option>
                                         @endif
                                 @endforeach
                              </select>
                        </div>
                     <div class="form-group">
                            <label for="outlet_id">Outlet</label>
                               <select class="form-control" name="outlet_id" id="outlet_id" required>
                                   <option value="">Pilih Outlet</option>
                                   @foreach($outlets as $outlet)
                                        <option value="{{$outlet->outlet_id}}" {{ old('outlet_id', isset($userPermission) ? $userPermission->outlet_id : '') == $outlet->outlet_id ? 'selected' : '' }}>{{$outlet->outlet_name}} ({{ $outlet->status == 'induk' ? 'induk' : 'cabang' }})</option>
                                    @endforeach
                               </select>
                        </div>
                     <div class="row">
                       <div class="col-md-6">
                           <div class="text-center mb-3">
                                <button type="button" class="btn btn-success btn-sm select-all-permissions">BISA UNTUK SEMUA</button>
                                 <button type="button" class="btn btn-danger btn-sm unselect-all-permissions">TIDAK BISA UNTUK SEMUA</button>
                            </div>
                            <div class="col-md-12">
                                 <h5 class="text-dark">Kelompok Supplier</h5>
                            
                                    <div class="form-group">
                                        <label>
                                            Bisa Tambah Supplier?
                                            <select class="permission-select" name="can_add_supplier">
                                                <option value="0" {{ old('can_add_supplier', isset($userPermission) ? $userPermission->can_add_supplier : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                <option value="1" {{ old('can_add_supplier', isset($userPermission) ? $userPermission->can_add_supplier : '') == 1 ? 'selected' : '' }}>Ya</option>
                                            </select>
                                        </label>
                                    </div>
                                     <div class="form-group">
                                       <label>
                                            Bisa Edit Supplier?
                                            <select class="permission-select" name="can_edit_supplier">
                                                <option value="0" {{ old('can_edit_supplier', isset($userPermission) ? $userPermission->can_edit_supplier : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                <option value="1" {{ old('can_edit_supplier', isset($userPermission) ? $userPermission->can_edit_supplier : '') == 1 ? 'selected' : '' }}>Ya</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Bisa Hapus Supplier?
                                            <select class="permission-select" name="can_delete_supplier">
                                                <option value="0" {{ old('can_delete_supplier', isset($userPermission) ? $userPermission->can_delete_supplier : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                <option value="1" {{ old('can_delete_supplier', isset($userPermission) ? $userPermission->can_delete_supplier : '') == 1 ? 'selected' : '' }}>Ya</option>
                                            </select>
                                        </label>
                                     </div>
                                </div>
                                <div class="col-md-12">
                                    <h5 class="text-dark">Kelompok Produk</h5>
                            
                                        <div class="form-group">
                                            <label>
                                                Bisa Tambah Produk?
                                                <select class="permission-select" name="can_add_product">
                                                     <option value="0" {{ old('can_add_product', isset($userPermission) ? $userPermission->can_add_product : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                     <option value="1" {{ old('can_add_product', isset($userPermission) ? $userPermission->can_add_product : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                  </select>
                                               </label>
                                         </div>
                                          <div class="form-group">
                                              <label>
                                                  Bisa Edit Produk?
                                                  <select class="permission-select" name="can_edit_product">
                                                        <option value="0" {{ old('can_edit_product', isset($userPermission) ? $userPermission->can_edit_product : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                      <option value="1" {{ old('can_edit_product', isset($userPermission) ? $userPermission->can_edit_product : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                   </select>
                                                </label>
                                          </div>
                                         <div class="form-group">
                                              <label>
                                                 Bisa Hapus Produk?
                                                  <select class="permission-select" name="can_delete_product">
                                                        <option value="0" {{ old('can_delete_product', isset($userPermission) ? $userPermission->can_delete_product : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                      <option value="1" {{ old('can_delete_product', isset($userPermission) ? $userPermission->can_delete_product : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                  </select>
                                               </label>
                                         </div>
                                 
                                </div>
                                  <div class="col-md-12">
                                        <h5 class="text-dark">Kelompok Kategori</h5>
                                  
                                            <div class="form-group">
                                                <label>
                                                     Bisa Tambah Kategori?
                                                     <select class="permission-select" name="can_add_category">
                                                        <option value="0" {{ old('can_add_category', isset($userPermission) ? $userPermission->can_add_category : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                        <option value="1" {{ old('can_add_category', isset($userPermission) ? $userPermission->can_add_category : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                    </select>
                                                </label>
                                            </div>
                                             <div class="form-group">
                                                 <label>
                                                    Bisa Edit Kategori?
                                                    <select class="permission-select" name="can_edit_category">
                                                          <option value="0" {{ old('can_edit_category', isset($userPermission) ? $userPermission->can_edit_category : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                           <option value="1" {{ old('can_edit_category', isset($userPermission) ? $userPermission->can_edit_category : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                     </select>
                                                 </label>
                                            </div>
                                            <div class="form-group">
                                                 <label>
                                                     Bisa Hapus Kategori?
                                                     <select class="permission-select" name="can_delete_category">
                                                          <option value="0" {{ old('can_delete_category', isset($userPermission) ? $userPermission->can_delete_category : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                          <option value="1" {{ old('can_delete_category', isset($userPermission) ? $userPermission->can_delete_category : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                      </select>
                                                  </label>
                                              </div>
                             
                                 </div>
                            </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                 <h5 class="text-dark">Kelompok Tabel Produk</h5>
                             
                                    <div class="form-group">
                                        <label>
                                          Bisa Lihat ID Produk?
                                          <select class="permission-select" name="can_see_product_id">
                                               <option value="0" {{ old('can_see_product_id', isset($userPermission) ? $userPermission->can_see_product_id : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                               <option value="1" {{ old('can_see_product_id', isset($userPermission) ? $userPermission->can_see_product_id : '') == 1 ? 'selected' : '' }}>Ya</option>
                                           </select>
                                        </label>
                                     </div>
                                      <div class="form-group">
                                            <label>
                                                Bisa Lihat Harga Modal?
                                                <select class="permission-select" name="can_see_cost_price">
                                                     <option value="0" {{ old('can_see_cost_price', isset($userPermission) ? $userPermission->can_see_cost_price : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                    <option value="1" {{ old('can_see_cost_price', isset($userPermission) ? $userPermission->can_see_cost_price : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                 </select>
                                             </label>
                                         </div>
                                       <div class="form-group">
                                              <label>
                                                  Bisa Lihat Harga Jual?
                                                  <select class="permission-select" name="can_see_sale_price">
                                                       <option value="0" {{ old('can_see_sale_price', isset($userPermission) ? $userPermission->can_see_sale_price : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                      <option value="1" {{ old('can_see_sale_price', isset($userPermission) ? $userPermission->can_see_sale_price : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                 </select>
                                              </label>
                                          </div>
                                      <div class="form-group">
                                          <label>
                                              Bisa Lihat Merek Produk?
                                                <select class="permission-select" name="can_see_brand">
                                                    <option value="0" {{ old('can_see_brand', isset($userPermission) ? $userPermission->can_see_brand : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                     <option value="1" {{ old('can_see_brand', isset($userPermission) ? $userPermission->can_see_brand : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                  </select>
                                             </label>
                                        </div>
                                    <div class="form-group">
                                         <label>
                                              Bisa Lihat Stok Produk?
                                              <select class="permission-select" name="can_see_stock">
                                                  <option value="0" {{ old('can_see_stock', isset($userPermission) ? $userPermission->can_see_stock : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                  <option value="1" {{ old('can_see_stock', isset($userPermission) ? $userPermission->can_see_stock : '') == 1 ? 'selected' : '' }}>Ya</option>
                                               </select>
                                            </label>
                                       </div>
                                    <div class="form-group">
                                        <label>
                                            Bisa Lihat Barcode Produk?
                                           <select class="permission-select" name="can_see_barcode">
                                                <option value="0" {{ old('can_see_barcode', isset($userPermission) ? $userPermission->can_see_barcode : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                <option value="1" {{ old('can_see_barcode', isset($userPermission) ? $userPermission->can_see_barcode : '') == 1 ? 'selected' : '' }}>Ya</option>
                                             </select>
                                         </label>
                                      </div>
                                    <div class="form-group">
                                         <label>
                                               Bisa Lihat Unit Barcode?
                                              <select class="permission-select" name="can_see_unit_barcode">
                                                  <option value="0" {{ old('can_see_unit_barcode', isset($userPermission) ? $userPermission->can_see_unit_barcode : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                <option value="1" {{ old('can_see_unit_barcode', isset($userPermission) ? $userPermission->can_see_unit_barcode : '') == 1 ? 'selected' : '' }}>Ya</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Bisa Lihat Supplier?
                                            <select class="permission-select" name="can_see_supplier">
                                                <option value="0" {{ old('can_see_supplier', isset($userPermission) ? $userPermission->can_see_supplier : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                 <option value="1" {{ old('can_see_supplier', isset($userPermission) ? $userPermission->can_see_supplier : '') == 1 ? 'selected' : '' }}>Ya</option>
                                            </select>
                                       </label>
                                     </div>
                                   <div class="form-group">
                                        <label>
                                           Bisa Lihat Kategori Produk?
                                            <select class="permission-select" name="can_see_category">
                                                 <option value="0" {{ old('can_see_category', isset($userPermission) ? $userPermission->can_see_category : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                 <option value="1" {{ old('can_see_category', isset($userPermission) ? $userPermission->can_see_category : '') == 1 ? 'selected' : '' }}>Ya</option>
                                             </select>
                                          </label>
                                   </div>
                                   <div class="form-group">
                                         <label>
                                             Bisa Lihat Lokasi Produk?
                                               <select class="permission-select" name="can_see_product_location">
                                                     <option value="0" {{ old('can_see_product_location', isset($userPermission) ? $userPermission->can_see_product_location : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                     <option value="1" {{ old('can_see_product_location', isset($userPermission) ? $userPermission->can_see_product_location : '') == 1 ? 'selected' : '' }}>Ya</option>
                                               </select>
                                            </label>
                                     </div>
                                       <div class="form-group">
                                          <label>
                                              Bisa Lihat Operator?
                                               <select class="permission-select" name="can_see_operator">
                                                    <option value="0" {{ old('can_see_operator', isset($userPermission) ? $userPermission->can_see_operator : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                     <option value="1" {{ old('can_see_operator', isset($userPermission) ? $userPermission->can_see_operator : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                  </select>
                                             </label>
                                          </div>
                                          <div class="form-group">
                                              <label>
                                                 Bisa Lihat Outlet?
                                                  <select class="permission-select" name="can_see_outlet">
                                                       <option value="0" {{ old('can_see_outlet', isset($userPermission) ? $userPermission->can_see_outlet : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                       <option value="1" {{ old('can_see_outlet', isset($userPermission) ? $userPermission->can_see_outlet : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                </select>
                                            </label>
                                         </div>
                         
                                 </div>
                                <div class="col-md-12">
                                     <h5 class="text-dark">Kelompok Lokasi Produk</h5>
                            
                                          <div class="form-group">
                                             <label>
                                                   Bisa Tambah Lokasi Produk?
                                                   <select class="permission-select" name="can_add_product_location">
                                                       <option value="0" {{ old('can_add_product_location', isset($userPermission) ? $userPermission->can_add_product_location : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                       <option value="1" {{ old('can_add_product_location', isset($userPermission) ? $userPermission->can_add_product_location : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                   </select>
                                                </label>
                                         </div>
                                           <div class="form-group">
                                               <label>
                                                     Bisa Edit Lokasi Produk?
                                                    <select class="permission-select" name="can_edit_product_location">
                                                        <option value="0" {{ old('can_edit_product_location', isset($userPermission) ? $userPermission->can_edit_product_location : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                        <option value="1" {{ old('can_edit_product_location', isset($userPermission) ? $userPermission->can_edit_product_location : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                      </select>
                                                </label>
                                           </div>
                                          <div class="form-group">
                                              <label>
                                                  Bisa Hapus Lokasi Produk?
                                                  <select class="permission-select" name="can_delete_product_location">
                                                       <option value="0" {{ old('can_delete_product_location', isset($userPermission) ? $userPermission->can_delete_product_location : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                      <option value="1" {{ old('can_delete_product_location', isset($userPermission) ? $userPermission->can_delete_product_location : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                  </select>
                                            </label>
                                      </div>
                                </div>
                            <div class="col-md-12">
                                 <h5 class="text-dark">Kelompok Pengguna</h5>
                                     
                                        <div class="form-group">
                                             <label>
                                                  Bisa Tambah Pengguna?
                                                  <select class="permission-select" name="can_add_user">
                                                      <option value="0" {{ old('can_add_user', isset($userPermission) ? $userPermission->can_add_user : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                      <option value="1" {{ old('can_add_user', isset($userPermission) ? $userPermission->can_add_user : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                  </select>
                                               </label>
                                         </div>
                                            <div class="form-group">
                                               <label>
                                                   Bisa Edit Pengguna?
                                                    <select class="permission-select" name="can_edit_user">
                                                      <option value="0" {{ old('can_edit_user', isset($userPermission) ? $userPermission->can_edit_user : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                      <option value="1" {{ old('can_edit_user', isset($userPermission) ? $userPermission->can_edit_user : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                    </select>
                                                </label>
                                           </div>
                                          <div class="form-group">
                                             <label>
                                                  Bisa Hapus Pengguna?
                                                  <select class="permission-select" name="can_delete_user">
                                                      <option value="0" {{ old('can_delete_user', isset($userPermission) ? $userPermission->can_delete_user : '') == 0 ? 'selected' : '' }}>Tidak</option>
                                                     <option value="1" {{ old('can_delete_user', isset($userPermission) ? $userPermission->can_delete_user : '') == 1 ? 'selected' : '' }}>Ya</option>
                                                   </select>
                                               </label>
                                          </div>
                                  </div>
                            </div>
                        </div>
                </div>
              
                <div class="card-footer d-flex justify-content-between">
                     <a href="{{ route('user-permissions.index') }}" class="btn btn-secondary order-1">Kembali</a>
                   <button type="submit" class="btn btn-primary order-0">Simpan</button>
                </div>
            </form>
             <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="text-dark">Panduan Penggunaan Fitur Pengaturan Akses Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <p>Fitur Pengaturan Akses Pengguna ini digunakan untuk mengatur hak akses dari setiap pengguna berdasarkan role yang diberikan. Fitur ini dapat mempermudah administrator untuk membatasi akses setiap user.</p>
                        <h6 class="text-dark">Cara Menggunakan</h6>
                        <ol>
                            <li>Pilih Role yang akan diatur hak aksesnya pada input <b>Role</b></li>
                            <li>Pilih Outlet yang akan diatur hak aksesnya, jika tidak ada dapat dikosongkan</li>
                            <li>Pilih atau atur checkbox untuk hak akses yang dibutuhkan pada setiap kelompok, ada kelompok supplier, produk, tabel produk, kategori, lokasi produk dan pengguna.</li>
                            <li>Klik tombol <b>BISA UNTUK SEMUA</b> untuk memberikan semua hak akses dan klik tombol <b>TIDAK BISA UNTUK SEMUA</b> untuk menghilangkan semua hak akses.</li>
                            <li>Setelah selesai mengatur hak akses klik tombol <b>Simpan</b> untuk menyimpan perubahan.</li>
                            <li>Anda dapat menekan tombol <b>Kembali</b> untuk kembali ke halaman daftar pengaturan akses pengguna.</li>
                        </ol>
                    </div>
                </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.select-all-permissions').click(function () {
                $('.permission-select').val('1').trigger('change');
            });
            $('.unselect-all-permissions').click(function () {
                $('.permission-select').val('0').trigger('change');
            });
        });
    </script>
@endsection