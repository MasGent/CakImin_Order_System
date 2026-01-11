<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-6">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Manajemen Stok Menu (Dapur)
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Tambahkan stok menu yang tersedia hari ini.
            </p>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600">
                            Menu
                        </th>
                        <th class="px-6 py-3 text-center font-semibold text-gray-600">
                            Kategori
                        </th>
                        <th class="px-6 py-3 text-center font-semibold text-gray-600">
                            Stok Saat Ini
                        </th>
                        <th class="px-6 py-3 text-center font-semibold text-gray-600">
                            Tambah Stok
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($produks as $p)
                        <tr class="hover:bg-gray-50">
                            {{-- Nama menu --}}
                            <td class="px-6 py-4 font-semibold text-gray-800">
                                {{ $p->nama_produk }}
                            </td>

                            {{-- Kategori --}}
                            <td class="px-6 py-4 text-center text-gray-600">
                                {{ $p->kategori->kategori ?? '-' }}
                            </td>

                            {{-- Stok --}}
                            <td class="px-6 py-4 text-center">
                                @if ($p->stok == 0)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-600">
                                        Habis
                                    </span>
                                @else
                                    <span class="font-bold text-gray-800">
                                        {{ $p->stok }}
                                    </span>
                                @endif
                            </td>

                            {{-- Tambah stok --}}
                            <td class="px-6 py-4">
                                <form
                                    action="{{ route('dapur.stok.tambah', $p->id) }}"
                                    method="POST"
                                    class="flex justify-center gap-2"
                                >
                                    @csrf
                                    <input
                                        type="number"
                                        name="stok_tambah"
                                        min="1"
                                        required
                                        class="w-24 rounded-lg border-gray-300 text-sm focus:border-gray-800 focus:ring-gray-800"
                                        placeholder="+ stok"
                                    >
                                    <button
                                        type="submit"
                                        class="rounded-lg bg-green-600 px-4 py-2 text-white text-sm font-semibold hover:bg-green-700 transition"
                                    >
                                        Tambah
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                Tidak ada menu tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
