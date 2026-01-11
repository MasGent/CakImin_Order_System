{{-- Modal Create --}}
<div
    x-cloak
    x-show="openCreate"
    x-transition.opacity
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
>
    <div
        @click.away="openCreate = false"
        class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl">

        <h2 class="text-lg font-semibold text-gray-900 mb-4">
            Tambah Meja
        </h2>

        <form action="{{ route('meja.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="text-sm text-gray-600">Nomor Meja</label>
                <input
                    type="number"
                    name="nomor_meja"
                    required
                    class="mt-1 w-full rounded-lg border-gray-300 focus:ring-gray-900 focus:border-gray-900">
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <button
                    type="button"
                    @click="openCreate = false"
                    class="px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">
                    Batal
                </button>

                <button
                    class="px-4 py-2 text-sm text-white bg-gray-900 hover:bg-gray-800 rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
