@extends('guest.default')

@section('content')
    <div class="container mx-auto p-6 mt-10 min-h-screen">
        <div class="overflow-x-auto shadow rounded-lg border border-gray-200 bg-white bg-nota" id="pdfContent">
            <div class="flex items-center justify-between p-2 border-b">
                <div class="flex-1 text-center">
                    <h1 class="text-3xl font-bold text-gray-800">Jadwal Bimbingan</h1>
                </div>
            </div>
            <div class="overflow-x-auto">
                <form class="max-w-md mx-auto my-4">
                    <label for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Temukan Jadwal Bimbinganmu Disini..." required />
                        <button type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>
                <div class="overflow-x-auto">
                    <table class="w-full border-separate border-spacing-0 text-sm text-black">
                        <thead class="bg-gray-200 text-gray-800">
                            <tr>
                                <th class="p-2 text-center">Tanggal</th>
                                <th class="p-2 text-center">Hari</th>
                                <th class="p-2 text-center">Jam</th>
                                <th class="p-2 text-center">Dosen</th>
                                <th class="p-2 text-center">Mahasiswa</th>
                                <th class="p-2 text-center">Keperluan</th>
                                <th class="p-2 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white text-center" id="bimbinganTableBody">
                            <?php for ($i = 1; $i <= 1; $i++): ?>
                            <tr class="border-b border-gray-200">
                                <td class="p-2">11 November 2024</td>
                                <td class="p-2">Senin</td>
                                <td class="p-2">10:00 - 11:00</td>
                                <td class="p-2">Rifqi Aji Widarso, S.T. M.T.</td>
                                <td class="p-2">Ahmad Syarif</td>
                                <td class="p-2">Penyusunan Bab II</td>
                                <td class="p-2">-</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="p-2">8 November 2024</td>
                                <td class="p-2">Jumat</td>
                                <td class="p-2">13.00 - 14.00</td>
                                <td class="p-2">Rifqi Aji Widarso, S.T. M.T.</td>
                                <td class="p-2">Enrique Lazuardi Ramadany</td>
                                <td class="p-2">Penyelesaian Skripsi</td>
                                <td class="p-2">Disetujui</td>
                              
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="p-2">8 November 2024</td>
                                <td class="p-2">Jumat</td>
                                <td class="p-2">13.00 - 14.00</td>
                                <td class="p-2">Rifqi Aji Widarso, S.T. M.T.</td>
                                <td class="p-2">Daffa Agung Nugroho</td>
                                <td class="p-2">PBL</td>
                                <td class="p-2">Tidak Disetujui</td>
                             
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="p-2">8 November 2024</td>
                                <td class="p-2">Jumat</td>
                                <td class="p-2">14.00 - 15.00</td>
                                <td class="p-2">Adi Sucipto, S.ST., M.Tr.T.</td>
                                <td class="p-2">Junia Vitasari</td>
                                <td class="p-2">Magang</td>
                                <td class="p-2">Disetujui</td>
                              
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="p-2">8 November 2024</td>
                                <td class="p-2">Jumat</td>
                                <td class="p-2">15.00 - 16.00</td>
                                <td class="p-2">Adi Sucipto, S.ST., M.Tr.T.</td>
                                <td class="p-2">Rachmadany Anggowo</td>
                                <td class="p-2">Magang</td>
                                <td class="p-2">Disetujui</td>
                             
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
                            </div>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
