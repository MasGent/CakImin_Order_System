<div x-cloak x-show="openCreate" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
    <div @click.away="openCreate=false" class="w-full max-w-lg rounded-xl bg-white p-6">

        <h2 class="mb-4 text-lg font-semibold">Tambah Menu</h2>

        <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <input name="nama_produk" placeholder="Nama Menu" class="w-full rounded-lg border-gray-300">

            <textarea name="deskripsi" rows="3" class="w-full rounded-lg border-gray-300" placeholder="Deskripsi"></textarea>

            <div class="grid grid-cols-2 gap-3">
                <input type="number" name="harga" placeholder="Harga" class="rounded-lg border-gray-300">
                <input type="number" name="stok" placeholder="Stok" class="rounded-lg border-gray-300">
            </div>

            <select name="kategori_id" required class="w-full rounded-lg border-gray-300">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $k)
                    <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                @endforeach
            </select>


            <input type="file" name="gambar" class="w-full rounded-lg border-gray-300">

            <div class="flex justify-end gap-4 pt-4">
                <button type="button" @click="openCreate=false" class="text-sm text-gray-500">Batal</button>
                <button class="rounded-lg bg-gray-900 px-4 py-2 text-sm text-white">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
