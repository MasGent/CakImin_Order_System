<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen bg-white transition-all duration-300 ease-in-out -translate-x-full xl:translate-x-0"
    aria-label="Sidenav">
    <div class="flex flex-col h-full px-4 justify-between">
        <div>
            <div
                class="flex items-center gap-3 p-3 rounded-2xl hover:bg-gray-100 transition-all duration-200 my-1 cursor-pointer select-none">
                <!-- Logo -->
                <div class="w-11 h-11 rounded-xl bg-blue-600 flex items-center justify-center shadow-sm">
                    <!-- kalau belum ada logo image, pakai inisial -->
                    <span class="text-white font-extrabold text-sm tracking-wide">
                        CI
                    </span>

                    <!-- kalau SUDAH ada file logo, pakai ini:
            <img src="{{ asset('images/logo.png') }}"
                alt="Logo Warkop CAK-IMIN"
                class="w-7 h-7 object-contain" />
            -->
                </div>

                <!-- Branding Text -->
                <div class="flex flex-col leading-none">
                    <span class="text-sm font-semibold text-gray-500 tracking-wide">
                        Warkop
                    </span>
                    <span class="text-xl font-bold text-blue-700 tracking-wide font-poppins">
                        CAK-IMIN
                    </span>
                </div>
            </div>


            <div class="text-xs font-bold text-gray-500 uppercase mt-8 mb-5">Main Menu</div>
            <ul class="mb-6 space-y-4">
                @auth
                    @if (auth()->user()->role === 'owner')
                        {{-- Kelola Meja --}}
                        <li>
                            <a href="{{ route('meja.index') }}"
                                class="group flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('meja.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H16a2.25 2.25 0 0 1-2.25-2.25v-2.25Z" />
                                </svg>
                                <span class="font-poppins text-sm text-nowrap">Kelola Meja</span>
                            </a>
                        </li>

                        {{-- Kelola Produk --}}
                        <li>
                            <a href="{{ route('produk.index') }}"
                                class="group flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('produk.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                                <span class="font-poppins text-sm text-nowrap">Kelola Produk</span>
                            </a>
                        </li>

                        {{-- Kelola Kategori --}}
                        <li>
                            <a href="{{ route('kategori.index') }}"
                                class="group flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('kategori.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.146 2.146 0 0 0 3.035 0l4.318-4.318a2.146 2.146 0 0 0 0-3.035L11.159 3.659A2.25 2.25 0 0 0 9.568 3Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                </svg>
                                <span class="font-poppins text-sm text-nowrap">Kelola Kategori</span>
                            </a>
                        </li>

                        {{-- MENU BARU: Dropdown Laporan Transaksi --}}
                        {{-- <li>
                            <button type="button"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 px-4"
                                aria-controls="dropdown-laporan" data-collapse-toggle="dropdown-laporan">
                                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                <span class="flex-1 ms-3 text-left whitespace-nowrap text-sm font-poppins">Laporan
                                    Transaksi</span>
                                <svg class="w-3 h-3 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="dropdown-laporan" class="hidden py-2 space-y-2 ml-4">
                                <li>
                                    <a href="{{ route('laporan.transaksi.bulanan') }}"
                                        class="flex items-center w-full p-2 text-gray-700 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 text-xs">
                                        Laporan Bulanan
                                    </a>

                                </li>
                                <li>
                                    <a href="{{ route('kategorilaporan') }}"
                                        class="flex items-center w-full p-2 text-gray-700 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 text-xs">Berdasarkan
                                        Kategori</a>
                                </li>
                                <li>
                                    <a href="{{ route('menu') }}"
                                        class="flex items-center w-full p-2 text-gray-700 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 text-xs">Berdasarkan
                                        Menu</a>
                                </li>
                            </ul>
                        </li> --}}


                        <li>
                            <a href="{{ route('laporan.transaksi.bulanan') }}"
                                class="group flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('pengguna.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-6 h-6 text-gray-600" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19.2857 7V5.78571c0-.43393-.3482-.78571-.7778-.78571H6.06345c-.42955 0-.77777.35178-.77777.78571V16m0 0h-1c-.55229 0-1 .4477-1 1v1c0 .5523.44771 1 1 1h5m-4-3h4m7.00002-6v3c0 .5523-.4477 1-1 1h-3m8-3v8c0 .5523-.4477 1-1 1h-6c-.5523 0-1-.4477-1-1v-5.397c0-.2536.0963-.4977.2696-.683l2.434-2.603c.189-.2022.4535-.317.7304-.317h3.566c.5523 0 1 .4477 1 1Z" />
                                </svg>


                                <span class="font-poppins text-sm text-nowrap">Laporan Bulanan</span>
                            </a>
                        </li>

                        {{-- Kelola Pengguna --}}
                        <li>
                            <a href="{{ route('pengguna.index') }}"
                                class="group flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('pengguna.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                                <span class="font-poppins text-sm text-nowrap">Kelola Pengguna</span>
                            </a>
                        </li>
                    @endif
                @endauth


                @auth
                    @if (auth()->user()->role === 'kasir')
                        {{-- Kelola Meja --}}
                        <li>
                            <a href="{{ route('kasir.pesanan') }}"
                                class="group flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('meja.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H16a2.25 2.25 0 0 1-2.25-2.25v-2.25Z" />
                                </svg>
                                <span class="font-poppins text-sm text-nowrap">Daftar Pesanan</span>
                            </a>
                        </li>
                    @endif
                @endauth

                @auth
                    @if (auth()->user()->role === 'dapur')
                        {{-- Kelola Meja --}}
                        <li>
                            <a href="{{ route('dapur.pesanan') }}"
                                class="group flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('meja.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H16a2.25 2.25 0 0 1-2.25-2.25v-2.25Z" />
                                </svg>
                                <span class="font-poppins text-sm text-nowrap">Daftar Pesanan</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('dapur.stok') }}"
                                class="group flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200
                            {{ request()->routeIs('dapur.stok*')
                                ? 'bg-blue-50 text-blue-700 font-medium'
                                : 'text-gray-700 hover:bg-gray-100' }}">

                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H16a2.25 2.25 0 0 1-2.25-2.25v-2.25Z" />
                                </svg>

                                <span class="font-poppins text-sm text-nowrap">Stok</span>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>

        <div class="mb-5 relative">
            <button id="dropdownTopButton" data-dropdown-toggle="dropdownTop" data-dropdown-placement="top"
                class="flex items-center w-full p-1 rounded-lg hover:bg-gray-100 border border-gray-100 transition-all duration-200 cursor-pointer">
                <div
                    class="w-9 h-9 flex-shrink-0 flex items-center justify-center rounded-lg bg-blue-600 text-white shadow-sm">
                    <span class="text-sm font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                <div class="flex flex-1 items-center justify-between ml-3 overflow-hidden">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                        {{ Auth::user()->name }}
                    </p>
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                </div>
            </button>

            <div id="dropdownTop"
                class="z-50 hidden bg-white rounded-xl shadow-xl w-60 border border-gray-100 overflow-hidden">
                <div class="px-4 py-3 bg-gray-50 border-b border-gray-100">
                    <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    <span
                        class="mt-1 inline-block px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-blue-100 text-blue-700 rounded">
                        {{ Auth::user()->role }}
                    </span>
                </div>
                <ul class="py-1 text-sm text-gray-700">
                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center px-4 py-2 hover:bg-gray-50 transition">
                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Edit Profile
                        </a>
                    </li>
                    <li class="border-t border-gray-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center w-full px-4 py-2 text-red-600 hover:bg-red-50 transition">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Log Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
