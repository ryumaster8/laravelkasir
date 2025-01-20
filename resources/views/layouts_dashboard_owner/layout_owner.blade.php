<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Kustomisasi DataTables */
        /* .dataTables_wrapper .dataTables_length select {
            padding-right: 2rem;
            padding-left: 0.75rem;
            border-radius: 0.375rem;
            border-color: #E5E7EB;
        }
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 0.375rem;
            border: 1px solid #E5E7EB;
            padding: 0.5rem;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #1E40AF !important;
            color: white !important;
            border: none !important;
            border-radius: 0.375rem;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #2563EB !important;
            color: white !important;
            border: none !important;
        } */
        /* Tambahkan style untuk animasi sidebar */
        aside {
            transition: all 0.3s ease-in-out;
            transform: translateX(0);
        }
        
        aside.hidden-sidebar {
            transform: translateX(-100%);
        }
        
        main {
            transition: all 0.3s ease-in-out;
            margin-left: 16rem; /* 256px atau w-64 */
            padding: 1rem !important; /* Override padding default */
        }
        
        main.expanded {
            margin-left: 0;
        }

        /* Tambahan style untuk container tabel */
        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }

        /* Update style DataTables */
        .dataTables_wrapper {
            width: 100%;
            max-width: 100%;
        }

        /* Update style untuk container dan tabel */
        .content-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header-content {
            padding: 0.75rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            border-bottom: 1px solid #e5e7eb;
        }

        .card-content {
            flex: 1;
            margin: 0;
            background-color: white;
        }

        .table-container {
            width: 100%;
            margin: 0 auto;
            padding: 1.5rem;
        }

        /* Update DataTables wrapper style */
        .dataTables_wrapper {
            width: 100%;
        }

        /* Menghapus padding yang tidak perlu */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            padding: 0.5rem 0;
        }

        /* Memperbesar ukuran font tabel */
        #dataTable {
            font-size: 1rem;
        }

        #dataTable thead th {
            padding: 1rem;
            font-size: 0.875rem;
        }

        #dataTable tbody td {
            padding: 1rem;
        }

        /* Style untuk toggle button */
        .toggle-button {
            position: fixed;
            right: 1.5rem;
            top: 0.75rem;
            z-index: 50;
        }

        /* Update style untuk sidebar */
        aside {
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 40;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 1rem;
            background-color: #1F2937;
            border-bottom: 1px solid #374151;
        }

        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #4B5563 #1F2937;
        }

        /* Styling untuk scrollbar Chrome/Safari/Edge */
        .sidebar-content::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-content::-webkit-scrollbar-track {
            background: #1F2937;
        }

        .sidebar-content::-webkit-scrollbar-thumb {
            background-color: #4B5563;
            border-radius: 3px;
        }

        .sidebar-content::-webkit-scrollbar-thumb:hover {
            background-color: #6B7280;
        }

        /* Mengatur konten utama */
        .main-container {
            margin-left: 16rem;
            width: calc(100% - 16rem);
            transition: all 0.3s ease-in-out;
        }

        .main-container.expanded {
            margin-left: 0;
            width: 100%;
        }

        /* Responsivitas untuk mobile dan tablet */
        @media (max-width: 768px) {
            aside {
                transform: translateX(-100%);
                position: fixed;
                z-index: 50;
                width: 100%;
                max-width: 280px;
            }

            aside.show-sidebar {
                transform: translateX(0);
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }

            .sidebar-overlay.show {
                display: block;
            }

            main {
                margin-left: 0 !important;
                width: 100% !important;
                padding: 0.5rem !important;
            }

            .toggle-button {
                display: block;
                position: static;
                margin-left: auto;
            }

            .header-content {
                padding: 0.75rem 1rem;
            }

            /* Responsif DataTables */
            .dataTables_wrapper {
                padding: 0.5rem;
                overflow-x: auto;
            }

            .dataTables_length,
            .dataTables_filter {
                width: 100%;
                margin-bottom: 0.5rem;
                text-align: left;
            }

            /* Card content responsif */
            .card-content {
                padding: 0.5rem;
            }

            /* Tabel responsif */
            #dataTable {
                font-size: 0.875rem;
            }

            #dataTable thead th,
            #dataTable tbody td {
                padding: 0.5rem;
                white-space: nowrap;
            }
        }

        /* Tablet dan desktop kecil */
        @media (min-width: 769px) and (max-width: 1024px) {
            aside {
                width: 240px;
            }

            main {
                margin-left: 240px;
            }
        }

        /* Update style untuk tabel */
        .table-container {
            width: 100%;
            overflow: hidden; /* Menghilangkan scroll */
        }

        #dataTable {
            width: 100% !important;
            margin: 0 !important;
        }

        /* Mengatur lebar kolom */
        #dataTable th,
        #dataTable td {
            white-space: normal; /* Memungkinkan text wrap */
        }

        /* Mengatur lebar spesifik untuk setiap kolom */
        #dataTable th:nth-child(1),
        #dataTable td:nth-child(1) {
            width: 5% !important; /* No */
        }

        #dataTable th:nth-child(2),
        #dataTable td:nth-child(2) {
            width: 8% !important; /* ID */
        }

        #dataTable th:nth-child(3),
        #dataTable td:nth-child(3) {
            width: 20% !important; /* Nama */
        }

        #dataTable th:nth-child(4),
        #dataTable td:nth-child(4) {
            width: 25% !important; /* Email */
        }

        #dataTable th:nth-child(5),
        #dataTable td:nth-child(5) {
            width: 15% !important; /* Kota */
        }

        #dataTable th:nth-child(6),
        #dataTable td:nth-child(6) {
            width: 15% !important; /* Status */
        }

        #dataTable th:nth-child(7),
        #dataTable td:nth-child(7) {
            width: 12% !important; /* Aksi */
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        @include('partials.sidebar_owner')

         <!-- Toggle Button - Dipindahkan ke luar content -->
        <button id="toggleSidebar" class="fixed top-4 right-4 z-50 text-gray-600 hover:text-blue-600 bg-white p-2 rounded-lg shadow-md">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
            </svg>
        </button>
        
        <!-- Content -->
        <main class="flex-1 transition-all duration-300">
            @yield('content')
        </main>
    </div>

    <!-- Overlay untuk mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Tambahkan overlay untuk mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <script>
        // Inisialisasi Select2
        $(document).ready(function() {
            // Select2 biasa
            $('.select2').select2({
                theme: 'classic',
                width: '100%',
                placeholder: 'Pilih opsi...',
                allowClear: true
            });

            // Select2 multiple
            $('.select2-multiple').select2({
                theme: 'classic',
                width: '100%',
                placeholder: 'Pilih role...',
                allowClear: true,
                tags: true
            });
        });
                    

        // Update script untuk toggle menu
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk toggle submenu
            function setupSubmenus() {
                const menuItems = document.querySelectorAll('.menu-item > button');
                
                menuItems.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        // Toggle submenu
                        const submenu = this.nextElementSibling;
                        const arrow = this.querySelector('svg:last-child');
                        
                        if (submenu) {
                            submenu.classList.toggle('hidden');
                            if (arrow) {
                                arrow.classList.toggle('rotate-180');
                            }
                        }
                        
                        // Jika ini adalah submenu level 2 atau 3, jangan tutup submenu lainnya
                        const parentSubmenu = this.closest('.submenu');
                        if (parentSubmenu) {
                            return;
                        }
                        
                        // Tutup submenu lain pada level yang sama
                        const siblings = this.closest('ul').querySelectorAll('.menu-item > button');
                        siblings.forEach(sibling => {
                            if (sibling !== this) {
                                const siblingSubmenu = sibling.nextElementSibling;
                                const siblingArrow = sibling.querySelector('svg:last-child');
                                if (siblingSubmenu) {
                                    siblingSubmenu.classList.add('hidden');
                                }
                                if (siblingArrow) {
                                    siblingArrow.classList.remove('rotate-180');
                                }
                            }
                        });
                    });
                });
            }

            // Setup sidebar toggle
            const sidebar = document.querySelector('aside');
            const mainContent = document.querySelector('main');
            const overlay = document.querySelector('.sidebar-overlay');
            const toggleButton = document.getElementById('toggleSidebar');

            function toggleSidebar() {
                // Toggle class untuk sidebar
                sidebar.classList.toggle('hidden-sidebar');
                
                // Toggle class untuk main content
                mainContent.classList.toggle('expanded');
                
                // Toggle overlay hanya untuk tampilan mobile
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('show-sidebar');
                    overlay.classList.toggle('show');
                    document.body.classList.toggle('overflow-hidden');
                }
            }

            // Toggle button click handler
            toggleButton.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleSidebar();
            });

            // Overlay click handler (untuk mobile)
            overlay.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    toggleSidebar();
                }
            });

            // Close sidebar on window resize if in mobile view
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768 && sidebar.classList.contains('show-sidebar')) {
                    sidebar.classList.remove('show-sidebar');
                    overlay.classList.remove('show');
                    document.body.classList.remove('overflow-hidden');
                }
            });

            // Handle clicks outside sidebar (untuk mobile)
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && 
                    !sidebar.contains(e.target) && 
                    !toggleButton.contains(e.target) && 
                    sidebar.classList.contains('show-sidebar')) {
                    toggleSidebar();
                }
            });

            // Initialize submenu functionality
            setupSubmenus();
        });

        // Tambahkan script pencarian menu
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchMenu');
            const clearButton = document.getElementById('clearSearch');
            const menuItems = document.querySelectorAll('.menu-item');
            const allMenuLinks = document.querySelectorAll('nav a');
            const allMenuButtons = document.querySelectorAll('.menu-item > button');

            function showClearButton() {
                if (searchInput.value) {
                    clearButton.classList.remove('hidden');
                } else {
                    clearButton.classList.add('hidden');
                }
            }

            function resetSearch() {
                searchInput.value = '';
                clearButton.classList.add('hidden');
                menuItems.forEach(item => {
                    item.style.display = '';
                });
                allMenuLinks.forEach(link => {
                    link.style.display = '';
                });
                // Reset semua submenu ke keadaan tersembunyi
                document.querySelectorAll('.submenu').forEach(submenu => {
                    submenu.classList.add('hidden');
                });
                // Reset semua arrow ke keadaan normal
                document.querySelectorAll('.menu-item > button svg:last-child').forEach(arrow => {
                    arrow.classList.remove('rotate-180');
                });
            }

            function searchMenu() {
                const searchTerm = searchInput.value.toLowerCase();
                showClearButton();

                if (!searchTerm) {
                    resetSearch();
                    return;
                }

                menuItems.forEach(item => {
                    const button = item.querySelector('button');
                    const submenu = item.querySelector('.submenu');
                    const menuText = button ? button.textContent.toLowerCase() : '';
                    let found = false;

                    // Cek teks pada button menu
                    if (menuText.includes(searchTerm)) {
                        found = true;
                    }

                    // Cek teks pada submenu items
                    if (submenu) {
                        const submenuLinks = submenu.querySelectorAll('a');
                        submenuLinks.forEach(link => {
                            const linkText = link.textContent.toLowerCase();
                            if (linkText.includes(searchTerm)) {
                                found = true;
                                submenu.classList.remove('hidden');
                                if (button.querySelector('svg:last-child')) {
                                    button.querySelector('svg:last-child').classList.add('rotate-180');
                                }
                                link.style.display = '';
                            } else {
                                link.style.display = 'none';
                            }
                        });
                    }

                    item.style.display = found ? '' : 'none';
                });

                // Khusus untuk menu tanpa submenu (link langsung)
                allMenuLinks.forEach(link => {
                    if (!link.closest('.submenu')) {
                        const linkText = link.textContent.toLowerCase();
                        link.style.display = linkText.includes(searchTerm) ? '' : 'none';
                    }
                });
            }

            // Event listeners
            searchInput.addEventListener('input', searchMenu);
            clearButton.addEventListener('click', resetSearch);

            // Tambahkan event listener untuk keyboard shortcut (Esc)
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    resetSearch();
                    searchInput.blur();
                }
            });
        });
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    @stack('scripts')
</body>
</html>
