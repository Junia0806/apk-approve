@extends('dosen.default')

@section('content')
    <div class="container mx-auto p-6 mt-10 min-h-screen">
        <div class="overflow-x-auto shadow rounded-lg border border-gray-200 bg-white bg-nota" id="pdfContent">
            <div class="flex items-center justify-between p-2 border-b">
                <div class="flex-1 text-center">
                    <h1 class="text-3xl font-bold text-gray-800">Approval Bimbingan</h1>
                    <p>{{ Auth::user()->name}}</p>
                </div>
            </div>
            <div class="overflow-x-auto shadow rounded-lg border border-gray-200 bg-white">
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
                            @foreach ($bimbingans as $index => $bimbingan)
                                <tr class="border-b border-gray-200">
                                    <td class="p-2">{{ $bimbingan['tanggal'] }}</td>
                                    <td class="p-2">{{ $bimbingan['hari'] }}</td>
                                    <td class="p-2">{{ $bimbingan['jam_awal'] }} - {{ $bimbingan['jam_akhir'] }}</td>
                                    <td class="p-2">{{ $bimbingan['nama'] }}</td>
                                    <td class="p-2">{{ $bimbingan['keperluan'] }}</td>
                                    <td class="p-2 text-center">
                                        @if ($bimbingan['status'] == 0)
                                            <span
                                                class="px-2 py-1 text-sm font-semibold text-gray-700 bg-gray-100 rounded-full">Belum
                                                diproses</span>
                                        @elseif ($bimbingan['status'] == 1)
                                            <span
                                                class="px-2 py-1 text-sm font-semibold text-green-700 bg-green-100 rounded-full">Disetujui</span>
                                        @elseif ($bimbingan['status'] == 2)
                                            <span
                                                class="px-2 py-1 text-sm font-semibold text-red-700 bg-red-100 rounded-full">Ditolak</span>
                                        @else
                                            <span
                                                class="px-2 py-1 text-sm font-semibold text-yellow-700 bg-yellow-100 rounded-full">Tidak
                                                Diketahui</span>
                                        @endif
                                    </td>
                                    <td class="p-2">
                                        @if ($bimbingan['status'] == 0)
                                            <button type="button"
                                                data-modal-target="#edit-item-modal-{{ $bimbingan['id_bimbingan'] }} "
                                                class="inline-flex items-center justify-center w-20 rounded-md text-white bg-green-500 border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500">
                                                Tersedia
                                            </button>
                                        @else
                                            <span class="px-2 py-1 text-sm font-semibold text-gray-700">-</span>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Modal Edit Approval -->
                                <div id="edit-item-modal-{{ $bimbingan['id_bimbingan'] }}" tabindex="-1" aria-hidden="true"
                                    class="fixed inset-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal hidden">
                                    <div class="relative w-full max-w-md h-full max-h-full md:h-auto">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button"
                                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="#edit-item-modal-{{ $bimbingan['id_bimbingan'] }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6 text-center">
                                                <h3 class="text-lg font-semibold text-gray-900">Edit Status Approval</h3>

                                                <!-- Display success or error messages -->
                                                @if (session('success'))
                                                    <div class="text-green-500 mb-4">
                                                        {{ session('success') }}
                                                    </div>
                                                @elseif(session('error'))
                                                    <div class="text-red-500 mb-4">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif

                                                <div class="mb-4 p-4 bg-yellow-200 text-yellow-800 text-sm rounded-md">
                                                    <strong>Peringatan:</strong> Perubahan status approval hanya dapat
                                                    dilakukan <strong>satu kali.</strong> Pastikan keputusan Anda tepat
                                                    sebelum melanjutkan.
                                                </div>

                                                <form
                                                    action="{{ route('dosenBimbingan.update', $bimbingan['id_bimbingan']) }}"
                                                    method="POST" class="space-y-4">
                                                    @csrf
                                                    @method('PUT')

                                                    <!-- Tanggal, Hari, Jam, Nama Mahasiswa -->
                                                    <div class="grid grid-cols-2 gap-4">
                                                        <div class="text-left">
                                                            <label
                                                                class="block text-sm font-medium text-gray-900">Tanggal</label>
                                                            <p>{{ $bimbingan['tanggal'] }}</p>
                                                        </div>
                                                        <div class="text-left">
                                                            <label
                                                                class="block text-sm font-medium text-gray-900">Hari</label>
                                                            <p>{{ $bimbingan['hari'] }}</p>
                                                        </div>
                                                        <div class="text-left">
                                                            <label
                                                                class="block text-sm font-medium text-gray-900">Jam</label>
                                                            <p>{{ $bimbingan['jam_awal'] }} -
                                                                {{ $bimbingan['jam_akhir'] }}</p>
                                                        </div>
                                                        <div class="text-left">
                                                            <label class="block text-sm font-medium text-gray-900">Nama
                                                                Mahasiswa</label>
                                                            <p>{{ $bimbingan['nama'] }}</p>
                                                        </div>
                                                    </div>

                                                    <!-- Keperluan -->
                                                    <div class="text-left mt-4">
                                                        <label
                                                            class="block text-sm font-medium text-gray-900">Keperluan</label>
                                                        <p>{{ $bimbingan['keperluan'] }}</p>
                                                    </div>

                                                    <!-- Status Approval -->
                                                    <div class="text-left mt-4">
                                                        <label class="block text-sm font-medium text-gray-900">Status
                                                            Approval</label>
                                                        <select name="status"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                            required>
                                                            <option value="1"
                                                                {{ $bimbingan['status'] == 1 ? 'selected' : '' }}>
                                                                Disetujui</option>
                                                            <option value="2"
                                                                {{ $bimbingan['status'] == 0 ? 'selected' : '' }}>
                                                                Ditolak</option>
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
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
        });
    </script>
@endsection
