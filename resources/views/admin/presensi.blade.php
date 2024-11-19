@extends('admin.default')

@section('content')
    <div class="container mx-auto p-6 mt-10 min-h-screen">
        <div class="flex items-center space-x-4 w-full sm:w-auto my-4">
            <label for="tanggal" class="text-base font-semibold text-gray-800">Tampilkan Berdasarkan Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}"
                class="block w-full sm:w-64 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:ring-blue-600 focus:border-blue-600 sm:text-base text-gray-700">
        </div>

        <div class="overflow-x-auto shadow rounded-lg border border-gray-200 bg-white bg-nota" id="pdfContent">
            <div class="text-center mb-4">
                <h1 class="text-2xl font-bold">Presensi Dosen</h1>
                <p id="selected-date" class="text-lg">{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full border-separate border-spacing-0 text-sm text-black">
                    <thead class="bg-gray-200 text-gray-800">
                        <tr>
                            <th class="p-2 text-center">Nama Dosen</th>
                            <th class="p-2 text-center">Status Presensi</th>
                            <th class="p-2 text-center">Presensi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-center" id="dosenTableBody">
                        <tr>
                            <td colspan="3" class="p-4 text-gray-500">Pilih tanggal untuk menampilkan data presensi.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div id="edit-approval-modal"
            class="hidden fixed inset-0 flex justify-center items-center">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">Edit Status Presensi</h2>
                <form id="edit-approval-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 font-semibold mb-2">Status</label>
                        <select id="status" name="status" class="w-full border border-gray-300 rounded-md p-2">
                            <option value="0">Belum Presensi</option>
                            <option value="1">Hadir</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 bg-gray-500 text-white rounded-md">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('tanggal').addEventListener('change', function() {
        const tanggal = this.value;
        const dosenTableBody = document.getElementById('dosenTableBody');
        const selectedDate = document.getElementById('selected-date');

        if (tanggal) {
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            selectedDate.textContent = new Date(tanggal).toLocaleDateString('id-ID', options);

            fetch(`/presensi/${tanggal}`)
                .then(response => response.json())
                .then(data => {
                    let rows = '';
                    if (data.length > 0) {
                        data.forEach(item => {
                            rows += `
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="p-2 text-sm font-medium text-gray-900">${item.nama_dosen}</td>
                                <td class="p-2 text-sm font-medium text-gray-900">${item.status == 0 ? 'Belum Presensi' : 'Hadir'}</td>
                                <td class="p-2 text-sm font-medium text-gray-900">
                                    ${item.status == 0 
                                        ? `<button class="edit-status-btn text-white bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded-md" data-id="${item.id_dosen}" data-status="${item.status}">Edit Status</button>` 
                                        : '<span class="text-red-500">Tidak Tersedia</span>'}
                                </td>
                            </tr>`;
                        });
                    } else {
                        rows =
                            `<tr><td colspan="3" class="p-4 text-gray-500">Data tidak ditemukan untuk tanggal tersebut.</td></tr>`;
                    }
                    dosenTableBody.innerHTML = rows;
                })
                .catch(() => {
                    dosenTableBody.innerHTML =
                        `<tr><td colspan="3" class="p-4 text-red-500">Gagal memuat data.</td></tr>`;
                });
        } else {
            dosenTableBody.innerHTML =
                `<tr><td colspan="3" class="p-4 text-gray-500">Pilih tanggal untuk menampilkan data presensi.</td></tr>`;
        }
    });

    // Tambahkan event listener untuk tombol edit status
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('edit-status-btn')) {
            const id = event.target.dataset.id;
            const status = event.target.dataset.status;

            document.getElementById('status').value = status;
            const form = document.getElementById('edit-approval-form');
            form.action = `/presensi/${id}`;

            const modal = document.getElementById('edit-approval-modal');
            modal.classList.remove('hidden');
        }
    });

    function closeModal() {
        const modal = document.getElementById('edit-approval-modal');
        modal.classList.add('hidden');
    }
</script>
@endsection
