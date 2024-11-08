@extends('admin.default')

@section('content')
    <div class="container mx-auto p-6 mt-10 min-h-screen">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-4 w-full sm:w-auto">
                <label for="tahun_ajaran" class="text-base font-semibold text-gray-800">
                    Tampilkan Berdasarkan Dosen
                </label>
                <select id="tahun_ajaran" name="tahun_ajaran"
                    class="block w-full sm:w-64 py-2 px-3 border border-gray-300 bg-white rounded-md shadow focus:ring-blue-600 focus:border-blue-600 sm:text-base text-gray-700">
                    <option>Rifqi Aji Widarso, S.T. M.T.</option>
                    <option>Adi Sucipto, S.ST., M.Tr.T.</option>
                    <option>Rani Purbaningtyas, S.Kom., MT.</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto shadow rounded-lg border border-gray-200 bg-white bg-nota" id="pdfContent">
            <div class="flex items-center justify-between p-2 border-b">
                <div class="flex-1 text-center">
                    <h1 class="text-3xl font-bold text-gray-800">Approval Bimbingan</h1>
                    <p class="text-lg">Rifqi Aji Widarso, S.T. M.T.</p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <!-- Tabel Bimbingan -->
                <div class="overflow-x-auto">
                    <table class="w-full border-separate border-spacing-0 text-sm text-black">
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
                            <?php for ($i = 1; $i <= 1; $i++): ?>
                            <tr class="border-b border-gray-200">
                                <td class="p-2">11 November 2024</td>
                                <td class="p-2">Senin</td>
                                <td class="p-2">10:00 - 11:00</td>
                                <td class="p-2">Ahmad Syarif</td>
                                <td class="p-2">Penyusunan Bab II</td>
                                <td class="p-2">-</td>
                                <td class="p-2">
                                    <button type="button" data-modal-target="#edit-approval-modal-<?php echo $i; ?>"
                                        class="inline-flex items-center justify-center w-20 rounded-md text-white bg-green-500 border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500">
                                        Tersedia
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="p-2">8 November 2024</td>
                                <td class="p-2">Jumat</td>
                                <td class="p-2">13.00 - 14.00</td>
                                <td class="p-2">Enrique Lazuardi Ramadany</td>
                                <td class="p-2">Penyelesaian Skripsi</td>
                                <td class="p-2">Disetujui</td>
                                <td class="p-2 text-gray-600">
                                    Tidak Tersedia
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="p-2">08 November 2024</td>
                                <td class="p-2">Jumat</td>
                                <td class="p-2">13.00 - 14.00</td>
                                <td class="p-2">Daffa Agung Nugroho</td>
                                <td class="p-2">PBL</td>
                                <td class="p-2">Tidak Disetujui</td>
                                <td class="p-2 text-gray-600">
                                    Tidak Tersedia
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="p-2">8 November 2024</td>
                                <td class="p-2">Jumat</td>
                                <td class="p-2">14.00 - 15.00</td>
                                <td class="p-2">Junia Vitasari</td>
                                <td class="p-2">Magang</td>
                                <td class="p-2">Disetujui</td>
                                <td class="p-2 text-gray-600">
                                    Tidak Tersedia
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="p-2">8 November 2024</td>
                                <td class="p-2">Jumat</td>
                                <td class="p-2">15.00 - 16.00</td>
                                <td class="p-2">Rachmadany Anggowo</td>
                                <td class="p-2">Magang</td>
                                <td class="p-2">Disetujui</td>
                                <td class="p-2 text-gray-600">
                                    Tidak Tersedia
                                </td>
                            </tr>
                            <!-- Modal Edit Approval -->
                            <div id="edit-approval-modal-<?php echo $i; ?>" tabindex="-1" aria-hidden="true"
                                class="fixed inset-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal hidden">
                                <div class="relative w-full max-w-md h-full max-h-full md:h-auto">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button"
                                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="#edit-approval-modal-<?php echo $i; ?>">
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
                                                    <label
                                                        class="block text-sm font-medium text-gray-900">Keperluan</label>
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
                            </div>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
