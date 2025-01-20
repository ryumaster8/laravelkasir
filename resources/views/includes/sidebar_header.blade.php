<div class="sidebar-header">
    <div class="logo-container">
       <!-- Anda dapat menambahkan logo disini-->
    </div>
     <div class="text-center">
         <h5 class="mb-1">
                {{ $outletName ?? 'Nama Outlet' }}
         </h5>
           <p class="text-muted">
            Status Outlet: <span class="badge {{ $outletStatus == 'active' ? 'bg-success' : 'bg-danger'}} ">{{ $outletStatus ?? 'Tidak Aktif' }}</span>
            </p>
           <p class="text-muted">
            Membership:  <span class="badge {{ $membership == 'platinum' ? 'bg-success' : ($membership == 'gold' ? 'bg-warning' : 'bg-secondary') }} "> {{ $membership ?? 'Basic' }} </span>
            </p>
          <p class="text-muted">
                 Operator: {{ $username ?? 'Nama Operator' }}
           </p>
     </div>
</div>