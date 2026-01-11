<x-app-layout>
    <div class="max-w-screen-2xl mx-auto px-6 py-6">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-gray-900">
                Laporan Per Kategori
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Analisis performa penjualan berdasarkan kategori produk.
            </p>
        </div>

        {{-- FILTER --}}
        <div class="mb-8 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <form action="{{ route('kategorilaporan') }}" method="GET"
                  class="grid grid-cols-1 gap-4 md:grid-cols-4 items-end">

                <div>
                    <label class="mb-1 block text-xs font-semibold uppercase text-gray-500">
                        Dari Tanggal
                    </label>
                    <input
                        type="date"
                        name="start_date"
                        value="{{ $startDate }}"
                        max="{{ $today }}"
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-gray-900 focus:ring-gray-900"
                    >
                </div>

                <div>
                    <label class="mb-1 block text-xs font-semibold uppercase text-gray-500">
                        Sampai Tanggal
                    </label>
                    <input
                        type="date"
                        name="end_date"
                        value="{{ $endDate }}"
                        max="{{ $today }}"
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-gray-900 focus:ring-gray-900"
                    >
                </div>

                <button
                    type="submit"
                    class="rounded-lg bg-gray-900 px-4 py-2 text-sm text-white hover:bg-gray-800 transition">
                    Filter
                </button>

                <a href="{{ route('kategorilaporan') }}"
                   class="rounded-lg border border-gray-300 px-4 py-2 text-center text-sm text-gray-700 hover:bg-gray-100 transition">
                    Reset
                </a>
            </form>
        </div>

        {{-- GRID KATEGORI --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @forelse ($kategoris as $k)
                <div
                    class="group rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200 transition hover:-translate-y-1 hover:shadow-md">

                    {{-- ICON --}}
                    <div
                        class="mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-gray-700 group-hover:bg-gray-900 group-hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 7h10M7 11h10M7 15h6"/>
                        </svg>
                    </div>

                    {{-- TITLE --}}
                    <h3 class="text-lg font-semibold text-gray-900 capitalize">
                        {{ $k->kategori }}
                    </h3>
                    <p class="mt-1 text-xs text-gray-500">
                        Ringkasan Penjualan
                    </p>

                    <div class="my-4 h-px bg-gray-200"></div>

                    {{-- STATS --}}
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div>
                            <div class="text-xl font-semibold text-gray-900">
                                {{ $k->total_terjual ?? 0 }}
                            </div>
                            <div class="mt-1 text-[10px] uppercase tracking-wide text-gray-500">
                                Produk Terjual
                            </div>
                        </div>

                        <div>
                            <div class="text-xl font-semibold text-green-600">
                                Rp {{ number_format($k->total_pendapatan ?? 0, 0, ',', '.') }}
                            </div>
                            <div class="mt-1 text-[10px] uppercase tracking-wide text-gray-500">
                                Pendapatan
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-500">
                    Tidak ada data kategori tersedia.
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>
