@extends('Pembeli.index')

@section('content')
    <div class="bg-gray-50 min-h-screen pb-28">

        {{-- HEADER --}}
        <div class="bg-white shadow-sm sticky top-0 z-30 px-4 py-4">
            <h1 class="text-lg sm:text-xl font-bold text-gray-800">Menu Kedai Cak-Imin</h1>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">
                Kode Pesanan:
                <span class="font-mono font-bold text-orange-600">
                    {{ session('active_order_code') }}
                </span>
            </p>
        </div>

        {{-- FILTER KATEGORI --}}
        <div class="bg-white sticky top-[88px] z-20 border-b">
            <div
                class="flex flex-nowrap gap-2 px-4 py-3
                   overflow-x-scroll whitespace-nowrap
                   snap-x snap-mandatory
                   no-scrollbar
                   touch-pan-x">

                <button onclick="filterKategori('all', this)"
                    class="kategori-btn snap-start shrink-0
                          bg-orange-500 text-white
                          px-4 py-2 rounded-full
                          text-xs font-semibold">
                    Semua
                </button>


                @foreach ($produkPerKategori as $kategori => $items)
                    <button onclick="filterKategori('{{ Str::slug($kategori) }}', this)"
                        class="kategori-btn snap-start shrink-0
                           bg-gray-100 text-gray-600
                           px-4 py-2 rounded-full
                           text-xs font-semibold
                           hover:bg-orange-100 hover:text-orange-600
                           transition">
                        {{ $kategori }}
                    </button>
                @endforeach

            </div>
        </div>


        {{-- LIST PRODUK --}}
        <div class="max-w-7xl mx-auto px-4 mt-6">
            @foreach ($produkPerKategori as $kategori => $daftarProduk)
                <h2 class="text-lg font-bold text-gray-700 mb-4 border-l-4 border-orange-500 pl-2">
                    {{ $kategori }}
                </h2>

                <div
                    class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 mb-10 kategori-section {{ Str::slug($kategori) }}">
                    @foreach ($daftarProduk as $item)
                        @php
                            $stokHabis = $item->stok <= 0;
                            $qty = $keranjangItems[$item->id] ?? 0;
                        @endphp

                        <div
                            class="bg-white rounded-2xl shadow-sm border flex flex-col overflow-hidden
                        {{ $stokHabis ? 'border-orange-400 bg-orange-50' : '' }}">

                            {{-- GAMBAR --}}
                            <div class="w-full aspect-[4/3] bg-gray-100 relative">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-full object-cover">
                                @endif

                                @if ($stokHabis)
                                    <div class="absolute inset-0 bg-orange-600/70 flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">STOK HABIS</span>
                                    </div>
                                @endif
                            </div>

                            {{-- BODY --}}
                            <div class="p-3 flex flex-col justify-between flex-grow">
                                <div>
                                    <h3 class="font-semibold text-sm text-gray-800">
                                        {{ $item->nama_produk }}
                                    </h3>

                                    <p class="font-bold mt-1 {{ $stokHabis ? 'text-orange-600' : 'text-gray-800' }}">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </p>

                                    <p class="text-xs mt-1 {{ $stokHabis ? 'text-orange-600' : 'text-gray-500' }}">
                                        Stok: {{ $item->stok }}
                                    </p>
                                </div>

                                {{-- BUTTON --}}
                                <div id="btn-container-{{ $item->id }}" data-qty="{{ $qty }}"
                                    data-stok="{{ $item->stok }}" class="mt-3">

                                    @if ($stokHabis)
                                        <button disabled
                                            class="w-full bg-orange-400 text-white text-xs py-2 rounded-full font-semibold cursor-not-allowed">
                                            Stok Habis
                                        </button>
                                    @elseif ($qty > 0)
                                        <div class="flex items-center justify-between bg-gray-100 rounded-full px-2 py-1">
                                            <button onclick="updateQty({{ $item->id }}, -1)"
                                                class="w-7 h-7 bg-white text-orange-500 rounded-full font-bold">-</button>

                                            <span class="font-bold text-sm">{{ $qty }}</span>

                                            <button onclick="updateQty({{ $item->id }}, 1)"
                                                class="w-7 h-7 bg-orange-500 text-white rounded-full font-bold">+</button>
                                        </div>
                                    @else
                                        <button onclick="updateQty({{ $item->id }}, 1)"
                                            class="w-full bg-orange-500 hover:bg-orange-600 text-white text-xs py-2 rounded-full font-semibold">
                                            Tambah
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        {{-- FLOATING CART --}}
        <div class="fixed bottom-5 right-5 z-50">
            <a href="{{ route('keranjang.lihat') }}"
                class="relative bg-orange-600 text-white px-4 py-3 rounded-full shadow-xl
                       flex items-center gap-2 hover:bg-orange-700 transition">

                <!-- ICON KERANJANG -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4
                                                           M7 13L5.4 5M7 13l-2 9m12-9l2 9
                                                           M9 21h.01M15 21h.01" />
                </svg>

                <span class="font-semibold text-sm">Pesanan</span>

                <!-- BADGE JUMLAH -->
                <span id="keranjang-badge"
                    class="absolute -top-2 -right-2 bg-red-600 text-white
                           text-xs font-bold px-2 py-1 rounded-full
                           {{ $keranjangCount > 0 ? '' : 'hidden' }}">
                    {{ $keranjangCount }}
                </span>
            </a>
        </div>


        {{-- SCRIPT --}}
        <script>
            let totalKeranjang = {{ $keranjangCount }};

            function updateQty(produkId, delta) {
                const container = document.getElementById(`btn-container-${produkId}`);
                const stok = parseInt(container.dataset.stok);
                let currentQty = parseInt(container.dataset.qty);
                let newQty = currentQty + delta;

                if (stok <= 0 || newQty < 0) return;

                fetch('{{ route('tambah-item') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            produk_id: produkId,
                            jumlah: newQty
                        })
                    })
                    .then(res => res.json())
                    .then(() => location.reload())
                    .catch(() => alert('Gagal update'));
            }

            function filterKategori(slug) {
                document.querySelectorAll('.kategori-section').forEach(section => {
                    section.classList.toggle('hidden', !(slug === 'all' || section.classList.contains(slug)));
                });
            }

            function filterKategori(slug, btn) {

                // FILTER PRODUK
                document.querySelectorAll('.kategori-section').forEach(section => {
                    section.classList.toggle(
                        'hidden',
                        !(slug === 'all' || section.classList.contains(slug))
                    );
                });

                // RESET SEMUA TOMBOL
                document.querySelectorAll('.kategori-btn').forEach(button => {
                    button.classList.remove('bg-orange-500', 'text-white');
                    button.classList.add('bg-gray-100', 'text-gray-600');
                });

                // SET TOMBOL AKTIF
                btn.classList.remove('bg-gray-100', 'text-gray-600');
                btn.classList.add('bg-orange-500', 'text-white');
            }

            document.addEventListener('DOMContentLoaded', () => {
                const firstBtn = document.querySelector('.kategori-btn');
                if (firstBtn) firstBtn.click();
            });
        </script>



        <style>
            /* .no-scrollbar::-webkit-scrollbar {
                display: none;
            } */

            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }

            .no-scrollbar {
                -webkit-overflow-scrolling: touch;
            }
        </style>

    </div>
@endsection
