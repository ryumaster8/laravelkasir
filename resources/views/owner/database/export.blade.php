@extends('layouts_dashboard_owner.layout_owner')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Database Backup</h2>
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Export Configuration Form -->
            <form action="{{ route('database.export.generate') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Export Method -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-800 mb-3">Export Method</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="export_method" value="quick" checked class="form-radio text-blue-600">
                            <span class="text-gray-700">Quick - Same as phpMyAdmin default export</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="export_method" value="custom" class="form-radio text-blue-600">
                            <span class="text-gray-700">Custom - configure export settings</span>
                        </label>
                    </div>
                </div>

                <!-- Format -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-800 mb-3">Export Format</h3>
                    <div class="grid grid-cols-1 gap-4">
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="format" value="sql" checked class="form-radio text-blue-600">
                            <span class="text-gray-700">SQL</span>
                        </label>
                    </div>
                </div>

                <!-- Output -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-800 mb-3">Output</h3>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600">The export will be saved as: laravel_kasir_[date&time].sql</p>
                    </div>
                </div>

                <!-- Options (shown only for custom export) -->
                <div id="customOptions" class="bg-gray-50 p-4 rounded-lg hidden">
                    <!-- Options -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-800 mb-3">Options</h3>
                        <div class="space-y-3">
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" name="add_drop_table" checked class="form-checkbox text-blue-600">
                                <span class="text-gray-700">Add DROP TABLE statements</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" name="add_create_table" checked class="form-checkbox text-blue-600">
                                <span class="text-gray-700">Add CREATE TABLE statements</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" name="add_data" checked class="form-checkbox text-blue-600">
                                <span class="text-gray-700">Include data</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Generate Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md transition-colors duration-150 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Export Database
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAll');
        const tableCheckboxes = document.querySelectorAll('.table-checkbox');
        
        selectAll.addEventListener('change', function() {
            tableCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        tableCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const allChecked = Array.from(tableCheckboxes).every(c => c.checked);
                selectAll.checked = allChecked;
            });
        });

        // Show/hide options based on export method
        const exportMethod = document.querySelectorAll('input[name="export_method"]');
        const customOptions = document.getElementById('customOptions');

        exportMethod.forEach(radio => {
            radio.addEventListener('change', function() {
                customOptions.classList.toggle('hidden', this.value === 'quick');
            });
        });
    });
</script>
@endsection
