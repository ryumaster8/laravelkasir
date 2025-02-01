@extends('layouts_dashboard_owner.layout_owner')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Form Section -->
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Database Configuration</h2>
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif
        
        <form action="{{ route('database.show-tables') }}" method="POST">
            @csrf
            
            <!-- Database Name -->
            <div class="mb-4">
                <label for="database" class="block text-gray-700 text-sm font-bold mb-2">Nama Database</label>
                <input type="text" 
                       name="database" 
                       id="database" 
                       value="laravel_kasir"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Hostname -->
            <div class="mb-4">
                <label for="hostname" class="block text-gray-700 text-sm font-bold mb-2">Hostname</label>
                <input type="text" 
                       name="hostname" 
                       id="hostname" 
                       value="localhost"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Port -->
            <div class="mb-4">
                <label for="port" class="block text-gray-700 text-sm font-bold mb-2">Port</label>
                <input type="text" 
                       name="port" 
                       id="port" 
                       value="3306"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Database Driver -->
            <div class="mb-4">
                <label for="driver" class="block text-gray-700 text-sm font-bold mb-2">Database Driver</label>
                <input type="text" 
                       name="driver" 
                       id="driver" 
                       value="MySQLi"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" 
                       name="username" 
                       id="username" 
                       value="root"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" 
                       name="password" 
                       id="password" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-center">
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Tampilkan Tabel
                </button>
            </div>
        </form>
    </div>

    <!-- Results Section -->
    @if(isset($showResults) && isset($tables))
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center space-x-4">
                    <h3 class="text-xl font-bold text-gray-800">Database Tables Structure</h3>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                        Total Tables: {{ count($tables) }}
                    </span>
                </div>
                <!-- Add Search Input -->
                <div class="flex space-x-4 items-center">
                    <div class="relative">
                        <input type="text" 
                               id="tableSearch" 
                               placeholder="Search tables..." 
                               class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-10 pr-4 py-2 text-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                    <!-- Existing View Toggle and Copy All -->
                    <div class="flex space-x-4">
                        <!-- View Toggle -->
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">View Mode:</span>
                            <select id="viewMode" class="rounded border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="separate">Separate Tables</option>
                                <option value="combined">Combined View</option>
                            </select>
                        </div>
                        <!-- Copy All Button -->
                        <button 
                            onclick="copyAllTables()"
                            class="copy-all-btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                            </svg>
                            Copy All
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Add this right before the results -->
            <div id="noResults" class="hidden text-center py-4 text-gray-500">
                No matching tables found
            </div>
            
            <!-- Separate Tables View -->
            <div id="separateView" class="space-y-4">
                @foreach($tables as $tableName => $createStatement)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="text-lg font-semibold text-blue-600">{{ $tableName }}</h4>
                            <button 
                                onclick="copyToClipboard('{{ $tableName }}')"
                                class="copy-btn bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded-md text-sm flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                                </svg>
                                Copy
                            </button>
                        </div>
                        <div class="bg-gray-100 p-4 rounded overflow-x-auto">
                            <pre id="{{ $tableName }}" class="text-sm text-gray-700 whitespace-pre-wrap">{{ $createStatement }}</pre>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Combined View -->
            <div id="combinedView" class="hidden">
                <div class="bg-white rounded-lg shadow-md p-4">
                    <div class="bg-gray-100 p-4 rounded overflow-x-auto">
                        <pre id="combinedTables" class="text-sm text-gray-700 whitespace-pre-wrap">@foreach($tables as $tableName => $createStatement)-- Table: {{ $tableName }}

{{ $createStatement }};

@endforeach</pre>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Back to Top Button -->
<button id="backToTop" 
        class="fixed bottom-4 right-4 bg-gray-800 text-white rounded-full p-3 shadow-lg transition-opacity duration-300 opacity-0 hover:bg-gray-700 focus:outline-none">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
    </svg>
</button>

<style>
    pre {
        white-space: pre-wrap;
        word-wrap: break-word;
        font-family: monospace;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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

        // Add copy to clipboard functionality
        function copyToClipboard(tableName) {
            const text = document.getElementById(tableName).textContent;
            copyWithFeedback(text, event.currentTarget);
        }

        // Copy all tables function
        window.copyAllTables = function() {
            const text = document.getElementById('combinedTables').textContent;
            copyWithFeedback(text, document.querySelector('.copy-all-btn'));
        };

        // Helper function for copy feedback
        function copyWithFeedback(text, button) {
            const originalText = button.innerHTML;
            
            navigator.clipboard.writeText(text).then(() => {
                button.innerHTML = `
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Copied!
                `;
                button.classList.add('bg-green-500', 'text-white');
                button.classList.remove('bg-gray-200', 'hover:bg-gray-300', 'bg-blue-500', 'hover:bg-blue-600');
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.classList.remove('bg-green-500', 'text-white');
                    if (button.classList.contains('copy-all-btn')) {
                        button.classList.add('bg-blue-500', 'hover:bg-blue-600');
                    } else {
                        button.classList.add('bg-gray-200', 'hover:bg-gray-300');
                    }
                }, 2000);
            });
        }

        // View Toggle Handler
        const viewModeSelect = document.getElementById('viewMode');
        const separateView = document.getElementById('separateView');
        const combinedView = document.getElementById('combinedView');

        viewModeSelect.addEventListener('change', function() {
            if (this.value === 'combined') {
                separateView.classList.add('hidden');
                combinedView.classList.remove('hidden');
            } else {
                separateView.classList.remove('hidden');
                combinedView.classList.add('hidden');
            }
        });

        // Make copyToClipboard function globally available
        window.copyToClipboard = copyToClipboard;

        // Add search functionality
        const tableSearch = document.getElementById('tableSearch');
        const noResults = document.getElementById('noResults');
        
        tableSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const tableDivs = document.querySelectorAll('#separateView > div, #combinedView > div');
            let hasResults = false;

            tableDivs.forEach(div => {
                const tableNameElement = div.querySelector('h4');
                if (tableNameElement) {
                    const tableName = tableNameElement.textContent.toLowerCase();
                    if (tableName.includes(searchTerm)) {
                        div.classList.remove('hidden');
                        hasResults = true;
                    } else {
                        div.classList.add('hidden');
                    }
                }
            });

            // Show/hide no results message
            noResults.classList.toggle('hidden', hasResults);
        });
    });
</script>

@endsection
