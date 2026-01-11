<div x-cloak x-show="openEdit" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
    <div @click.away="openEdit=false" class="w-full max-w-lg rounded-xl bg-white p-6">

        <h2 class="mb-4 text-lg font-semibold">Edit Menu</h2>

        <form :action="`/produk/${editData.id}`" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <input x-model="editData.nama_produk" name="nama_produk" class="w-full rounded-lg border-gray-300">

            <textarea x-model="editData.deskripsi" name="deskripsi" class="w-full rounded-lg border-gray-300"></textarea>

            <div class="grid grid-cols-2 gap-3">
                <input type="number" x-model="editData.harga" name="harga" class="rounded-lg border-gray-300">
                <input type="number" x-model="editData.stok" name="stok" class="rounded-lg border-gray-300">
            </div>

            <select x-model="editData.kategori" name="kategori_id" class="w-full rounded-lg border-gray-300">
                @foreach ($kategoris as $k)
                    <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                @endforeach
            </select>

            <input type="file" name="gambar" class="w-full rounded-lg border-gray-300">

            <div class="flex justify-end gap-4 pt-4">
                <button type="button" @click="openEdit=false" class="text-sm text-gray-500">Batal</button>
                <button class="rounded-lg bg-gray-900 px-4 py-2 text-sm text-white">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
