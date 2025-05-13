<div x-data="{ open: false }">
    <!-- Toggle Button (Mobile) -->
    <button @click="open = !open" class="p-4 lg:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Sidebar (Fixed & Full Height) -->
    <aside
        :class="{ 'block': open, 'hidden': !open }"
        class="fixed top-0 left-0 h-screen w-64 bg-white border-r border-gray-200 hidden lg:block z-20"
    >
        <div class="p-4 pt-20"> {{-- pt-20 untuk beri ruang header --}}
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Dashboard</a>
                <a href="{{ route('dashboard.products') }}" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Products</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Categories</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Users</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Logout</a>
            </nav>
        </div>
    </aside>
</div>
