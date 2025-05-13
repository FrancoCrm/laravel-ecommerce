<x-app-layout>


    <!-- Sidebar -->
    <x-sidebar-menu />

    <!-- Konten Utama -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <h1 class="text-2xl font-bold mb-4">Tambah Produk</h1>
                       <div class="py-10 max-w-4xl mx-auto">
        <div class="bg-white shadow p-6 rounded-lg">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700">Nama Produk</label>
                    <input type="text" name="name" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Kategori</label>
                    <select name="category_id" class="w-full border p-2 rounded" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Deskripsi</label>
                    <textarea name="description" class="w-full border p-2 rounded" rows="3"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Harga</label>
                    <input type="number" name="price" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Gambar</label>
                    <input type="file" name="image" class="w-full border p-2 rounded">
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Simpan
                    </button>
                    <a href="{{ route('dashboard') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
                </div>
            </form>
        </div>
    </div>
                    </div>
                </div>
            </div>

</x-app-layout>
