<?php if(session('success') || session('error')): ?>
<div id="flash-message" class="mb-4 p-4 rounded-lg shadow-lg <?php echo e(session('success') ? 'bg-green-100 border-green-500' : 'bg-red-100 border-red-500'); ?> border-l-4">
    <div class="flex items-start">
        <div class="flex-shrink-0">
            <?php if(session('success')): ?>
                <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            <?php else: ?>
                <svg class="h-6 w-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            <?php endif; ?>
        </div>
        <div class="ml-3 flex-1">
            <p class="text-sm leading-5 font-medium <?php echo e(session('success') ? 'text-green-900' : 'text-red-900'); ?> whitespace-pre-line">
                <?php echo nl2br(e(session('success') ?? session('error'))); ?>

            </p>
        </div>
        <div class="ml-4 flex-shrink-0 flex">
            <button onclick="closeFlashMessage()" class="inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150">
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
function closeFlashMessage() {
    const flashMessage = document.getElementById('flash-message');
    flashMessage.style.opacity = '0';
    flashMessage.style.transform = 'translateY(-10px)';
    setTimeout(() => {
        flashMessage.style.display = 'none';
    }, 300);
}

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeFlashMessage();
    }
});
</script>

<style>
#flash-message {
    transition: opacity 0.3s ease, transform 0.3s ease;
}
</style>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\laravelkasir\resources\views/components/flash-message.blade.php ENDPATH**/ ?>