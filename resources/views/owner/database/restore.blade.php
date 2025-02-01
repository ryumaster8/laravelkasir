@extends('layouts_dashboard_owner.layout_owner')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Database Restore</h2>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="space-y-6">
                <!-- Warning Message -->
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                <strong class="font-medium">Warning!</strong> Restoring database will overwrite existing data. Please make sure you have a backup before proceeding.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Upload Form -->
                <form action="{{ route('database.restore') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    
                    <!-- File Upload -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <div class="mt-4 flex text-sm justify-center">
                                <label for="file-upload" class="relative cursor-pointer bg-blue-500 rounded-md font-medium text-white px-4 py-2 hover:bg-blue-600 focus:outline-none">
                                    <span>Select Backup File</span>
                                    <input id="file-upload" name="backup_file" type="file" class="sr-only" accept=".sql,.zip,.json">
                                </label>
                            </div>
                            <p class="text-sm text-gray-500 mt-2" id="file-name">No file selected</p>
                            <p class="text-xs text-gray-500 mt-1">Supported formats: .sql, .zip (for CSV files), .json</p>
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-800 mb-3">Restore Options</h3>
                        <div class="space-y-3">
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" name="clear_tables" class="form-checkbox text-blue-600">
                                <span class="text-gray-700">Clear existing tables before restore</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" name="ignore_errors" class="form-checkbox text-blue-600">
                                <span class="text-gray-700">Continue on error</span>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-md transition-colors duration-150 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0l-4 4m4-4v12"/>
                            </svg>
                            Restore Database
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('file-upload').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'No file selected';
        document.getElementById('file-name').textContent = fileName;
    });
</script>
@endsection
