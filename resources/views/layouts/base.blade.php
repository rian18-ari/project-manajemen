<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-secondary-gray font-sans antialiased min-h-screen flex">

    <!-- Sidebar / Navigation -->
    <aside id="sidebar"
        class="fixed w-16 inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out bg-gray-800 text-white flex flex-col z-40 shadow-xl overflow-y-auto">

        <!-- Navigation Links -->
        <nav class="flex flex-col gap-10 px-4 py-6 space-y-2">
            <a wire:navigate href="{{ route('main') }}"
                class="nav-link {{ request()->routeIs('main') ? 'active text-gray-600' : '' }}">
                <i class="fa-solid fa-house"></i>
            </a>
            <a wire:navigate href="{{ route('project') }}"
                class="nav-link {{ request()->routeIs('project') ? 'active text-gray-600' : '' }}">
                <i class="fa-regular fa-circle-check"></i>
            </a>
            <a href="#">
                <i class="fa-solid fa-gear"></i>
            </a>
        </nav>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 p-4 lg:p-8 lg:ml-17">
        <!-- Top Bar / Header -->
        <header
            class="flex justify-between items-center py-4 px-6 bg-white shadow-md rounded-xl mb-8 border-2 border-gray-300">
            <!-- Mobile Menu Toggle Button -->
            <button id="sidebar-toggle"
                class="lg:hidden p-2 bg-primary-blue text-indigo-500 rounded-md transition duration-150 ease-in-out hover:bg-indigo-700 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>
            <h1 class="text-3xl font-extrabold text-gray-800">@yield('title')</h1>
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-gray-500 hidden sm:inline">Welcome back, {{ Auth::user()->name }}!</span>
                @endauth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" wire:loading.attr="disabled"
                        class="p-2 text-gray-500 hover:text-primary-blue rounded-full transition duration-150 hover:bg-gray-100 disabled:opacity-50">
                        <i class="fa-solid fa-arrow-right-from-bracket hover:text-red-500" wire:loading.remove></i>
                        <span wire:loading><i class="fa-solid fa-spinner fa-spin"></i></span> </button>
                </form>
            </div>
        </header>

        @yield('content')

        <!-- Footer -->
        <footer class="mt-8 pt-4 border-t border-gray-300 text-center text-sm text-gray-500">
            &copy; 2025 Project Dashboard. All rights reserved.
        </footer>
    </main>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Konfigurasi Tailwind (Dipindahkan ke sini karena tag <script> di <head> dihapus)
            // Ini hanya untuk referensi jika ada custom color/font, tapi tidak akan berfungsi
            // tanpa memuat CDN/kompilasi Tailwind secara eksternal.
            const tailwindConfig = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                        },
                        colors: {
                            'primary-blue': '#4F46E5', // Indigo 600
                            'secondary-gray': '#F9FAFB', // Gray 50
                        },
                    },
                    // Karena custom-scroll CSS dihapus, kita tidak perlu memanggilnya lagi
                }
            };

            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('sidebar-toggle');
            const mainContent = document.querySelector('main');

            // Fungsi untuk mengontrol visibilitas sidebar berdasarkan ukuran layar
            function checkScreenSize() {
                if (window.innerWidth >= 1024) { // Desktop (lg breakpoint)
                    // Pastikan sidebar terlihat di desktop
                    sidebar.classList.remove('transform', '-translate-x-full');
                    mainContent.classList.add('lg:ml-15');
                    mainContent.classList.remove('ml-0');
                    toggleButton.classList.add('hidden'); // Sembunyikan tombol di desktop
                    document.body.style.overflow = 'auto'; // Pastikan scroll normal di desktop
                } else { // Mobile/Tablet
                    // Sembunyikan tombol di mobile
                    if (!sidebar.classList.contains('transform')) {
                        sidebar.classList.add('transform', '-translate-x-full');
                    }
                    mainContent.classList.remove('lg:ml-64');
                    toggleButton.classList.remove('hidden'); // Tampilkan tombol di mobile
                    document.body.style.overflow = 'auto'; // Pastikan scroll normal saat tertutup
                }
            }

            // Toggle function untuk mobile
            toggleButton.addEventListener('click', function(event) {
                event.stopPropagation(); // Mencegah klik 'tembus' ke mainContent
                sidebar.classList.toggle('-translate-x-full');
            });

            // Close sidebar saat klik area main
            mainContent.addEventListener('click', function(event) {
                if (window.innerWidth < 1024 && !sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.add('-translate-x-full');
                    // Pastikan tombol muncul lagi jika tadi sempat kamu sembunyikan
                    toggleButton.classList.remove('hidden');
                }
            });

            // Close sidebar saat mengklik area main content di mobile
            mainContent.addEventListener('click', function(event) {
                if (window.innerWidth < 1024 && !sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.add('-translate-x-full');
                    document.body.style.overflow = 'auto';
                    toggleButton.classList.remove('hidden');
                }
            });

            // Pada dasarnya, logika JavaScript ini sekarang lebih mengandalkan
            // kelas-kelas Tailwind yang ada di markup HTML.
        });
    </script>

    @if (session('swal'))
        <script>
            Swal.fire(@json(session('swal')));
        </script>
    @endif


    @include('sweetalert2::index')
</body>

</html>
