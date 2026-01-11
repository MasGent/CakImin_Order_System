<nav x-data="{ open: false }" class="bg-white border-gray-100 p-3 flex items-center justify-between xl:ml-64">

    <!-- Tombol Sidebar -->
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
        type="button"
        class="inline-flex items-center p-2 text-sm text-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-white/50 xl:invisible">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <!-- Dropdown Avatar -->
    <div id="dropdownTopButtonn" data-dropdown-toggle="dropdownuser" data-dropdown-placement="bottom"
        class="flex items-center gap-2 px-2 py-1.5 bg-white rounded-full shadow-sm border border-gray-200 cursor-pointer hover:shadow-md transition duration-200 ease-in-out">

        <!-- Avatar Circle -->
        <div class="flex items-center justify-center bg-blue-500 text-white font-semibold rounded-full w-8 h-8 text-sm">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <!-- Ikon Dropdown -->
        <div class="flex items-center justify-center">
            <svg class="w-4 h-4 text-gray-600 group-hover:text-black transition" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 15l4 4 4-4M8 9l4-4 4 4" />
            </svg>
        </div>
    </div>
    <div id="dropdownuser" class="z-10 hidden bg-white rounded-lg shadow w-60 border border-gray-200">
        <!-- User Info -->
        <div class="flex items-center space-x-1 px-4 py-3 border-b border-gray-200">
            <div
            class="w-10 h-10 rounded-md bg-blue-100 flex items-center justify-center text-base font-semibold text-blue-700 shadow-sm">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-sm text-gray-900 truncate">
                    {{ Auth::user()->name }}
                </p>
                <p class="text-xs text-gray-600 truncate">
                    {{ Auth::user()->email }}
                </p>
            </div>
        </div>
        <!-- Menu Items -->
        <ul class="py-1 text-sm text-gray-700">
            <li>
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center px-4 py-2 hover:bg-gray-100 text-gray-800">
                    <svg class="w-5 h-5 mr-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13v-2a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L14 4.757V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L4.929 6.343a1 1 0 0 0 0 1.414l.536.536L4.757 10H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535 1.707.707V20a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H20a1 1 0 0 0 1-1Z" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    </svg>
                    Settings
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 hover:bg-gray-100 text-gray-800">
                        <svg class="w-5 h-5 mr-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                        </svg>
                        Log Out
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
