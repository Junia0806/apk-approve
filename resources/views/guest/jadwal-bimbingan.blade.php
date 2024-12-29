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
                <form class="max-w-md mx-auto my-4" method="GET" action="{{ route('bimbingan') }}">
                    <label for="search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="search" name="search"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Temukan jadwal bimbinganmu disini..." value="{{ request('search') }}" />
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
                            @if (count($bimbingans) === 0)
                            <tr>
                                <td colspan="7" class="p-6">
                                    <div class="flex flex-col items-center justify-center">
                                        <img src="{{ asset('asset/404.gif') }}" alt="Not Found" class="w-64 h-64 mb-4">
                                        <p class="text-center text-gray-600 text-lg font-semibold">
                                            "{{ request('search') }}" tidak ditemukan.
                                        </p>
                                        <p class="mt-2 text-center text-gray-500 text-md">
                                            Silakan periksa kembali kata kunci pencarian Anda atau coba gunakan istilah lain.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @else
                            @foreach ($bimbingans as $index => $bimbingan)
                                <tr class="border-b border-gray-200">
                                    <td class="border border-gray-300 px-4 py-2">{{ $bimbingan['tanggal'] }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $bimbingan['hari'] }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $bimbingan['jam_awal'] }} - {{ $bimbingan['jam_akhir'] }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $bimbingan['dosen'] }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $bimbingan['nama'] }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $bimbingan['keperluan'] }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if ($bimbingan['status'] == 1)
                                            <span class="text-green-500 font-semibold">Disetujui</span>
                                        @elseif ($bimbingan['status'] == 2)
                                            <span class="text-red-500 font-semibold">Ditolak</span>
                                        @else
                                            <span class="text-gray-500 font-semibold">Belum Diproses</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
