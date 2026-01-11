{{-- Modal Edit --}}
<div
    x-cloak
    x-show="openEdit"
    x-transition.opacity
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
>
    <div
        @click.away="openEdit = false"
        class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl">

        <h2 class="text-lg font-semibold text-gray-900 mb-4">
            Edit Meja
        </h2>

        <form :action="`/meja/${editData.id}`" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="text-sm text-gray-600">Nomor Meja</label>
                <input
                    type="number"
                    name="nomor_meja"
                    x-model="editData.nomor_meja"
                    required
                    class="mt-1 w-full rounded-lg border-gray-300 focus:ring-gray-900 focus:border-gray-900">
            </div>

            <div>
                <label class="text-sm text-gray-600">QR Access</label>
                <input
                    type="text"
                    name="qr_access"
                    x-model="editData.qr_access"
                    required
                    class="mt-1 w-full rounded-lg border-gray-300 focus:ring-gray-900 focus:border-gray-900">
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <button
                    type="button"
                    @click="openEdit = false"
                    class="px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">
                    Batal
                </button>

                <button
                    class="px-4 py-2 text-sm text-white bg-gray-900 hover:bg-gray-800 rounded-lg">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
