<!-- resources/views/kasir/components/kasir_form.blade.php -->

@php
    $isGrosir = $type === 'grosir';
@endphp
<div >
    @if($isGrosir && $customer)
       <p>Metode Pembayaran (Grosir):</p>
        <select>
            <option value="bon">Bon</option>
             <option value="tunai">Tunai</option>
        </select>
      @else
        <p>Metode Pembayaran (Ecer): Tunai</p>
     @endif

    {{-- FORM INPUT PRODUK --}}
    <form method="post">
         <table>
             <thead>
                  <tr>
                      <th>Produk</th>
                      <th>Harga</th>
                      <th>Kuantitas</th>
                  </tr>
             </thead>
              <tbody>
                  <tr>
                      <td>
                          <select>
                            {{-- ISI DENGAN DATA PRODUK --}}
                          </select>
                      </td>
                      <td>
                        {{-- ISI HARGA SESUAI TYPE --}}
                           @if($isGrosir)
                              Harga Grosir
                            @else
                               Harga Ecer
                            @endif
                      </td>
                       <td>
                          <input type="number" value="1">
                     </td>
                 </tr>
             </tbody>
         </table>
        <button class="btn" > Bayar </button>
    </form>


   {{-- TAMPILAN STRUK --}}
    @if($isGrosir)
          <p> Struk untuk Grosir</p>
         @if($customer)
            <p> Pelanggan : {{$customer->customer_name}}</p>
         @endif
    @else
        <p>Struk untuk ecer</p>
    @endif
</div>