<x-app-layout>
    <x-sidebar-menu />

    <div class="lg:pl-64 pt-4">
        <div class="py-6 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mx-auto max-w-7xl shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Tambah Kategori</h1>
                    @include('dashboard.categories._form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
