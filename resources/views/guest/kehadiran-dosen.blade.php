@extends('guest.default')

@section('content')
    <div class="container mx-auto p-6 mt-12 bg-gray-50 rounded-lg shadow-lg min-h-screen">
        <!-- Table Content -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-200">
            <div class="text-center mb-4 mt-4">
                <h1 class="text-2xl font-bold">Status Ketersediaan Sesi Bimbingan Dosen</h1>
                <p class="text-gray-500">Kampus 4 Sidoarjo | Jurusan Teknologi Informasi | Prodi Teknik Informatika</p>
            </div>

            <!-- Filter by Date -->
            <div class="flex justify-center items-center mb-6 w-full">
                <form class="w-full max-w-lg" method="GET">
                    <div class="flex flex-col sm:flex-row items-center justify-center w-full">
                        <label for="tanggal" class="text-base font-semibold text-gray-800 mb-2 sm:mb-0 sm:mr-4">
                            Tampilkan Berdasarkan Tanggal
                        </label>
                        <div class="relative flex items-center w-full sm:w-auto">
                            <input type="date" name="tanggal" id="tanggal" value="2024-11-11"
                                class="w-full sm:w-40 pl-4 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                                required>
                        </div>
                        <button type="submit"
                            class="mt-2 sm:mt-0 sm:ml-4 text-sm px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none">
                            Cari
                        </button>
                    </div>
                </form>
            </div>


            <!-- Table -->
            <table class="w-full border-separate border-spacing-0 text-sm text-gray-800">
                <thead class="bg-gray-200 text-gray-800">
                    <tr>
                        <th class="px-2 py-1 text-left">Dosen</th>
                        <th class="px-2 py-1 text-left">08:00 - 09:00</th>
                        <th class="px-2 py-1 text-left">09:00 - 10:00</th>
                        <th class="px-2 py-1 text-left">10:00 - 11:00</th>
                        <th class="px-2 py-1 text-left">11:00 - 11:00</th>
                        <th class="px-1 py-1 text-left bg-gray-300">11:00 - 13:00</th>
                        <th class="px-2 py-1 text-left">13:00 - 14:00</th>
                        <th class="px-2 py-1 text-left">14:00 - 15:00</th>
                        <th class="px-2 py-1 text-left">15:00 - 16:00</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @php
                        $jadwal = [
                            [
                                'dosen' => 'Rifqi Aji Widarso, S.T. M.T.',
                                'waktu' => [
                                    '08:00 - 09:00' => 'Tidak Tersedia',
                                    '09:00 - 10:00' => 'Tidak Tersedia',
                                    '10:00 - 11:00' => 'Tidak Tersedia',
                                    '11:00 - 12:00' => 'Tersedia',
                                    '12:00 - 13:00' => 'Istirahat',
                                    '13:00 - 14:00' => 'Tersedia',
                                    '14:00 - 15:00' => 'Tersedia',
                                    '15:00 - 16:00' => 'Tidak Tersedia',
                                ],
                            ],
                            [
                                'dosen' => 'Adi Sucipto, S.ST., M.Tr.T.',
                                'waktu' => [
                                    '08:00 - 09:00' => 'Tidak Tersedia',
                                    '09:00 - 10:00' => 'Tidak Tersedia',
                                    '10:00 - 11:00' => 'Tidak Tersedia',
                                    '11:00 - 12:00' => 'Tidak Tersedia',
                                    '12:00 - 13:00' => 'Istirahat',
                                    '13:00 - 14:00' => 'Tidak Tersedia',
                                    '14:00 - 15:00' => 'Tidak Tersedia',
                                    '15:00 - 16:00' => 'Tidak Tersedia',
                                ],
                            ],
                            [
                                'dosen' => 'Rani Purbaningtyas, S.Kom., MT.',
                                'waktu' => [
                                    '08:00 - 09:00' => 'Tersedia',
                                    '09:00 - 10:00' => 'Tersedia',
                                    '10:00 - 11:00' => 'Tersedia',
                                    '11:00 - 12:00' => 'Tersedia',
                                    '12:00 - 13:00' => 'Istirahat',
                                    '13:00 - 14:00' => 'Tersedia',
                                    '14:00 - 15:00' => 'Tersedia',
                                    '15:00 - 16:00' => 'Tersedia',
                                ],
                            ],
                        ];
                    @endphp

                    @foreach ($jadwal as $data)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $data['dosen'] }}</td>
                            @foreach ($data['waktu'] as $jam => $ketersediaan)
                                <td class="px-2 py-1 {{ $jam == '12:00 - 13:00' ? 'bg-gray-300' : '' }}">{{ $ketersediaan }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-end mt-4">
            <nav aria-label="Page navigation">
                <ul class="flex items-center space-x-1">
                    <li>
                        <a href="#"
                            class="px-3 py-1 border border-gray-300 bg-white rounded-lg hover:bg-gray-100">Previous</a>
                    </li>
                    <li>
                        <a href="#"
                            class="px-3 py-1 border border-gray-300 bg-white rounded-lg hover:bg-gray-100">1</a>
                    </li>
                    <li>
                        <a href="#"
                            class="px-3 py-1 border border-gray-300 bg-white rounded-lg hover:bg-gray-100">2</a>
                    </li>
                    <li>
                        <a href="#"
                            class="px-3 py-1 border border-gray-300 bg-white rounded-lg hover:bg-gray-100">3</a>
                    </li>
                    <li>
                        <a href="#"
                            class="px-3 py-1 border border-gray-300 bg-white rounded-lg hover:bg-gray-100">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
