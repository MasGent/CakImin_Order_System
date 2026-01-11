<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-6">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Edit Kategori
                </h2>
                <p class="text-sm text-gray-500">
                    Ubah nama kategori menu untuk menyesuaikan pengelompokan produk.
                </p>
            </div>

            <a href="{{ route('kategori.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                ← Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

            {{-- Form --}}
            <div class="md:col-span-6">
                <div class="bg-white rounded-xl shadow p-6">
                    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Nama Kategori --}}
                        <div>
                            <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-1">
                                Nama Kategori
                            </label>

                            <input
                                type="text"
                                name="kategori"
                                id="kategori"
                                value="{{ old('kategori', $kategori->kategori) }}"
                                placeholder="Misal: Minuman Dingin, Camilan, Mie, dll."
                                required
                                autofocus
                                class="w-full rounded-lg border px-4 py-2 text-sm
                                @error('kategori')
                                    border-red-500 focus:ring-red-500
                                @else
                                    border-gray-300 focus:ring-indigo-500
                                @enderror
                                focus:outline-none focus:ring-2">

                            {{-- Error --}}
                            @error('kategori')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                            {{-- Warning --}}
                            <div class="mt-2 flex items-start gap-2 text-sm text-amber-600">
                                <span>⚠</span>
                                <p>
                                    Mengubah nama kategori akan langsung memperbarui label
                                    pada semua produk terkait.
                                </p>
                            </div>
                        </div>

                        {{-- Action --}}
                        <div class="flex flex-wrap gap-3">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 transition shadow">
                                💾 Perbarui Kategori
                            </button>

                            <a href="{{ route('kategori.index') }}"
                                class="inline-flex items-center px-5 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm hover:bg-gray-200 transition">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Info --}}
            <div class="md:col-span-5 md:col-start-8">
                <div class="rounded-xl bg-gray-50 border border-gray-200 p-6">
                    <h6 class="font-semibold text-gray-800 mb-2 flex items-center gap-2">
                        i Kenapa Perlu Edit?
                    </h6>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Gunakan fitur ini untuk memperbaiki typo atau menyesuaikan strategi menu.
                        Nama kategori yang konsisten bikin pelanggan nggak mikir dua kali saat
                        <strong>Self-Order</strong>. Otak pelanggan hemat, omzet aman.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
