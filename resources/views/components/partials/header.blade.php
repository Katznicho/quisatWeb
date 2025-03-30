<header class="bg-white shadow-sm">
    <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-2">
                    <img src="{{ asset('assets/images/logo.jpeg') }}" alt="Quisat Logo" class="h-10 w-auto">
                    <span class="text-2xl font-bold text-[#00295F]">Quisat</span>
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="text-gray-600 hover:text-[#00295F]" onclick="toggleMobileMenu()">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#features" class="text-gray-600 hover:text-[#00295F]">Features</a>
                <a href="#business" class="text-gray-600 hover:text-[#00295F]">Business</a>
                <a href="#schools" class="text-gray-600 hover:text-[#00295F]">Schools</a>
                <a href="#parents" class="text-gray-600 hover:text-[#00295F]">Parents</a>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <a href="#" class="bg-[#00295F] text-white px-6 py-2 rounded-md hover:bg-[#00295F]/90">Dashboard</a>
                @else
                    <a href="#" class="text-gray-600 hover:text-[#00295F]">Login</a>
                    @if (Route::has('register'))
                        <a href="#" class="bg-[#00295F] text-white px-6 py-2 rounded-md hover:bg-[#00295F]/90">Get Started</a>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobileMenu" class="hidden md:hidden mt-4">
            <div class="flex flex-col space-y-4 pt-4 border-t border-gray-200">
                <a href="#features" class="text-gray-600 hover:text-[#00295F]">Features</a>
                <a href="#business" class="text-gray-600 hover:text-[#00295F]">Business</a>
                <a href="#schools" class="text-gray-600 hover:text-[#00295F]">Schools</a>
                <a href="#parents" class="text-gray-600 hover:text-[#00295F]">Parents</a>
                @auth
                    <a href="#" class="bg-[#00295F] text-white px-6 py-2 rounded-md hover:bg-[#00295F]/90 text-center">Dashboard</a>
                @else
                    <a href="#" class="text-gray-600 hover:text-[#00295F] text-center">Login</a>
                    @if (Route::has('register'))
                        <a href="#" class="bg-[#00295F] text-white px-6 py-2 rounded-md hover:bg-[#00295F]/90 text-center">Get Started</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>
</header>

<script>
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');
    }
</script>