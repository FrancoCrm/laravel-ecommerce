@props(['category' => null])

@php
    $isEdit = isset($category);
@endphp

<form action="{{ $isEdit ? route('dashboard.categories.update', $category->id) : route('dashboard.categories.store') }}"
    method="POST">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="mb-4">
        <label class="block text-gray-700">Nama Kategori</label>
        <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" class="w-full border p-2 rounded"
            required>
    </div>

    <div class="mt-6">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ $isEdit ? 'Update' : 'Simpan' }}
        </button>
        <a href="{{ route('dashboard.categories') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>
</form>
