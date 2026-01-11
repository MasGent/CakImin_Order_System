<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 py-6">

        {{-- HEADER --}}
        <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Sistem Pengelolaan Staff
                </h2>
                <p class="text-sm text-gray-500">
                    Manajemen akses akun Kasir dan Dapur Warkop Cak Imin.
                </p>
            </div>

            <a href="{{ route('pengguna.create') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-gray-900 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-gray-800">
                + Tambah Staff
            </a>
        </div>

        {{-- ALERT SUCCESS --}}
        @if (session('success'))
            <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- ALERT ERROR --}}
        @if (session('error'))
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        {{-- TABLE --}}
        <div class="overflow-hidden rounded-xl bg-white shadow ring-1 ring-gray-200">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left w-16">No</th>
                        <th class="px-4 py-3 text-left">Nama Lengkap</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Role / Akses</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($users as $key => $u)
                        <tr class="hover:bg-gray-50">
                            {{-- NO --}}
                            <td class="px-4 py-3 font-semibold text-gray-500">
                                {{ $users->firstItem() + $key }}
                            </td>

                            {{-- NAMA --}}
                            <td class="px-4 py-3 font-semibold text-gray-900">
                                {{ $u->name }}
                            </td>

                            {{-- EMAIL --}}
                            <td class="px-4 py-3 text-gray-600">
                                {{ $u->email }}
                            </td>

                            {{-- ROLE --}}
                            <td class="px-4 py-3">
                                @if ($u->role === 'owner')
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Owner (Admin)
                                    </span>
                                @elseif ($u->role === 'kasir')
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Kasir
                                    </span>
                                @elseif ($u->role === 'dapur')
                                    <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                        Dapur
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="px-4 py-3 text-center">
                                @if ($u->id !== auth()->id())
                                    <form action="{{ route('pengguna.destroy', $u->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin mencabut akses pengguna ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="rounded-lg border border-red-300 px-3 py-1 text-xs font-semibold text-red-600 hover:bg-red-50">
                                            Hapus
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs italic text-gray-400">
                                        Akun Anda
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                Belum ada data pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-6">
            {{ $users->links() }}
        </div>

    </div>
</x-app-layout>
