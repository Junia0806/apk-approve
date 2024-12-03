@extends('admin.default')
@section('content')
    <div class="container mx-auto p-6 mt-10 min-h-screen">
        <div class="flex items-center justify-between p-2 border-b">
            <div class="flex-1 text-center">
                <h1 class="text-3xl font-bold text-gray-800">Program Studi {{ $kampus->nama_kampus }}</h1>
            </div>
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300 text-sm"
                type="button">
                <i class="fa-solid fa-plus"></i> Tambah Prodi
            </button>
        </div>
        <div class="overflow-x-auto">
            <form class="max-w-md mx-auto my-4" method="GET" action="{{ route('admin-prodi', ['id_kampus' => $id_kampus]) }}">
                <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
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
                        placeholder="Temukan program studi disini..." value="{{ request('search') }}" />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>

            <!-- Tabel Prodi -->
            <div class="overflow-x-auto">
                @if ($prodis->isEmpty())
                    <div
                        class="text-center p-6 my-6 mx-6 bg-yellow-100 border border-yellow-300 text-yellow-800 rounded-lg mb-6">
                        <p class="text-lg font-semibold">Belum ada program studi pada kampus ini.</p>
                        <p class="mt-2">Silakan tambahkan prodi dengan menekan tombol "Tambah Prodi" di atas.</p>
                    </div>
                @else
                    <table class="w-full border-separate border-spacing-0 text-sm text-black">
                        <thead class="bg-gray-200 text-gray-800">
                            <tr>
                                <th class="p-2 text-center">Kode Prodi</th>
                                <th class="p-2 text-center">Nama Prodi</th>
                                <th class="p-2 text-center">Jurusan</th>
                                <th class="p-2 text-center">Kampus</th>
                                <th class="p-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white text-center" id="dosenTableBody">
                            @foreach ($prodis as $index => $item)
                                <tr class="border-b border-gray-200">
                                    <td class="p-2">{{ $item->kd_prodi }}</td>
                                    <td class="p-2">{{ $item->prodi }}</td>
                                    <td class="p-2">{{ $item->jurusan }}</td>
                                    <td class="p-2">{{ $item->kampus }}</td>
                                    <td class="p-2">
                                        <button type="button" data-modal-target="#edit-item-modal-{{ $item->id_prodi }}"
                                            class="inline-flex items-center justify-center w-8 h-8 text-gray-800 bg-gray-200 border border-gray-300 rounded-sm shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                            <i class="fa-regular fa-pen-to-square text-lg"></i>
                                        </button>
                                        <form id="delete-form-{{ $item->id_prodi }}"
                                            action="{{ route('adminProdi.destroy', ['id_kampus' => $id_kampus, 'id_Prodi' => $item->id_prodi]) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="inline-flex items-center justify-center w-8 h-8 text-white bg-red-700 border border-red-600 rounded shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 ml-1"
                                                onclick="confirmDelete('{{ $item->id_prodi }}', '{{ $item->prodi }}')">
                                                <i class="fa-regular fa-trash-can text-base"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>

                                <!-- Modal Edit Dosen -->
                                <div id="edit-item-modal-{{ $item->id_prodi }}" tabindex="-1" aria-hidden="true"
                                    class="fixed inset-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal hidden">
                                    <div class="relative w-full max-w-full md:max-w-md h-full max-h-full md:h-auto">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button"
                                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="#edit-item-modal-{{ $item->id_prodi }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6 text-center">
                                                <h3 class="text-lg font-semibold text-gray-900">Edit Prodi</h3>
                                                <form
                                                    action="{{ route('adminProdi.update', ['id_kampus' => $id_kampus, 'id_Prodi' => $item->id_prodi]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="text-left">
                                                        <label for="kd_prodi"
                                                            class="block text-sm font-medium text-gray-900">Kode
                                                            Prodi</label>
                                                        <input type="text" name="kd_prodi" id="kd_prodi"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                            placeholder="Masukkan Kode Prodi"
                                                            value="{{ $item->kd_prodi }}">
                                                    </div>
                                                    <div class="text-left mt-4">
                                                        <label for="prodi"
                                                            class="block text-sm font-medium text-gray-900">Nama
                                                            Prodi</label>
                                                        <input type="text" name="prodi" id="prodi"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                            placeholder="Masukkan Nama Prodi"
                                                            value="{{ $item->prodi }}">
                                                    </div>
                                                    <div class="text-left mt-4">
                                                        <label for="jurusan"
                                                            class="block text-sm font-medium text-gray-900">Jurusan</label>
                                                        <input type="text" id="jurusan" name="jurusan"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 mt-1"
                                                            value="{{ $item->jurusan }}" readonly>
                                                    </div>

                                                    <div class="text-left mt-4">
                                                        <label for="kampus"
                                                            class="block text-sm font-medium text-gray-900">Kampus</label>
                                                        <input type="text" id="kampus" name="kampus"
                                                            value="{{ $item->kampus }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 mt-1"
                                                            readonly>
                                                    </div>
                                                    <div class="flex justify-end">
                                                        <button type="submit"
                                                            class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300 font-medium text-sm my-2">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                @endif
                </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Tambah Dosen -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex items-center justify-center w-full h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-between p-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-black">Tambah Prodi</h3>
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
                    <form action="{{ route('adminProdi.store', $id_kampus) }}" method="POST" class="p-4">
                        @csrf
                        <div class="text-left">

                            <input type="hidden" name="id_kampus" id="id_kampus" value="{{ $id_kampus }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="text-left">
                            <label for="kd_prodi" class="block text-sm font-medium text-gray-900">Kode
                                Prodi</label>
                            <input type="text" name="kd_prodi" id="kd_prodi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                placeholder="Masukkan Kode Prodi" required>
                        </div>
                        <div class="text-left mt-4">
                            <label for="prodi" class="block text-sm font-medium text-gray-900">Nama Prodi</label>
                            <input type="text" name="prodi" id="prodi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                placeholder="Masukkan Nama Prodi" required>
                        </div>
                        <div class="text-left mt-4">
                            <label for="jurusan" class="block text-sm font-medium text-gray-900">Jurusan</label>
                            <input type="text" id="jurusan" name="jurusan" value="Teknologi Informasi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 mt-1"
                                readonly>
                        </div>
                        <div class="text-left mt-4">
                            <label for="kampus" class="block text-sm font-medium text-gray-900">Kampus</label>
                            <input type="text" id="kampus" name="kampus" value="{{ $kampus->nama_kampus }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 mt-1"
                                readonly>
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


        function confirmDelete(id, prodi) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan Prodi " + prodi,
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
