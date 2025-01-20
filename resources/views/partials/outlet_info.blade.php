{{-- <div class="logo-container">
  <img src="/img/logo-digisoft.png" alt="Digisoft Logo" class="logo">
</div> --}}
<div class="text-center mt-2">
    <h5>Outlet ID : {{ session('outlet_id') }}</h5>
    <h5>User ID : {{ session('user_id') }}</h5>
         Outlet: {{ session('outlet_name') }}
        @if(session('outlet_status') === 'induk')
          <span class="badge bg-success">Induk</span>
        @else
           <span class="badge bg-info">Cabang</span>
         @endif
    </h5>
    <p class="mb-0">
        Membership: <span class="badge bg-secondary">{{ session('membership_name') }}</span>
   </p>
   <p>Operator: {{ session('username') }}</p>
</div>