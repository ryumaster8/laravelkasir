

<?php $__env->startSection('title', 'Edit Profil Outlet'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Edit Profil Outlet</h2>
                </div>

                <?php if(session('success')): ?>
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline"><?php echo e(session('error')); ?></span>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('outlet.profile.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Outlet -->
                        <div>
                            <label for="outlet_name" class="block text-sm font-medium text-gray-700">Nama Outlet</label>
                            <input type="text" 
                                   id="outlet_name" 
                                   name="outlet_name" 
                                   value="<?php echo e(old('outlet_name', $outlet->outlet_name)); ?>"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm <?php $__errorArgs = ['outlet_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['outlet_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="<?php echo e(old('email', $outlet->email)); ?>"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Nomor Telepon -->
                        <div>
                            <label for="contact_info" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <input type="text" 
                                   id="contact_info" 
                                   name="contact_info" 
                                   value="<?php echo e(old('contact_info', $outlet->contact_info)); ?>"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm <?php $__errorArgs = ['contact_info'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['contact_info'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea id="address" 
                                 name="address" 
                                 rows="3" 
                                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('address', $outlet->address)); ?></textarea>
                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Informasi Kontak Tambahan -->
                    <div>
                        <label for="contact_info" class="block text-sm font-medium text-gray-700">Informasi Kontak Tambahan</label>
                        <textarea id="contact_info" 
                                 name="contact_info" 
                                 rows="3" 
                                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm <?php $__errorArgs = ['contact_info'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('contact_info', $outlet->contact_info)); ?></textarea>
                        <?php $__errorArgs = ['contact_info'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Logo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Logo Outlet</label>
                        <div class="mt-2 flex items-center space-x-4">
                            <?php if($outlet->logo): ?>
                                <div class="relative">
                                    <img src="<?php echo e(asset('storage/' . $outlet->logo)); ?>" 
                                         alt="Logo outlet" 
                                         class="h-24 w-24 object-cover rounded-lg">
                                </div>
                            <?php endif; ?>
                            <div class="flex items-center">
                                <label class="cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span>Upload Logo Baru</span>
                                    <input type="file" 
                                           id="logo" 
                                           name="logo" 
                                           accept="image/*" 
                                           class="sr-only">
                                </label>
                            </div>
                        </div>
                        <div id="logo-preview" class="mt-2"></div>
                        <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3 pt-5">
                        <a href="<?php echo e(url()->previous()); ?>" 
                           class="inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Kembali
                        </a>
                        <button type="submit" 
                                id="submitButton"
                                class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span id="buttonText">Simpan Perubahan</span>
                            <svg id="loadingIcon" class="hidden animate-spin ml-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.getElementById('logo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.createElement('img');
            preview.src = e.target.result;
            preview.classList.add('h-24', 'w-24', 'object-cover', 'rounded-lg', 'mt-2');
            
            const previewContainer = document.getElementById('logo-preview');
            previewContainer.innerHTML = '';
            previewContainer.appendChild(preview);
        }
        reader.readAsDataURL(file);
    }
});

// Form submission handling
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitButton = document.getElementById('submitButton');
    const buttonText = document.getElementById('buttonText');
    const loadingIcon = document.getElementById('loadingIcon');
    
    // Disable button and show loading state
    submitButton.disabled = true;
    buttonText.textContent = 'Menyimpan...';
    loadingIcon.classList.remove('hidden');
    
    // Get form data
    const formData = new FormData(this);
    
    // Send AJAX request
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        credentials: 'same-origin'
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(json => {
                throw new Error(json.message || 'Terjadi kesalahan pada server');
            });
        }
        return response.json();
    })
    .then(data => {
        // Reset button state
        submitButton.disabled = false;
        buttonText.textContent = 'Simpan Perubahan';
        loadingIcon.classList.add('hidden');
        
        // Show success message
        const successAlert = document.createElement('div');
        successAlert.className = 'mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative';
        successAlert.innerHTML = `<span class="block sm:inline">${data.message}</span>`;
        
        // Find the form and container
        const form = document.querySelector('form');
        const container = form.closest('.p-6');
        
        // Remove any existing alerts
        const existingAlerts = container.querySelectorAll('[role="alert"]');
        existingAlerts.forEach(alert => alert.remove());
        
        // Insert alert at the top of the container
        container.insertBefore(successAlert, container.firstChild);
        
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
        
        // Reload page after success
        if(data.success) {
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }
    })
    .catch(error => {
        // Reset button state
        submitButton.disabled = false;
        buttonText.textContent = 'Simpan Perubahan';
        loadingIcon.classList.add('hidden');
        
        // Show error message
        const errorAlert = document.createElement('div');
        errorAlert.className = 'mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative';
        errorAlert.innerHTML = `<span class="block sm:inline">Error: ${error.message}</span>`;
        
        // Find the form and container
        const form = document.querySelector('form');
        const container = form.closest('.p-6');
        
        // Remove any existing alerts
        const existingAlerts = container.querySelectorAll('[role="alert"]');
        existingAlerts.forEach(alert => alert.remove());
        
        // Insert alert at the top of the container
        container.insertBefore(errorAlert, container.firstChild);
        
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});

// Add form change detection
const form = document.querySelector('form');
const originalFormData = new FormData(form);
const submitButton = document.getElementById('submitButton');

function checkFormChanges() {
    const currentFormData = new FormData(form);
    let hasChanges = false;
    
    for(const pair of currentFormData.entries()) {
        const originalValue = originalFormData.get(pair[0]);
        if(pair[1] !== originalValue) {
            hasChanges = true;
            break;
        }
    }
    
    submitButton.disabled = !hasChanges;
}

// Add change event listeners to all form inputs
form.querySelectorAll('input, textarea').forEach(input => {
    input.addEventListener('input', checkFormChanges);
    input.addEventListener('change', checkFormChanges);
});

// Initial button state
submitButton.disabled = true;
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/admin/outlets/edit-profile.blade.php ENDPATH**/ ?>