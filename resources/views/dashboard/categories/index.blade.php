<x-app-layout>


    <!-- Sidebar -->
    <x-sidebar-menu />


    <div class="lg:pl-64 pt-4"> {{-- pl-64 = offset sidebar, pt-16 = offset navbar/header --}}
        <div class="py-4 mx-auto sm:px-6 lg:px-8">

            <!-- Konten Utama -->
            <div class="mt-4 py-4 mx-auto bg-white p-6 rounded shadow">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-800">Daftar Kategori</h2>
                    <a href="{{ route('dashboard.categories.create') }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                        + Tambah Kategori
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="max-w-full divide-y divide-gray-200 w-full border text-sm text-left text-gray-700">
                        <thead class="bg-gray-100 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">ID</th>
                                <th class="px-4 py-2 border">Nama Kategori</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 border">{{ $category->id }}</td>
                                    <td class="px-4 py-2 border capitalize">{{ $category->name }}</td>
                                    </td>

                                    <td class="px-4 py-2 border ">
                                        <div class="flex gap-2 justify-center mx-auto">

                                            <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="bg-orange-600 p-2 rounded-lg text-white">Edit</a>
                                            <form action="{{ route('dashboard.categories.delete', $category->id) }}" method="POST" class="inline-block"
                                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-red-600 p-2 rounded-lg text-white">Hapus</button>
                                            </form>

                                        </div>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-2 text-center text-gray-500">Tidak ada produk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-8 my-4">
                    {{ $categories->links() }}
                </div>
            </div>

        </div>
    </div>


</x-app-layout>
