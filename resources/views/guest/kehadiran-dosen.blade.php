@extends('guest.default')

@section('content')
    <div class="container mx-auto p-6 mt-12 bg-gray-50 rounded-lg shadow-lg min-h-screen">
        <!-- Table Content -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-200">
            <div class="text-center mb-4 mt-4">
                <h1 class="text-2xl font-bold">Sistem Informasi Status Kehadiran Dosen</h1>
            </div>
              <!-- Search Bar -->
              <div class="flex flex-col sm:flex-row justify-center items-center mb-6 w-full">
                <form class="w-full max-w-md">
                    <label for="search-input" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z"></path>
                            </svg>
                        </div>
                        <input type="search" id="search-input" placeholder="Temukan dosen disini..."
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                            required>
                        <button type="submit"
                            class="absolute right-2.5 bottom-1.5 text-sm px-4 py-1 mt-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none">Search</button>
                    </div>
                </form>
            </div>
            <table class="w-full border-separate border-spacing-0 text-sm text-gray-800">
                <thead class="bg-gray-200 text-gray-800">
                    <tr>
                        <th class="px-4 py-2 text-left">Kampus</th>
                        <th class="px-4 py-2 text-left">Jurusan</th>
                        <th class="px-4 py-2 text-left">Prodi</th>
                        <th class="px-4 py-2 text-left">Dosen</th>
                        <th class="px-4 py-2 text-left">Hari</th>
                        <th class="px-4 py-2 text-left">Jam</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Ketersediaan Waktu</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @php
                        $jadwal = [
                            [
                                'kampus' => 'Universitas A',
                                'jurusan' => 'Teknologi Informasi',
                                'prodi' => 'Teknik Informatika',
                                'dosen' => 'Dr. John Doe',
                                'hari' => 'Senin',
                                'jam' => '08:00 - 10:00',
                                'status' => 'Hadir',
                                'ketersediaan' => 'Tersedia',
                            ],
                            [
                                'kampus' => 'Universitas B',
                                'jurusan' => 'Manajemen Agribisnis',
                                'prodi' => 'Manajemen Agribisnis',
                                'dosen' => 'Prof. Jane Doe',
                                'hari' => 'Selasa',
                                'jam' => '10:00 - 12:00',
                                'status' => 'Hadir',
                                'ketersediaan' => 'Penuh',
                            ],
                            // Tambahkan data lain sesuai kebutuhan
                        ];
                    @endphp
                    @foreach ($jadwal as $data)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $data['kampus'] }}</td>
                            <td class="px-4 py-3">{{ $data['jurusan'] }}</td>
                            <td class="px-4 py-3">{{ $data['prodi'] }}</td>
                            <td class="px-4 py-3">{{ $data['dosen'] }}</td>
                            <td class="px-4 py-3">{{ $data['hari'] }}</td>
                            <td class="px-4 py-3">{{ $data['jam'] }}</td>
                            <td class="px-4 py-3">{{ $data['status'] }}</td>
                            <td class="px-4 py-3">{{ $data['ketersediaan'] }}</td>
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
                        <a href="#" class="px-3 py-1 border border-gray-300 bg-white rounded-lg hover:bg-gray-100">Previous</a>
                    </li>
                    <li>
                        <a href="#" class="px-3 py-1 border border-gray-300 bg-white rounded-lg hover:bg-gray-100">1</a>
                    </li>
                    <li>
                        <a href="#" class="px-3 py-1 border border-gray-300 bg-white rounded-lg hover:bg-gray-100">2</a>
                    </li>
                    <li>
                        <a href="#" class="px-3 py-1 border border-gray-300 bg-white rounded-lg hover:bg-gray-100">3</a>
                    </li>
                    <li>
                        <a href="#" class="px-3 py-1 border border-gray-300 bg-white rounded-lg hover:bg-gray-100">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
