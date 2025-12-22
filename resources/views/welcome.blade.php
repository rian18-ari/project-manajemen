<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes Project - Organize Your Life</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Custom animations */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>

<body class="antialiased bg-gray-50 text-gray-800 selection:bg-indigo-500 selection:text-white">

    <!-- Navigation -->
    <nav x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="{ 'bg-white/90 backdrop-blur-md shadow-sm py-4': scrolled, 'bg-transparent py-6': !scrolled }"
        class="fixed w-full z-50 transition-all duration-300 top-0 start-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="#" class="flex items-center gap-2">
                        <div class="bg-indigo-600 text-white p-1.5 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <span class="font-bold text-xl tracking-tight text-gray-900">NotesPro</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features"
                        class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors">Features</a>
                    <a href="#testimonials"
                        class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors">Testimonials</a>
                    <a href="#pricing"
                        class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors">Pricing</a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('main') }}"
                                class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-full transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">Get
                                    Started</a>
                            @endif
                        @endauth
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                        class="text-gray-500 hover:text-gray-600 focus:outline-none p-2 rounded-md">
                        <svg class="h-6 w-6" x-show="!mobileMenuOpen" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="h-6 w-6" x-cloak x-show="mobileMenuOpen" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-cloak x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden bg-white border-t border-gray-100 shadow-lg absolute w-full left-0">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="#features" @click="mobileMenuOpen = false"
                    class="block px-3 py-3 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-md">Features</a>
                <a href="#testimonials" @click="mobileMenuOpen = false"
                    class="block px-3 py-3 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-md">Testimonials</a>
                <a href="#pricing" @click="mobileMenuOpen = false"
                    class="block px-3 py-3 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-md">Pricing</a>

                <div class="border-t border-gray-100 my-2 pt-2">
                    @auth
                        <a href="{{ route('main') }}"
                            class="block w-full text-center px-4 py-3 text-base font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">Go
                            to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="block px-3 py-3 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-md">Log
                            in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="block w-full text-center mt-2 px-4 py-3 text-base font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">Sign
                                Up Free</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-indigo-50 blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-blue-50 blur-3xl opacity-50"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="lg:grid lg:grid-cols-12 lg:gap-16 items-center">
                <div class="lg:col-span-6 text-center lg:text-left" x-data
                    x-intersect="$el.classList.add('opacity-100', 'translate-y-0'); $el.classList.remove('opacity-0', 'translate-y-10')"
                    class="opacity-0 translate-y-10 transition-all duration-1000 ease-out">

                    <span
                        class="inline-block py-1 px-3 rounded-full bg-indigo-100 text-indigo-700 text-sm font-semibold mb-6">
                        New Version 2.0 Available
                    </span>
                    <h1
                        class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 tracking-tight leading-tight mb-6">
                        Master Your Day with <span class="text-indigo-600">NotesPro</span>
                    </h1>
                    <p class="text-lg sm:text-xl text-gray-600 mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Capture ideas, manage projects, and collaborate effortlessly. The all-in-one workspace designed
                        for creative minds and productive teams.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}"
                            class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white bg-indigo-600 rounded-full hover:bg-indigo-700 transition-all shadow-lg hover:shadow-indigo-500/30 transform hover:-translate-y-1">
                            Start for Free
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                        <a href="#features"
                            class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-gray-700 bg-white border border-gray-200 rounded-full hover:bg-gray-50 hover:border-gray-300 transition-all shadow-sm">
                            Learn More
                        </a>
                    </div>

                    <!-- Social Proof -->
                    <div
                        class="mt-10 pt-8 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-6">
                        <div class="flex -space-x-3">
                            <img class="w-10 h-10 rounded-full border-2 border-white"
                                src="https://ui-avatars.com/api/?name=Alex&background=random" alt="User">
                            <img class="w-10 h-10 rounded-full border-2 border-white"
                                src="https://ui-avatars.com/api/?name=Sarah&background=random" alt="User">
                            <img class="w-10 h-10 rounded-full border-2 border-white"
                                src="https://ui-avatars.com/api/?name=Mike&background=random" alt="User">
                            <div
                                class="w-10 h-10 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-600">
                                +2k</div>
                        </div>
                        <div class="text-sm text-gray-500">
                            Trusted by <span class="font-bold text-gray-900">2,000+</span> productivity enthusiasts.
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6 mt-16 lg:mt-0 relative hidden lg:block" x-data
                    x-intersect="$el.classList.add('opacity-100', 'translate-x-0'); $el.classList.remove('opacity-0', 'translate-x-10')"
                    class="opacity-0 translate-x-10 transition-all duration-1000 delay-300 ease-out">
                    <div class="relative rounded-2xl bg-white shadow-2xl border border-gray-100 p-2 animate-float">
                        <div
                            class="absolute inset-0 bg-gradient-to-tr from-indigo-600 to-purple-600 rounded-2xl opacity-10 blur-xl -z-10">
                        </div>
                        <img src="https://images.unsplash.com/photo-1481487484168-9b930d55208d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Dashboard Preview" class="rounded-xl w-full shadow-inner">

                        <!-- Floating Card 1 -->
                        <div class="absolute -left-12 top-1/4 bg-white p-4 rounded-xl shadow-xl border border-gray-50 max-w-xs animate-bounce"
                            style="animation-duration: 4s;">
                            <div class="flex items-center gap-3">
                                <div class="bg-green-100 p-2 rounded-lg text-green-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-800">Project Completed</div>
                                    <div class="text-xs text-gray-500">Just now</div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Card 2 -->
                        <div class="absolute -right-8 bottom-1/4 bg-white p-4 rounded-xl shadow-xl border border-gray-50 max-w-xs animate-bounce"
                            style="animation-duration: 5s; animation-delay: 1s;">
                            <div class="flex items-center gap-3">
                                <div class="bg-indigo-100 p-2 rounded-lg text-indigo-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-800">Meeting in 15m</div>
                                    <div class="text-xs text-gray-500">Video conference</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-indigo-600 font-semibold tracking-wide uppercase text-sm mb-3">Features</h2>
                <h3 class="text-3xl font-extrabold text-gray-900 sm:text-4xl mb-4">Everything you need to stay
                    organized</h3>
                <p class="text-xl text-gray-500">Simple enough for a quick note, powerful enough for your life's work.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false"
                    class="p-8 bg-gray-50 rounded-2xl hover:bg-indigo-50 transition-colors duration-300">
                    <div
                        class="w-12 h-12 bg-white rounded-xl shadow-md flex items-center justify-center text-indigo-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Rich Text Editor</h4>
                    <p class="text-gray-600 leading-relaxed">Write expressively with our powerful editor. Markdown
                        support included for power users.</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 bg-gray-50 rounded-2xl hover:bg-indigo-50 transition-colors duration-300">
                    <div
                        class="w-12 h-12 bg-white rounded-xl shadow-md flex items-center justify-center text-indigo-600 mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Task Management</h4>
                    <p class="text-gray-600 leading-relaxed">Turn your notes into actionable tasks. track progress with
                        Kanban boards.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 bg-gray-50 rounded-2xl hover:bg-indigo-50 transition-colors duration-300">
                    <div
                        class="w-12 h-12 bg-white rounded-xl shadow-md flex items-center justify-center text-indigo-600 mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Secure & Private</h4>
                    <p class="text-gray-600 leading-relaxed">Your data is encrypted end-to-end. We value your privacy
                        above everything else.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-indigo-900 text-white relative overflow-hidden">
        <!-- Decoration -->
        <div
            class="absolute top-0 right-0 w-64 h-64 bg-indigo-800 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
        </div>
        <div
            class="absolute bottom-0 left-0 w-64 h-64 bg-purple-800 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div x-data="{ count: 0 }" x-intersect="count = 150" class="p-4">
                    <div class="text-4xl lg:text-5xl font-bold mb-2 flex justify-center">
                        <span x-text="count">0</span><span>k+</span>
                    </div>
                    <div class="text-indigo-200 uppercase tracking-widest text-xs">Active Users</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl lg:text-5xl font-bold mb-2">5m+</div>
                    <div class="text-indigo-200 uppercase tracking-widest text-xs">Notes Created</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl lg:text-5xl font-bold mb-2">99%</div>
                    <div class="text-indigo-200 uppercase tracking-widest text-xs">Uptime</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl lg:text-5xl font-bold mb-2">4.9</div>
                    <div class="text-indigo-200 uppercase tracking-widest text-xs">App Store Rating</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-white relative">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl mb-6">Ready to get your life in order?</h2>
            <p class="text-xl text-gray-500 mb-10">Join thousands of others who have switched to NotesPro. Start your
                14-day free trial today.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}"
                    class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white bg-indigo-600 rounded-full hover:bg-indigo-700 transition-all shadow-lg hover:shadow-indigo-500/30">
                    Get Started Now
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-800 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-8">
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-indigo-600 text-white p-1 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <span class="font-bold text-lg text-white">NotesPro</span>
                    </div>
                    <p class="text-sm text-gray-400">Making the world more productive, one note at a time.</p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4 uppercase text-xs tracking-wider">Product</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Features</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Download</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4 uppercase text-xs tracking-wider">Company</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">About</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Careers</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4 uppercase text-xs tracking-wider">Legal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Privacy</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Terms</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Security</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-gray-500">&copy; {{ date('Y') }} NotesPro. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <!-- Social icons -->
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Alpine Intersect Plugin -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</body>

</html>
