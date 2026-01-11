<x-app-layout>
    <div x-data="{
        openCreate: false,
        openEdit: false,
        editData: {}
    }" class="p-4">

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Kelola Menu</h1>
            <p class="text-sm text-gray-500">Manajemen menu makanan & minuman</p>
        </div>

        {{-- TOOLBAR --}}
        <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <form method="GET" class="flex w-full md:w-2/3 gap-3">
                {{-- SEARCH --}}
                <div class="relative w-full">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari menu..."
                        class="w-full rounded-lg border-gray-300 pl-10 text-sm focus:border-gray-900 focus:ring-gray-900">
                    <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M16.65 10.5A6.15 6.15 0 1 1 4.35 10.5a6.15 6.15 0 0 1 12.3 0z" />
                    </svg>
                </div>

                {{-- FILTER KATEGORI --}}
                <select name="kategori" onchange="this.form.submit()"
                    class="w-56 rounded-lg border-gray-300 text-sm focus:border-gray-900 focus:ring-gray-900">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategoris as $k)
                        <option value="{{ $k->id }}" {{ request('kategori') == $k->id ? 'selected' : '' }}>
                            {{ $k->kategori }}
                        </option>
                    @endforeach
                </select>
            </form>

            {{-- TAMBAH --}}
            <button @click="openCreate=true"
                class="rounded-lg bg-gray-900 px-4 py-2 text-sm text-white hover:bg-gray-800">
                + Tambah Menu
            </button>
        </div>

        {{-- TABLE --}}
        <div class="overflow-hidden rounded-xl bg-white shadow ring-1 ring-gray-200">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left">Menu</th>
                        <th class="px-4 py-3 text-center">Kategori</th>
                        <th class="px-4 py-3 text-center">Harga</th>
                        <th class="px-4 py-3 text-center">Stok</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($produks as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 flex items-center gap-3">
                            <img src="{{ Storage::url($p->gambar) }}"
     class="h-10 w-10 rounded-lg object-cover">

                                <div>
                                    <div class="font-medium text-gray-900">
                                        {{ $p->nama_produk }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ Str::limit($p->deskripsi, 40) }}
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-center">
                                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs">
                                    {{ $p->kategori->kategori ?? '-' }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-center font-medium">
                                Rp {{ number_format($p->harga, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                {{ $p->stok }}
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <button @click="openEdit=true; editData={{ $p }}"
                                        class="rounded-lg bg-gray-100 px-3 py-1 text-xs hover:bg-gray-200">
                                        Edit
                                    </button>

                                    <form method="POST" action="{{ route('produk.destroy', $p->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Hapus menu ini?')"
                                            class="rounded-lg bg-red-50 px-3 py-1 text-xs text-red-600 hover:bg-red-100">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                Menu tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-6">
            {{ $produks->links() }}
        </div>

        {{-- ================= MODAL CREATE ================= --}}
        {{-- <div x-cloak x-show="openCreate" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
            <div @click.away="openCreate=false" class="w-full max-w-lg rounded-xl bg-white p-6">

                <h2 class="mb-4 text-lg font-semibold">Tambah Menu</h2>

                <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    <input name="nama_produk" placeholder="Nama Menu" class="w-full rounded-lg border-gray-300">

                    <textarea name="deskripsi" rows="3" class="w-full rounded-lg border-gray-300" placeholder="Deskripsi"></textarea>

                    <div class="grid grid-cols-2 gap-3">
                        <input type="number" name="harga" placeholder="Harga" class="rounded-lg border-gray-300">
                        <input type="number" name="stok" placeholder="Stok" class="rounded-lg border-gray-300">
                    </div>

                    <select name="kategori_id" class="w-full rounded-lg border-gray-300">
                        @foreach ($kategoris as $k)
                            <option value="{{ $k->id }}">
                                {{ $k->kategori }}
                            </option>
                        @endforeach
                    </select>

                    <input type="file" name="gambar" class="w-full rounded-lg border-gray-300">

                    <div class="flex justify-end gap-2 pt-4">
                        <button type="button" @click="openCreate=false" class="text-sm text-gray-500">
                            Batal
                        </button>
                        <button class="rounded-lg bg-gray-900 px-4 py-2 text-sm text-white">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div> --}}
        @include('pengguna.owner.Kelola_Menu.edit')
        @include('pengguna.owner.Kelola_Menu.create')
    </div>


</x-app-layout>
