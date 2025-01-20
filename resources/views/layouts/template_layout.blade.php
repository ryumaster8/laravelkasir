<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Aplikasi Saya')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <div class="h-screen overflow-hidden grid grid-cols-[auto_1fr]">
        <!-- Sidebar -->
        <aside id="sidebar" class="h-full w-64 bg-red-600 text-white border-r border-gray-600 flex flex-col">
            @include('sidebar.template_sidebar')
        </aside>

        <!-- Main content -->
        <main class="flex flex-col">
            <!-- Header -->
            <div id="dashboard-header" class="flex p-4">
                @yield('dashboard-header')
            </div>

             <!-- Content -->
            <div class="flex-1 overflow-y-auto p-4">
                <div class="w-full max-w-4xl">
                    @yield('content')
                </div>
            </div>
       </main>
    </div>
    @stack('scripts')
      <script>
        document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('menuSearch');
        const menuList = document.getElementById('menuList');
        const menuItems = menuList.querySelectorAll('h3, ul li');
        const subMenuItems = menuList.querySelectorAll('.has-sub-menu')

        searchInput.addEventListener('input', function () {
              const searchTerm = searchInput.value.toLowerCase();
            
                menuItems.forEach(item => {
                  const text = item.textContent.toLowerCase();
                     if (text.includes(searchTerm)) {
                         item.style.display = '';
                     } else {
                         item.style.display = 'none';
                     }
                 });
            });

           subMenuItems.forEach( item => {
            item.addEventListener('click', function() {
                const subMenu = item.nextElementSibling;
                if(subMenu.classList.contains('hidden')){
                     subMenu.classList.remove('hidden')
                }else{
                     subMenu.classList.add('hidden')
                }
               
            })
           })
      });
    </script>
</body>
</html>