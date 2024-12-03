@extends('admin.default')
@section('content')
    <div class="container mx-auto p-6 mt-10 min-h-screen">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Card Total Dosen -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Total Dosen</h2>
                        <p class="mt-2 text-3xl font-bold text-green-600">{{ $totalDosen }}</p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-full flex items-center justify-center  w-16 h-16">
                        <i class="fa-solid fa-user-tie text-3xl text-green-600"></i>
                    </div>
                </div>

            </div>

            <!-- Card Total Teknisi -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Total Teknisi</h2>
                        <p class="mt-2 text-3xl font-bold text-red-600">{{ $totalTeknisi }}</p>
                    </div>
                    <div class="bg-red-100 p-4 rounded-full flex items-center justify-center  w-16 h-16">
                        <i class="fa-solid fa-user-gear text-3xl text-red-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <div class="flex justify-between items-center my-8">
                <form class="flex items-center w-2/3" method="GET" action="{{ route('adminPengguna') }}">
                    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="search" name="search"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Temukan pengguna disini..." value="{{ request('search') }}" />
                        <button type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>

                <!-- Button Tambah Pengguna -->
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                    class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300 text-sm ml-4"
                    type="button">
                    <i class="fa-solid fa-plus"></i> Pengguna
                </button>
            </div>

            <!-- Tabel -->
            <div class="overflow-x-auto">
                <table class="w-full border-separate border-spacing-0 text-sm text-black">
                    <thead class="bg-gray-200 text-gray-800">
                        <tr>
                            <th class="p-2 text-center">Username</th>
                            <th class="p-2 text-center">Email</th>
                            <th class="p-2 text-center">Role</th>
                            <th class="p-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-center" id="dosenTableBody">
                        @if ($users->isEmpty())
                        <tr>
                            <td colspan="5" class="p-6">
                                <div class="flex flex-col items-center justify-center">
                                    <img src="{{ asset('asset/404.gif') }}" alt="Not Found" class="w-64 h-64 mb-4">
                                    <p class="text-center text-gray-600 text-lg font-semibold">
                                       Pengguna "{{ request('search') }}" tidak ditemukan.
                                    </p>
                                    <p class="mt-2 text-center text-gray-500 text-md">
                                        Silakan periksa kembali kata kunci pencarian Anda atau coba gunakan istilah
                                        lain.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @else
                        @foreach ($users as $index => $item)
                            <tr class="border-b border-gray-200">
                                <td class="p-2">{{ $item->username }}</td>
                                <td class="p-2">{{ $item->email }}</td>
                                <td class="p-2">{{ $item->role }} </td>
                                <td class="p-2">
                                    <form id="delete-form-{{ $item->id_user }}"
                                        action="{{ route('adminPengguna.destroy', $item->id_user) }}"method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="inline-flex items-center justify-center w-8 h-8 text-white bg-red-700 border border-red-600 rounded shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 ml-1"
                                            onclick="confirmDelete('{{ $item->id_user }}', '{{ $item->username }}')">
                                            <i class="fa-regular fa-trash-can text-base"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
            </div>

        </div>

        <div id="crud-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex items-center justify-center w-full h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-between p-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-black">Tambah Pengguna</h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                            data-modal-toggle="crud-modal" data-modal-hide="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form action="{{ route('adminPengguna.store') }}" method="POST" class="p-4">
                        @csrf
                        <div class="text-left">
                            <label for="username" class="block text-sm font-medium text-gray-900">Username
                                Pengguna</label>
                            <input type="text" name="username" id="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                placeholder="Masukkan Username Pengguna" required>
                        </div>

                        <div class="text-left mt-4">
                            <label for="email" class="block text-sm font-medium text-gray-900">Email
                                Pengguna</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                placeholder="Masukkan Email Pengguna" required>
                        </div>

                        <div class="text-left mt-4">
                            <label for="role" class="block text-sm font-medium text-gray-900">role</label>
                            <select name="role" id="role"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                required>
                                <option value="" disabled selected>Pilih role</option>
                                <option value="dosen">Dosen</option>
                                <option value="teknisi">Teknisi</option>
                            </select>
                        </div>

                        <div class="text-left mt-4">
                            <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                placeholder="Masukkan Password" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300 font-medium text-sm my-2">
                                Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Custom Pagination -->
        @if (!request('search'))
            <div class="flex flex-col items-center my-6">
                <span class="text-sm text-gray-700 dark:text-gray-400">
                    Menampilkan <span
                        class="font-semibold text-gray-900 dark:text-white">{{ $users->firstItem() }}</span>
                    sampai
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $users->lastItem() }}</span> dari
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $users->total() }}</span> pengguna
                </span>
                <div class="inline-flex mt-2 xs:mt-0">
                    <button {{ $users->onFirstPage() ? 'disabled' : '' }}
                        class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        {{ $users->previousPageUrl() ? 'onclick=window.location.href=\'' . $users->previousPageUrl() . '\'' : '' }}>
                        Sebelumnya
                    </button>
                    <button {{ !$users->hasMorePages() ? 'disabled' : '' }}
                        class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        {{ $users->nextPageUrl() ? 'onclick=window.location.href=\'' . $users->nextPageUrl() . '\'' : '' }}>
                        Selanjutnya
                    </button>
                </div>
            </div>
        @endif
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
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->has('email'))
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Email sudah digunakan, gunakan email yang lain.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            @endif
        });
        function confirmDelete(id, nama) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan user " + nama,
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
