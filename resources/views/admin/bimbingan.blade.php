@extends('admin.default')

@section('content')
    <div class="container mx-auto p-6 mt-10 min-h-screen">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-4 w-full sm:w-auto">
                <label for="tahun_ajaran" class="text-base font-semibold text-gray-800">
                    Tampilkan Berdasarkan Dosen
                </label>
                <select id="tahun_ajaran" name="tahun_ajaran"
                    class="block w-full sm:w-64 py-2 px-3 border border-gray-300 bg-white rounded-md shadow focus:ring-blue-600 focus:border-blue-600 sm:text-base text-gray-700"
                    onchange="getBimbinganByDosen(this)">
                    <option value="">Pilih Dosen</option>
                    @foreach ($dosenList as $dosen)
                        <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama_dosen }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="overflow-x-auto shadow rounded-lg border border-gray-200 bg-white bg-nota" id="pdfContent">
            <div class="flex items-center justify-between p-2 border-b">
                <div class="flex-1 text-center">
                    <h1 class="text-3xl font-bold text-gray-800">Approval Bimbingan</h1>
                    <p id="nama-dosen" class="text-lg"></p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <!-- Tabel Bimbingan -->
                <div class="overflow-x-auto">
                    <table id="bimbinganTable" class="w-full border-separate border-spacing-0 text-sm text-black">
                        <thead class="bg-gray-200 text-gray-800">
                            <tr>
                                <th class="p-2 text-center">Tanggal</th>
                                <th class="p-2 text-center">Hari</th>
                                <th class="p-2 text-center">Jam</th>
                                <th class="p-2 text-center">Nama Mahasiswa</th>
                                <th class="p-2 text-center">Keperluan</th>
                                <th class="p-2 text-center">Status</th>
                                <th class="p-2 text-center">Approval</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white text-center" id="bimbinganTableBody">

                        </tbody>
                    </table>

                    <!-- Modal Edit Approval -->
                    {{-- <div id="edit-approval-modal" tabindex="-1" aria-hidden="true"
                        class="fixed inset-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal hidden">
                        <div class="relative w-full max-w-md h-full max-h-full md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button"
                                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="#edit-approval-modal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-6 text-center">
                                    <h3 class="text-lg font-semibold text-gray-900">Edit Status Approval</h3>
                                    <form action="/" method="POST" class="space-y-4">
                                        @csrf
                                        @method('PUT')
                                        <div class="text-left">
                                            <label class="block text-sm font-medium text-gray-900">Tanggal</label>
                                            <p>11 November 2024</p>
                                        </div>
                                        <div class="text-left mt-4">
                                            <label class="block text-sm font-medium text-gray-900">Hari</label>
                                            <p>Senin</p>
                                        </div>
                                        <div class="text-left mt-4">
                                            <label class="block text-sm font-medium text-gray-900">Jam</label>
                                            <p>10:00 - 11:00</p>
                                        </div>
                                        <div class="text-left mt-4">
                                            <label class="block text-sm font-medium text-gray-900">Nama
                                                Mahasiswa</label>
                                            <p>Ahmad Syarif</p>
                                        </div>
                                        <div class="text-left mt-4">
                                            <label class="block text-sm font-medium text-gray-900">Keperluan</label>
                                            <p>Penyusunan Bab II</p>
                                        </div>
                                        <div class="text-left mt-4">
                                            <label class="block text-sm font-medium text-gray-900">Status
                                                Approval</label>
                                            <select name="status_approval"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                required>
                                                <option>Disetujui</option>
                                                <option>Tidak Disetujui</option>
                                            </select>
                                        </div>
                                        <div class="flex justify-end mt-4">
                                            <button type="submit"
                                                class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300 font-medium text-sm">
                                                Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Modal Edit Approval -->
                    <div id="edit-approval-modal" tabindex="-1" aria-hidden="true"
                        class="fixed inset-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal hidden">
                        <div class="relative w-full max-w-md h-full max-h-full md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" onclick="closeModal()"
                                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-6 text-center">
                                    <h3 class="text-lg font-semibold text-gray-900">Edit Status Approval</h3>
                                    <form id="edit-approval-form" method="POST" class="space-y-4">
                                        @csrf
                                        @method('PUT')
                                        <div class="text-left">
                                            <label class="block text-sm font-medium text-gray-900">Tanggal</label>
                                            <p id="modal-tanggal"></p>
                                        </div>
                                        <div class="text-left mt-4">
                                            <label class="block text-sm font-medium text-gray-900">Hari</label>
                                            <p id="modal-hari"></p>
                                        </div>
                                        <div class="text-left mt-4">
                                            <label class="block text-sm font-medium text-gray-900">Jam</label>
                                            <p id="modal-jam"></p>
                                        </div>
                                        <div class="text-left mt-4">
                                            <label class="block text-sm font-medium text-gray-900">Nama Mahasiswa</label>
                                            <p id="modal-nama"></p>
                                        </div>
                                        <div class="text-left mt-4">
                                            <label class="block text-sm font-medium text-gray-900">Keperluan</label>
                                            <p id="modal-keperluan"></p>
                                        </div>
                                        <div class="text-left mt-4">
                                            <label class="block text-sm font-medium text-gray-900">Status Approval</label>
                                            <select id="status" name="status"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                required>
                                                <option value="1">Disetujui</option>
                                                <option value="2">Tidak Disetujui</option>
                                            </select>
                                        </div>
                                        <div class="flex justify-end mt-4">
                                            <button type="submit"
                                                class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300 font-medium text-sm">
                                                Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function getBimbinganByDosen(selectElement) {
            const dosenId = selectElement.value; // ID dosen yang terpilih
            const dosenName = selectElement.options[selectElement.selectedIndex].text; // Nama dosen yang terpilih

            // Memperbarui teks di elemen <p> dengan nama dosen yang terpilih
            const namaDosenElement = document.getElementById('nama-dosen');
            namaDosenElement.innerText = dosenName;

            if (!dosenId) {
                alert("Pilih dosen terlebih dahulu");
                return;
            }

            fetch(`/admin/bimbingan/${dosenId}`)
                .then(response => response.json())
                .then(bimbingans => {
                    const tableBody = document.getElementById('bimbinganTable').querySelector('tbody');
                    tableBody.innerHTML = ''; // Reset tabel    

                    bimbingans.forEach(bimbingan => {
                        const row = document.createElement('tr');
                        let statusText = '';
                        let editButton = '';

                        if (bimbingan.status == 1) {
                            statusText = 'Disetujui';
                        } else if (bimbingan.status == 2) {
                            statusText = 'Tidak Disetujui';
                        } else {
                            statusText = '-';
                        }

                        // Validasi tombol edit, hanya tampil jika status null atau kosong
                        if (bimbingan.status === null || bimbingan.status === undefined || bimbingan.status ===
                            '') {
                            editButton = `
                                <button onclick="openEditModal(${bimbingan.id_bimbingan}, '${bimbingan.tanggal}', '${bimbingan.hari}', '${bimbingan.jam_awal} - ${bimbingan.jam_akhir}', '${bimbingan.nama}', '${bimbingan.keperluan}', '${bimbingan.status}')"
                                        class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button>
                            `;
                        } else {
                            editButton = 'Tidak Tersedia'; // Menampilkan tanda "-" jika status sudah ada
                        }

                        row.innerHTML = `
                            <td>${bimbingan.tanggal}</td>
                            <td>${bimbingan.hari}</td>
                            <td>${bimbingan.jam_awal} - ${bimbingan.jam_akhir}</td>
                            <td>${bimbingan.nama}</td>
                            <td>${bimbingan.keperluan}</td>
                            <td><span id="orderStatus">${statusText}</span></td>
                            <td>${editButton}</td>
                        </td>
                        `;
                        tableBody.appendChild(row);
                    });
                });
        }

        function openEditModal(index, tanggal, hari, jam, nama, keperluan, status) {
            // Mengatur konten modal
            document.getElementById(`modal-tanggal`).innerText = tanggal;
            document.getElementById(`modal-hari`).innerText = hari;
            document.getElementById(`modal-jam`).innerText = jam;
            document.getElementById(`modal-nama`).innerText = nama;
            document.getElementById(`modal-keperluan`).innerText = keperluan;
            document.getElementById(`status`).value = status;

            const form = document.getElementById('edit-approval-form');
            form.action = `/admin/bimbingan/${index}`;

            // Menampilkan modal
            const modal = document.getElementById(`edit-approval-modal`);
            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById(`edit-approval-modal`);
            modal.classList.add('hidden');
        }

        document.querySelectorAll('[data-modal-target]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-target');
                document.querySelector(modalId).classList.remove('hidden');
            });
        });
        document.querySelectorAll('[data-modal-hide]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-hide');
                document.querySelector(modalId).classList.add('hidden');
            });
        });
    </script>
@endsection
