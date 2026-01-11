<x-app-layout>
    <div class="max-w-screen-2xl mx-auto px-4 py-4" x-data="{ openCreate: false, openEdit: false, editData: {} }">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-2xl font-black text-gray-900 font-poppins">Kelola Meja</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Pengaturan nomor meja dan QR pemesanan
                </p>
            </div>
{{--
            <button @click="openCreate = true"
                class="inline-flex items-center gap-2 rounded-lg bg-gray-900 px-4 py-2 text-sm text-white hover:bg-gray-800 transition">
                + Tambah Meja
            </button> --}}

        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($meja as $m)
                <div class="group rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200 hover:shadow-md transition">

                    {{-- Nomor Meja --}}
                    <div class="mb-6">
                        <p class="text-xs text-gray-400 uppercase tracking-wide">
                            Meja
                        </p>
                        <p class="text-3xl font-semibold text-gray-900">
                            #{{ $m->nomor_meja }}
                        </p>
                    </div>

                    {{-- Kode Akses --}}
                    <div class="mb-6">
                        <p class="text-xs text-gray-400 uppercase tracking-wide">
                            Kode Akses
                        </p>
                        <p class="mt-1 text-sm font-mono text-gray-700">
                            {{ $m->qr_access }}
                        </p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col gap-3">

                        {{-- Download QR --}}
                        <a href="{{ route('meja.download-qr', $m->id) }}"
                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                            Download QR
                        </a>

                        <div class="flex gap-2">
                            <button
                                @click="openEdit = true; editData = {
                                id: '{{ $m->id }}',
                                nomor_meja: '{{ $m->nomor_meja }}',
                                qr_access: '{{ $m->qr_access }}'
                            }"
                                class="flex-1 rounded-lg bg-gray-100 px-3 py-2 text-sm text-gray-700 hover:bg-gray-200 transition">
                                Edit
                            </button>


                            <form action="{{ route('meja.destroy', $m->id) }}" method="POST"
                                onsubmit="return confirm('Hapus meja ini?')" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="w-full rounded-lg bg-red-50 px-3 py-2 text-sm text-red-600 hover:bg-red-100 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            @endforeach
        </div>
        {{-- //Modal --}}
        @include('pengguna.owner.Kelola_Meja.create')
        @include('pengguna.owner.Kelola_Meja.edit')

        <div data-dial-init class="fixed end-10 bottom-6 group">
            <button type="button" @click="openCreate = true"
                class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium focus:outline-none">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
                <span class="sr-only">Open actions menu</span>
            </button>
        </div>
    </div>
</x-app-layout>
