@extends('layouts_dashboard_owner.layout_owner')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center space-x-4">
                    <h2 class="text-2xl font-bold text-gray-800">Laravel Models</h2>
                    <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full">
                        Total: {{ count($models) }} Models
                    </span>
                </div>
                
                <!-- Add Search Input -->
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" 
                               id="searchModel" 
                               placeholder="Search models..." 
                               class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-10 pr-4 py-2">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- View Mode Selector -->
                    <div class="flex items-center space-x-4">
                        <label class="text-gray-700">View Mode:</label>
                        <select id="viewMode" class="rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="full">Full Content</option>
                            <option value="filenames">Filenames Only</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Add No Results Message -->
            <div id="noResults" class="hidden text-center py-8 text-gray-500">
                No models found matching your search
            </div>

            <!-- Filenames Only View -->
            <div id="filenamesView" class="hidden">
                <!-- Single Copy All Button -->
                <div class="mb-4 flex justify-end">
                    <button onclick="copyAllFilenames()" 
                            class="copy-all-btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Copy All Filenames
                    </button>
                </div>
                
                <!-- Grid of filenames without individual copy buttons -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($models as $model)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <span class="text-blue-600 font-medium">{{ $model['name'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Full Content View -->
            <div id="fullContentView" class="space-y-6">
                @foreach($models as $model)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-lg font-semibold text-blue-600">{{ $model['name'] }}</h3>
                            <button onclick="copyModelContent('{{ $model['name'] }}')" 
                                    class="copy-btn bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                Copy
                            </button>
                        </div>
                        <div class="bg-white p-4 rounded-lg overflow-x-auto">
                            <pre id="{{ $model['name'] }}" class="text-sm text-gray-700">{{ $model['content'] }}</pre>
                        </div>
                    </div>
                @endforeach
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
function copyModelContent(modelName) {
    const content = document.getElementById(modelName).textContent;
    copyWithFeedback(content, event.currentTarget);
}

function copyFileName(fileName) {
    copyWithFeedback(fileName, event.currentTarget);
}

function copyWithFeedback(text, button) {
    const originalContent = button.innerHTML;

    navigator.clipboard.writeText(text).then(() => {
        button.innerHTML = `
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Copied!
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

// Add this new function for copying all filenames
function copyAllFilenames() {
    const filenames = @json(collect($models)->pluck('name'));
    const text = filenames.join('\n');
    
    const button = document.querySelector('.copy-all-btn');
    const originalContent = button.innerHTML;
    
    navigator.clipboard.writeText(text).then(() => {
        button.innerHTML = `
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Copied All Filenames!
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

// View Mode Toggle
document.addEventListener('DOMContentLoaded', function() {
    const viewMode = document.getElementById('viewMode');
    const fullContentView = document.getElementById('fullContentView');
    const filenamesView = document.getElementById('filenamesView');
    
    viewMode.addEventListener('change', function() {
        if (this.value === 'full') {
            fullContentView.classList.remove('hidden');
            filenamesView.classList.add('hidden');
        } else {
            fullContentView.classList.add('hidden');
            filenamesView.classList.remove('hidden');
        }
    });

    // Add search functionality
    const searchInput = document.getElementById('searchModel');
    const modelContainers = document.querySelectorAll('#filenamesView .bg-gray-50, #fullContentView .bg-gray-50');
    const noResults = document.getElementById('noResults');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        let hasResults = false;

        modelContainers.forEach(container => {
            const modelName = container.querySelector('.text-blue-600').textContent.toLowerCase();
            const modelContent = container.querySelector('pre')?.textContent.toLowerCase() || '';
            
            if (modelName.includes(searchTerm) || modelContent.includes(searchTerm)) {
                container.classList.remove('hidden');
                hasResults = true;
            } else {
                container.classList.add('hidden');
            }
        });

        noResults.classList.toggle('hidden', hasResults);
    });

    // Back to Top functionality
    const backToTopButton = document.getElementById('backToTop');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTopButton.classList.replace('opacity-0', 'opacity-100');
        } else {
            backToTopButton.classList.replace('opacity-100', 'opacity-0');
        }
    });

    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});
</script>
@endsection
