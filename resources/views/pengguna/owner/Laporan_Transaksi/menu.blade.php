<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-6">

        {{-- Header --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Laporan Per Menu / Produk
            </h2>
            <p class="text-gray-500 mt-1">
                Pantau performa setiap menu yang dijual di Warkop Cak Imin.
            </p>
        </div>

        {{-- Filter --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
            <form action="{{ route('menu') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">
                        Dari Tanggal
                    </label>
                    <input type="date" name="start_date"
                        value="{{ $startDate }}"
                        max="{{ $today }}"
                        class="w-full rounded-lg border-gray-300 focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">
                        Sampai Tanggal
                    </label>
                    <input type="date" name="end_date"
                        value="{{ $endDate }}"
                        max="{{ $today }}"
                        class="w-full rounded-lg border-gray-300 focus:ring focus:ring-indigo-200">
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="w-full inline-flex justify-center items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-white font-semibold hover:bg-indigo-700 transition">
                        Filter
                    </button>
                    <a href="{{ route('menu') }}"
                        class="w-full inline-flex justify-center items-center rounded-lg border border-gray-300 px-4 py-2.5 font-semibold text-gray-600 hover:bg-gray-50 transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Grid Produk --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($produks as $p)
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition overflow-hidden relative">

                    {{-- Badge kategori --}}
                    <span
                        class="absolute top-4 right-4 text-xs font-semibold bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full">
                        {{ $p->kategori->nama_kategori ?? '-' }}
                    </span>

                    <div class="p-6 text-center">
                        {{-- Gambar --}}
                        <div
                            class="mx-auto mb-4 w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden">
                            @if ($p->gambar)
                                <img src="{{ asset('storage/' . $p->gambar) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zM6 22v-2a6 6 0 0112 0v2" />
                                </svg>
                            @endif
                        </div>

                        <h3 class="font-bold text-gray-800">
                            {{ $p->nama_produk }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Sisa stok:
                            <span class="font-semibold text-gray-700">
                                {{ $p->stok }}
                            </span>
                        </p>

                        <div class="border-t border-gray-100 my-4"></div>

                        <div class="grid grid-cols-2 text-center">
                            <div class="border-r border-gray-100">
                                <div class="text-xl font-bold text-gray-800">
                                    {{ $p->total_terjual ?? 0 }}
                                </div>
                                <div class="text-[10px] tracking-widest text-gray-400 mt-1">
                                    TERJUAL
                                </div>
                            </div>

                            <div>
                                <div class="text-xl font-bold text-green-600">
                                    Rp {{ number_format($p->total_pendapatan ?? 0, 0, ',', '.') }}
                                </div>
                                <div class="text-[10px] tracking-widest text-gray-400 mt-1">
                                    OMZET
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 text-gray-500">
                    <p class="text-lg font-semibold">
                        Tidak ada produk terjual
                    </p>
                    <p class="text-sm mt-1">
                        Coba ubah rentang tanggal.
                    </p>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>
