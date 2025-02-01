@extends('layouts_dashboard_owner.layout_owner')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center space-x-4">
                    <h2 class="text-2xl font-bold text-gray-800">Laravel Controllers</h2>
                    <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full">
                        Total: {{ count($controllers) }} Controllers
                    </span>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" 
                               id="searchController" 
                               placeholder="Search controllers..." 
                               class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-10 pr-4 py-2">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Copy All Button -->
                    <button onclick="copyAllControllers()" 
                            class="copy-all-btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Copy All Names
                    </button>
                </div>
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="hidden text-center py-8 text-gray-500">
                No controllers found matching your search
            </div>

            <!-- Controllers Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($controllers as $controller)
                    <div class="bg-gray-50 p-4 rounded-lg controller-item">
                        <div class="flex justify-between items-center">
                            <span class="text-blue-600 font-medium">{{ $controller['name'] }}</span>
                            <button onclick="showDetail('{{ $controller['name'] }}', {{ json_encode($controller['content']) }})" 
                                    class="detail-btn bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Detail
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Detail Modal -->
            <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                <div class="relative top-5 mx-auto p-5 border w-11/12 md:w-4/5 shadow-lg rounded-md bg-white">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900" id="modalTitle"></h3>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <div class="overflow-auto max-h-[70vh]">
                        <pre id="modalContent" class="text-sm bg-gray-50 p-4 rounded-lg overflow-x-auto"></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button id="backToTop" 
            class="fixed bottom-4 right-4 bg-blue-600 text-white rounded-full p-3 shadow-lg transition-opacity duration-300 opacity-0 hover:bg-blue-700 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
        </svg>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchController');
        const controllerItems = document.querySelectorAll('.controller-item');
        const noResults = document.getElementById('noResults');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            let hasResults = false;

            controllerItems.forEach(item => {
                const controllerName = item.querySelector('.text-blue-600').textContent.toLowerCase();
                if (controllerName.includes(searchTerm)) {
                    item.classList.remove('hidden');
                    hasResults = true;
                } else {
                    item.classList.add('hidden');
                }
            });

            noResults.classList.toggle('hidden', hasResults);
        });

        // Back to Top functionality
        const backToTopButton = document.getElementById('backToTop');
        
        window.addEventListener('scroll', function() {
            backToTopButton.classList.toggle('opacity-100', window.scrollY > 300);
        });

        backToTopButton.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });

    function showDetail(name, content) {
        document.getElementById('modalTitle').textContent = name;
        document.getElementById('modalContent').textContent = content;
        document.getElementById('detailModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
        document.body.style.overflow = 'auto'; // Restore scrolling
    }

    // Close modal when clicking outside
    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Add escape key listener to close modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    function copyAllControllers() {
        const controllers = @json($controllers->pluck('name'));
        const text = controllers.join('\n');
        
        navigator.clipboard.writeText(text).then(() => {
            const button = document.querySelector('.copy-all-btn');
            const originalContent = button.innerHTML;
            
            button.innerHTML = `
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Copied All Names!
            `;
            button.classList.remove('bg-blue-500', 'hover:bg-blue-600');
            button.classList.add('bg-green-500', 'hover:bg-green-600');
            
            setTimeout(() => {
                button.innerHTML = originalContent;
                button.classList.remove('bg-green-500', 'hover:bg-green-600');
                button.classList.add('bg-blue-500', 'hover:bg-blue-600');
            }, 2000);
        });
    }
</script>
@endsection
