@extends('Pembeli.index')

@section('content')
    <div
        class="min-h-screen flex items-center justify-center
            bg-gradient-to-br from-orange-50 via-white to-orange-100 px-4">

        <div class="bg-white rounded-2xl shadow-xl p-8 max-w-sm w-full text-center">

            <!-- Icon -->
            <div
                class="w-16 h-16 mx-auto mb-4
                    flex items-center justify-center
                    rounded-full bg-orange-100 text-orange-600 text-3xl">
                ☕
            </div>

            <!-- Title -->
            <h1 class="text-2xl font-extrabold text-gray-800 mb-2">
                Selamat Datang!
            </h1>

            <!-- Meja Info -->
            <p class="text-gray-600 mb-6">
                Anda berada di
                <span class="block mt-1 text-lg font-semibold text-orange-600">
                    Meja Nomor {{ $meja->nomor_meja }}
                </span>
            </p>


            <!-- Form -->
            <form action="{{ route('keranjang.store') }}" method="POST">
                @csrf
                <input type="hidden" name="meja_id" value="{{ $meja->id }}">

                <button type="submit"
                    class="w-full py-3 rounded-full
                        bg-orange-500 hover:bg-orange-600
                        text-white font-bold tracking-wide
                        transition duration-300
                        shadow-md hover:shadow-lg
                        active:scale-95">
                    Mulai Pesan Sekarang
                </button>
            </form>

            <!-- Footer text -->
            <p class="text-xs text-gray-400 mt-6">
                Warkop CAK-IMIN • QR Order System
            </p>
        </div>
    </div>
@endsection
