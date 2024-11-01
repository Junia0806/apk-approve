@extends('dosen.default')

@section('content')
    <div class="container mx-auto p-6 mt-10 min-h-screen">
        <div class="flex items-center justify-between p-2 border-b">
            <div class="flex-1 text-center">
                <h1 class="text-3xl font-bold text-gray-800">Presensi Dosen</h1>
            </div>

        </div>
        <div class="overflow-x-auto">
            <!-- Tabel Dosen -->
            <div class="overflow-x-auto">
                <table class="w-full border-separate border-spacing-0 text-sm text-black">
                    <thead class="bg-gray-200 text-gray-800">
                        <tr>
                            <th class="p-2 text-center">Tanggal</th>
                            <th class="p-2 text-center">Hari</th>
                            <th class="p-2 text-center">Status Presensi</th>
                            <th class="p-2 text-center">Presensi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-center" id="dosenTableBody">
                        <?php for ($i = 1; $i <= 1; $i++): ?>
                        <tr class="border-b border-gray-200">
                            <td class="p-2">03 Oktober 2024</td>
                            <td class="p-2">Rabu</td>
                            <td class="p-2">-</td>
                            <td class="p-2">
                                <button type="button" data-modal-target="#edit-item-modal-<?php echo $i; ?>"
                                    class="inline-flex items-center justify-center w-14 rounded-md text-white bg-green-500 border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    Tersedia
                                </button>

                            </td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td class="p-2">02 Oktober 2024</td>
                            <td class="p-2">Selasa</td>
                            <td class="p-2">Hadir</td>
                            <td class="p-2 text-gray-600">
                                Tidak Tersedia

                            </td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td class="p-2">01 Oktober 2024</td>
                            <td class="p-2">Senin</td>
                            <td class="p-2">Tidak Hadir</td>
                            <td class="p-2 text-gray-600">
                                Tidak Tersedia

                            </td>
                        </tr>
                        <!-- Modal Edit Dosen -->
                        <div id="edit-item-modal-<?php echo $i; ?>" tabindex="-1" aria-hidden="true"
                            class="fixed inset-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal hidden">
                            <div class="relative w-full max-w-md h-full max-h-full md:h-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button"
                                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="#edit-item-modal-<?php echo $i; ?>">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-6 text-center">
                                        <h3 class="text-lg font-semibold text-gray-900">Edit Status Presensi</h3>
                                        <form action="/" method="POST" class="space-y-4">
                                            @csrf
                                            @method('PUT')
                                            <div class="text-left">
                                                <label for="tanggal"
                                                    class="block text-sm font-medium text-gray-900">Tanggal</label>
                                                <p>03 Oktober 2024</p>
                                            </div>
                                            <div class="text-left mt-4">
                                                <label for="hari"
                                                    class="block text-sm font-medium text-gray-900">Hari</label>
                                                <p>Rabu</p>
                                            </div>
                                            <div class="text-left mt-4">
                                                <label for="status_presensi"
                                                    class="block text-sm font-medium text-gray-900">Status Presensi</label>
                                                <select name="status_presensi" id="status_presensi"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                    required>
                                                    <option>Hadir</option>
                                                    <option>Tidak Hadir</option>
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


        <div class="flex flex-col items-center mt-4">
            <!-- Help text -->
            <span class="text-sm text-gray-700 dark:text-gray-400">
                Showing <span class="font-semibold text-gray-900 dark:text-white">1</span> to <span
                    class="font-semibold text-gray-900 dark:text-white">10</span> of <span
                    class="font-semibold text-gray-900 dark:text-white">100</span> Entries
            </span>
            <div class="inline-flex mt-2 xs:mt-0">
                <!-- Buttons -->
                <button
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                    Prev
                </button>
                <button
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Next
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </button>
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

        function confirmDelete() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan jam perkuliahan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi, submit form penghapusan
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
