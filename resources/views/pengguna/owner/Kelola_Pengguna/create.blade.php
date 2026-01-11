<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 py-6">

        {{-- HEADER --}}
        <div class="mb-6">
            <a href="{{ route('pengguna.index') }}"
               class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-800">
                ← Kembali ke Daftar
            </a>

            <h2 class="mt-2 text-2xl font-bold text-gray-900">
                Tambah Staff Baru
            </h2>
            <p class="text-sm text-gray-500">
                Daftarkan akun Kasir atau Dapur untuk dashboard warkop.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- FORM --}}
            <div class="lg:col-span-2">
                <div class="rounded-xl bg-white p-6 shadow ring-1 ring-gray-200">
                    <form action="{{ route('pengguna.store') }}" method="POST" class="space-y-5">
                        @csrf

                        {{-- NAMA --}}
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-gray-700">
                                Nama Lengkap
                            </label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Masukkan nama staff"
                                   class="w-full rounded-lg border-gray-300 text-sm focus:border-gray-900 focus:ring-gray-900 @error('name') border-red-500 @enderror"
                                   required>
                            @error('name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-gray-700">
                                Email (Username Login)
                            </label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="staff@example.com"
                                   class="w-full rounded-lg border-gray-300 text-sm focus:border-gray-900 focus:ring-gray-900 @error('email') border-red-500 @enderror"
                                   required>
                            @error('email')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ROLE --}}
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-gray-700">
                                Role Akses
                            </label>
                            <select name="role"
                                    class="w-full rounded-lg border-gray-300 text-sm focus:border-gray-900 focus:ring-gray-900 @error('role') border-red-500 @enderror"
                                    required>
                                <option value="" disabled selected>Pilih Hak Akses</option>
                                <option value="kasir" {{ old('role') === 'kasir' ? 'selected' : '' }}>
                                    Kasir
                                </option>
                                <option value="dapur" {{ old('role') === 'dapur' ? 'selected' : '' }}>
                                    Dapur (Koki)
                                </option>
                            </select>

                            <p class="mt-1 text-xs italic text-gray-500">
                                *Role Owner hanya bisa dibuat secara internal.
                            </p>

                            @error('role')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label class="mb-1 block text-sm font-semibold text-gray-700">
                                    Password
                                </label>
                                <input type="password"
                                       name="password"
                                       class="w-full rounded-lg border-gray-300 text-sm focus:border-gray-900 focus:ring-gray-900 @error('password') border-red-500 @enderror"
                                       required>
                                @error('password')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-1 block text-sm font-semibold text-gray-700">
                                    Konfirmasi Password
                                </label>
                                <input type="password"
                                       name="password_confirmation"
                                       class="w-full rounded-lg border-gray-300 text-sm focus:border-gray-900 focus:ring-gray-900"
                                       required>
                            </div>
                        </div>

                        {{-- ACTION --}}
                        <div class="pt-4">
                            <button type="submit"
                                    class="w-full rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white hover:bg-gray-800">
                                Daftarkan Staff
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- INFO PANEL --}}
            <div>
                <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-6">
                    <div class="mb-4 text-center">
                        <div
                            class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-full bg-gray-900 text-white">
                            🔐
                        </div>
                        <h5 class="font-bold text-gray-900">Keamanan Akun</h5>
                    </div>

                    <ul class="space-y-3 text-sm text-gray-600">
                        <li>
                            <strong>Kasir:</strong>
                            Akses pembayaran dan riwayat pesanan.
                        </li>
                        <li>
                            <strong>Dapur:</strong>
                            Melihat antrean pesanan dan update status masakan.
                        </li>
                        <li>
                            Gunakan password minimal <strong>8 karakter</strong>.
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
