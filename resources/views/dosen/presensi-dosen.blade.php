@extends('dosen.default')

@section('content')
    <div class="container mx-auto p-6 mt-10 min-h-screen">
        <div class="flex items-center justify-between p-2 border-b">
            <div class="flex-1 text-center">
                <h1 class="text-3xl font-bold text-gray-800">Presensi Dosen</h1>
                <p class="text-red-700 font-bold">Menampilkan seluruh data belum ada penyesuaian akun dosen yang login</p>
            </div>

        </div>
        <div class="overflow-x-auto shadow rounded-lg border border-gray-200 bg-white bg-nota" >
            <!-- Tabel Dosen -->
            <div class="overflow-x-auto">
                <table class="w-full border-separate border-spacing-0 text-sm text-black">
                    <thead class="bg-gray-200 text-gray-800">
                        <tr>
                            <th class="p-2 text-center">Tanggal</th>
                            <th class="p-2 text-center">Hari</th>
                            <th class="p-2 text-center">Nama Dosen</th>
                            <th class="p-2 text-center">Status Presensi</th>
                            <th class="p-2 text-center">Presensi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-center" id="dosenTableBody">
                        @foreach ($presensi as $index => $item)
                            <tr class="border-b border-gray-200">
                                <td class="p-2">{{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('j F Y') }}
                                </td>
                                <td class="p-2">{{ $item['hari'] }}</td>
                                <td class="p-2">{{ $item['nama_dosen'] }}</td>
                                <td class="p-2 text-center">
                                    @if ($item['status'] == 0)
                                        <span
                                            class="px-2 py-1 text-sm font-semibold text-gray-700 bg-gray-100 rounded-full">Belum
                                            absen</span>
                                    @elseif ($item['status'] == 1)
                                        <span
                                            class="px-2 py-1 text-sm font-semibold text-green-700 bg-green-100 rounded-full">Hadir</span>
                                    @elseif ($item['status'] == 2)
                                        <span
                                            class="px-2 py-1 text-sm font-semibold text-yellow-700 bg-yellow-100 rounded-full">Izin</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-sm font-semibold text-red-700 bg-red-100 rounded-full">Tanpa
                                            Keterangan</span>
                                    @endif
                                </td>
                                <td class="p-2">
                                    @if ($item['status'] == 0)
                                        <button type="button"
                                            data-modal-target="#edit-item-modal-{{ $item['id_presensi'] }} "
                                            class="inline-flex items-center justify-center w-20 rounded-md text-white bg-green-500 border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500">
                                            Tersedia
                                        </button>
                                    @else
                                        <span class="px-2 py-1 text-sm font-semibold text-gray-700">Tidak Tersedia</span>
                                    @endif
                                </td>
                                </td>
                            </tr>

                            <!-- Modal Edit Dosen -->
                            <div id="edit-item-modal-{{ $item['id_presensi'] }}" tabindex="-1" aria-hidden="true"
                                class="fixed inset-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal hidden">
                                <div class="relative w-full max-w-md h-full max-h-full md:h-auto">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Close Button -->
                                        <button type="button"
                                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="#edit-item-modal-{{ $item['id_presensi'] }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>

                                        <!-- Modal Content -->
                                        <div class="p-6">
                                            <h3 class="text-lg font-semibold text-gray-900 text-center">Edit Status Presensi
                                            </h3>

                                            <!-- Warning -->
                                            <div
                                                class="mt-4 mb-6 flex items-center p-4 bg-yellow-100 border border-yellow-300 text-yellow-800 text-sm rounded-lg">
                                                <i
                                                    class="fa-solid fa-triangle-exclamation text-xl mr-3 text-yellow-600"></i>
                                                <div>
                                                    Presensi hanya dapat dilakukan <strong>satu kali.</strong> Pastikan Anda
                                                    mengisi data dengan
                                                    jujur dan benar.
                                                </div>
                                            </div>

                                            <!-- Form -->
                                            <form action="{{ route('presensiDosen.update', $item['id_presensi']) }}"
                                                method="POST" class="space-y-4">
                                                @csrf
                                                @method('PUT')

                                                <!-- Tanggal dan Hari -->
                                                <div class="grid grid-cols-2 gap-4">
                                                    <div>
                                                        <label for="tanggal"
                                                            class="block text-sm font-medium text-gray-900">Tanggal</label>
                                                        <p>{{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('j F Y') }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <label for="hari"
                                                            class="block text-sm font-medium text-gray-900">Hari</label>
                                                        <p>{{ $item['hari'] }}</p>
                                                    </div>
                                                </div>

                                                <!-- Status Presensi -->
                                                <div>
                                                    <label for="status_presensi"
                                                        class="block text-sm font-medium text-gray-900 mt-4">Status
                                                        Presensi</label>
                                                    <select name="status"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                        required>
                                                        <option value="1" {{ $item['status'] == 1 ? 'selected' : '' }}>
                                                            Hadir</option>
                                                        <option value="2"
                                                            {{ $item['status'] == 2 ? 'selected' : '' }}>Izin</option>
                                                    </select>
                                                </div>

                                                <!-- Submit Button -->
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
                        @endforeach
                    </tbody>
                </table>
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
