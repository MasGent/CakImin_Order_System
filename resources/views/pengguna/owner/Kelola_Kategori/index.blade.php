<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-6">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Sistem Pengelolaan Kategori Warkop Cak Imin
                </h2>
                <p class="text-sm text-gray-500">
                    Kelola kategori produk untuk memudahkan pengelompokan menu.
                </p>
            </div>

            <a href="{{ route('kategori.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kategori
            </a>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div
                class="mb-4 flex items-center gap-2 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                <span class="font-semibold">✔</span>
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="overflow-hidden rounded-xl bg-white shadow">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-500 uppercase">No</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-500 uppercase">Nama Kategori</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-500 uppercase">Jumlah Produk</th>
                            <th class="px-6 py-3 text-center font-semibold text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($kategoris as $key => $k)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-semibold text-gray-500">
                                    {{ $kategoris->firstItem() + $key }}
                                </td>

                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ $k->kategori }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($k->produk_count > 0)
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-indigo-100 px-3 py-1 text-indigo-700 text-xs font-semibold">
                                            📦 {{ $k->produk_count }} Menu
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-gray-500 text-xs">
                                            Kosong
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        {{-- Edit --}}
                                        <a href="{{ route('kategori.edit', $k->id) }}"
                                            class="px-3 py-1.5 text-xs font-semibold rounded-full border border-yellow-300 text-yellow-700 hover:bg-yellow-50 transition">
                                            ✏ Edit
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('kategori.destroy', $k->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus kategori ini? Produk terkait bisa terpengaruh.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1.5 text-xs font-semibold rounded-full border border-red-300 text-red-700 hover:bg-red-50 transition">
                                                🗑 Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                    <div class="text-3xl mb-2">🏷</div>
                                    Belum ada kategori yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $kategoris->links() }}
        </div>

    </div>
</x-app-layout>
