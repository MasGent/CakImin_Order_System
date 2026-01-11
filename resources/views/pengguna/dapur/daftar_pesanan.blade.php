<x-app-layout>
    <div id="pesanan-container" class="bg-gray-100 min-h-screen p-6">

        <h1 class="text-2xl font-bold mb-6">🍳 Dapur – Pesanan Diproses</h1>

        @if (session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($pesanan as $item)
            <div class="bg-white rounded-xl shadow p-4 mb-4">

                <div class="flex justify-between items-center mb-3">
                    <div>
                        <p class="text-sm text-gray-500">Kode Pesanan</p>
                        <p class="font-mono font-bold text-orange-600">
                            {{ $item->kode_pesanan }}
                        </p>
                    </div>

                    <span class="px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700">
                        Diproses
                    </span>
                </div>

                <p class="text-sm mb-3">
                    Pemesan: <strong>{{ $item->nama_pemesan }}</strong>
                </p>

                <div class="flex gap-2">
                    <a href="{{ route('dapur.detail', $item->id) }}"
                        class="flex-1 text-center bg-gray-200 py-2 rounded-lg hover:bg-gray-300">
                        🔍 Detail Pesanan
                    </a>
                </div>

            </div>
        @empty
            <p class="text-center text-gray-500 mt-20">
                Tidak ada pesanan diproses 🍽️
            </p>
        @endforelse


    </div>
    <script>
        function loadPesanan() {
            fetch("{{ route('dapur.pesanan.data') }}")
                .then(res => res.json())
                .then(data => {
                    let html = '';

                    if (data.length === 0) {
                        html = `<p class="text-center text-gray-500 mt-20">
                                    Tidak ada pesanan diproses 🍽️
                                </p>`;
                    } else {
                        data.forEach(item => {
                            html += `
                            <div class="bg-white rounded-xl shadow p-4 mb-4">
                                <div class="flex justify-between items-center mb-3">
                                    <div>
                                        <p class="text-sm text-gray-500">Kode Pesanan</p>
                                        <p class="font-mono font-bold text-orange-600">
                                            ${item.kode_pesanan}
                                        </p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700">
                                        Diproses
                                    </span>
                                </div>

                                <p class="text-sm mb-3">
                                    Pemesan: <strong>${item.nama_pemesan}</strong>
                                </p>

                                <a href="/dapur/pesanan/${item.id}"
                                    class="block text-center bg-gray-200 py-2 rounded-lg hover:bg-gray-300">
                                    🔍 Detail Pesanan
                                </a>
                            </div>`;
                        });
                    }

                    document.getElementById('pesanan-container').innerHTML = html;
                });
        }

        // load awal
        loadPesanan();

        // auto refresh tiap 5 detik
        setInterval(loadPesanan, 5000);
    </script>

</x-app-layout>
