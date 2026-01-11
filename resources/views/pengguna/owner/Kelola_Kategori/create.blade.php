<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-6">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Tambah Kategori Baru
                </h2>
                <p class="text-sm text-gray-500">
                    Buat pengelompokan menu baru untuk Warkop Cak Imin.
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
                    <form action="{{ route('kategori.store') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Nama Kategori --}}
                        <div>
                            <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-1">
                                Nama Kategori
                            </label>
                            <input
                                type="text"
                                name="kategori"
                                id="kategori"
                                value="{{ old('kategori') }}"
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

                            <p class="mt-2 text-xs text-gray-500">
                                Gunakan nama yang singkat dan jelas agar mudah dipahami pembeli.
                            </p>
                        </div>

                        {{-- Action --}}
                        <div class="flex flex-wrap gap-3">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 transition shadow">
                                ✔ Simpan Kategori
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
                <div class="rounded-xl bg-indigo-50 border border-indigo-100 p-6">
                    <h5 class="font-bold text-indigo-700 mb-3 flex items-center gap-2">
                        ℹ Tips Kategori
                    </h5>
                    <ul class="text-sm text-indigo-700 space-y-2 list-disc list-inside">
                        <li>Kategori membantu pelanggan menemukan menu lebih cepat.</li>
                        <li>Jangan kebanyakan kategori — bikin bingung, bukan pintar.</li>
                        <li>Pastikan nama kategori unik dan konsisten.</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
