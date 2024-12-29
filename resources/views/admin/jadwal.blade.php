{{ $dosenId = null }}

@extends('admin.default')
@section('content')
    <div class="container mx-auto p-6 mt-12 min-h-screen">
        <div class="flex items-center space-x-4 w-full sm:w-auto">
            <label for="tahun_ajaran" class="text-base font-semibold text-gray-800">
                Tampilkan Berdasarkan Dosen
            </label>
            <select id="tahun_ajaran" name="tahun_ajaran"
                class="block w-full sm:w-64 py-2 px-3 border border-gray-300 bg-white rounded-md shadow focus:ring-blue-600 focus:border-blue-600 sm:text-base text-gray-700"
                onchange="getJadwalByDosen(this)">
                <option dosenListvalue="">Pilih Dosen</option>
                @foreach ($dosenList as $dosen)
                    <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama_dosen }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-between p-2 border-b">
            <div class="flex-1 text-center">
                <h1 class="text-3xl font-bold text-gray-800">Jadwal</h1>
                <p id="nama-dosen" class="text-lg">Menampilkan Jadwal Perkuliahan Seluruh Dosen</p>
            </div>
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300 text-sm"
                type="button">
                <i class="fa-solid fa-plus"></i> Jadwal
            </button>
        </div>

        <div class="overflow-x-auto shadow rounded-lg border border-gray-200 bg-white my-4">
            <table id="jadwalTable" class="w-full border-separate border-spacing-0 text-sm text-black">
                <thead class="bg-gray-200 text-gray-800">
                    <tr>
                        <th class="p-2 text-center">Hari</th>
                        <th class="p-2 text-center">Sesi</th>
                        <th class="p-2 text-center">Mata Kuliah</th>
                        <th class="p-2 text-center">Dosen Pengampu</th>
                        <!-- Kolom Aksi, hanya ditampilkan jika dosen belum dipilih -->
                        <th class="p-2 text-center" id="aksi-column" >Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($jadwals as $jadwal)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $jadwal['hari'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $jadwal['jam_awal'] }} -
                                {{ $jadwal['jam_akhir'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $jadwal['matkul'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $jadwal['dosen'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center ">
                                <button type="button" data-modal-target="#edit-item-modal-{{ $jadwal['id_jadwal'] }}"
                                    class="inline-flex items-center justify-center w-8 h-8 text-gray-800 bg-gray-200 border border-gray-300 rounded-sm shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    <i class="fa-regular fa-pen-to-square text-lg"></i>
                                </button>
                                <form id="delete-form-{{ $jadwal['id_jadwal'] }}"
                                    action="{{ route('adminJadwal.destroy', $jadwal['id_jadwal']) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="inline-flex items-center justify-center w-8 h-8 text-white bg-red-700 border border-red-600 rounded shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 ml-1"
                                        onclick="confirmDelete('{{ $jadwal['id_jadwal'] }}')">
                                        <i class="fa-regular fa-trash-can text-base"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            @foreach ($jadwals as $jadwal)
                <div id="edit-item-modal-{{ $jadwal['id_jadwal'] }}" tabindex="-1" aria-hidden="true"
                    class="fixed inset-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal hidden">
                    <div class="relative w-full max-w-md h-full max-h-full md:h-auto">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Close button -->
                            <button type="button" onclick="closeModal('{{ $jadwal['id_jadwal'] }}')"
                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-6 text-center">
                                <h3 class="text-lg font-semibold text-gray-900">Edit jadwal {{ $jadwal['id_jadwal'] }}</h3>
                                <form action="{{ route('adminJadwal.update', $jadwal['id_jadwal']) }}"
                                    id="edit-jadwal-form-{{ $jadwal['id_jadwal'] }}" method="POST" class="space-y-6">
                                    @csrf
                                    @method('PUT')

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <input type="hidden" name="id_jadwal" value="{{ $jadwal['id_jadwal'] }}">

                                        <div class="text-left">
                                            <label for="hari"
                                                class="block text-sm font-medium text-gray-900">Hari</label>
                                            <div class="mb-2">
                                                <p class="text-gray-700">{{ $jadwal['hari'] }}</p>
                                            </div>
                                            <select name="hari" id="hari"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                required>
                                                <option value="Senin">Senin</option>
                                                <option value="Selasa">Selasa</option>
                                                <option value="Rabu">Rabu</option>
                                                <option value="Kamis">Kamis</option>
                                                <option value="Jumat">Jumat</option>
                                            </select>
                                        </div>

                                        <div class="text-left">
                                            <label for="sesi"
                                                class="block text-sm font-medium text-gray-900">Sesi</label>
                                            <div class="mb-2">
                                                <p class="text-gray-700">{{ $jadwal['jam_awal'] }} -
                                                    {{ $jadwal['jam_akhir'] }}</p>
                                            </div>
                                            <select name="sesi" id="sesi"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                required>
                                                @foreach ($sesiList as $sesi)
                                                    <option value="{{ $sesi->id_sesi }}">{{ $sesi->jam_awal }} -
                                                        {{ $sesi->jam_akhir }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="text-left">
                                            <label for="matkul" class="block text-sm font-medium text-gray-900">Mata
                                                Kuliah</label>
                                            <div class="mb-2">
                                                <p class="text-gray-700">{{ $jadwal['matkul'] }}</p>
                                            </div>
                                            <select name="matkul" id="matkul"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                required>
                                                @foreach ($matkulList as $matkul)
                                                    <option value="{{ $matkul->id_matkul }}">{{ $matkul->matkul }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="text-left">
                                            <label for="dosen" class="block text-sm font-medium text-gray-900">Dosen
                                                Pengampu</label>
                                            <div class="mb-2">
                                                <p class="text-gray-700">{{ $jadwal['dosen'] }}</p>
                                            </div>
                                            <select name="dosen" id="dosen"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                required>
                                                @foreach ($dosenList as $dosen)
                                                    <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama_dosen }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
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
            @endforeach
        </div>

        <!-- Modal Tambah Dosen -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex items-center justify-center w-full h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-6 w-full max-w-lg max-h-full"> <!-- Memperbesar modal -->
                <div class="relative bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-between p-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-black">Tambah jadwal</h3>
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
                    <form action="{{ route('adminJadwal.store') }}" method="POST" class="p-4">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-left">
                                <label for="hari" class="block text-sm font-medium text-gray-900">Hari</label>
                                <select name="hari" id="hari"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                    required>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                </select>
                            </div>

                            <div class="text-left">
                                <label for="sesi" class="block text-sm font-medium text-gray-900">Sesi</label>
                                <select name="sesi" id="sesi"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                    required>

                                    @foreach ($sesiList as $sesi)
                                        <option value="{{ $sesi->id_sesi }}">{{ $sesi->jam_awal }} -
                                            {{ $sesi->jam_akhir }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="text-left">
                                <label for="mata_kuliah" class="block text-sm font-medium text-gray-900">Mata
                                    Kuliah</label>
                                <select name="mata_kuliah" id="mata_kuliah"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                    required>

                                    @foreach ($matkulList as $matkul)
                                        <option value="{{ $matkul->id_matkul }}">{{ $matkul->matkul }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-left">
                                <label for="dosen" class="block text-sm font-medium text-gray-900">Dosen
                                    Pengampu</label>
                                <select name="dosen" id="dosen"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                    required>
                                    @foreach ($dosenList as $dosen)
                                        <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama_dosen }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="submit"
                                class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300 font-medium text-sm">
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
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan jadwal perkuliahan" + id,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form penghapusan
                    const form = document.getElementById('delete-form-' + id);
                    if (form) {
                        form.submit();
                    } else {
                        console.error(`Form dengan id delete-form-${id} tidak ditemukan.`);
                    }
                }
            });
        }

        function getJadwalByDosen(selectedId) {
            const dosenId = selectedId.value; // ID dosen yang terpilih
            const dosenName = selectedId.options[selectedId.selectedIndex].text; // Nama dosen yang terpilih

            // Memperbarui teks di elemen <p> dengan nama dosen yang terpilih
            const namaDosenElement = document.getElementById('nama-dosen');
            namaDosenElement.innerText = dosenName;

            const tableBody = document.getElementById('jadwalTable').querySelector('tbody');
            const aksiColumn = document.getElementById('aksi-column'); // Kolom Aksi

            tableBody.innerHTML = ''; // Reset tabel

            // Tampilkan kolom aksi jika dosen belum dipilih
            if (!dosenId) {
                aksiColumn.style.display = 'table-cell'; // Menampilkan kolom Aksi
                // Fetch seluruh data jadwal
                fetch('/admin/jadwal')
                    .then(response => response.json())
                    .then(jadwals => {
                        jadwals.forEach(jadwal => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                        <td class="px-4 py-4 text-sm text-gray-700 text-center">${jadwal.hari}</td>
                        <td class="px-4 py-4 text-sm text-gray-700 text-center">${jadwal.jam_awal} - ${jadwal.jam_akhir}</td>
                        <td class="px-4 py-4 text-sm text-gray-700 text-center">${jadwal.matkul}</td>
                        <td class="px-4 py-4 text-sm text-gray-700 text-center">${jadwal.dosen}</td>
                        <td class="text-center">
                            <button onclick="openEditModal(${jadwal.id_jadwal})" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button>
                            <button onclick="confirmDelete(${jadwal.id_jadwal})" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
                        </td>
                    `;
                            tableBody.appendChild(row);
                        });
                    });
            } else {
                // Jika dosen dipilih, sembunyikan kolom aksi
                aksiColumn.style.display = 'none'; // Sembunyikan kolom Aksi
                // Fetch jadwal berdasarkan dosen yang dipilih
                fetch(`/admin/jadwal/${dosenId}`)
                    .then(response => response.json())
                    .then(jadwals => {
                        jadwals.forEach(jadwal => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                        <td class="px-4 py-4 text-sm text-gray-700 text-center">${jadwal.hari}</td>
                        <td class="px-4 py-4 text-sm text-gray-700 text-center">${jadwal.jam_awal} - ${jadwal.jam_akhir}</td>
                        <td class="px-4 py-4 text-sm text-gray-700 text-center">${jadwal.matkul}</td>
                        <td class="px-4 py-4 text-sm text-gray-700 text-center">${jadwal.dosen}</td>
                    `;
                            tableBody.appendChild(row);
                        });
                    });
            }
        }

        function openEditModal(id) {
            // Menampilkan modal edit
            const modal = document.getElementById('edit-jadwal-modal');
            if (modal) {
                modal.classList.remove('hidden');
                // Memuat data jadwal berdasarkan ID
                fetch(`/jadwal/${id}/edit`) // Endpoint untuk mendapatkan data jadwal
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            // Mengisi form modal dengan data jadwal yang sudah ada
                            document.getElementById('editMatkul').value = data.id_matkul;
                            document.getElementById('editSesi').value = data.id_sesi;
                            document.getElementById('editDosen').value = data.id_dosen;
                            document.getElementById('editHari').value = data.hari;

                            // Update form action untuk mengarah ke endpoint update jadwal
                            document.getElementById('editJadwalForm').action = `/jadwal/${id}`;

                        } else {
                            console.error('Data jadwal tidak ditemukan.');
                        }
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan:', error);
                        alert('Gagal memuat data jadwal. Silakan coba lagi.');
                    });
            } else {
                console.error('Modal edit tidak ditemukan.');
            }
        }

        // Close modal function
        function closeModal(jadwalId) {
            const modal = document.getElementById(`edit-item-modal-${jadwalId}`);
            modal.classList.add('hidden'); // Hide modal
        }
        document.querySelectorAll('[data-modal-target]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-target');
                const modal = document.querySelector(modalId);
                if (modal) {
                    modal.classList.remove('hidden');
                } else {
                    console.error(`Modal dengan ID ${modalId} tidak ditemukan.`);
                }
            });
        });

        document.querySelectorAll('[data-modal-hide]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-hide');
                const modal = document.querySelector(modalId);
                if (modal) {
                    modal.classList.add('hidden');
                } else {
                    console.error(`Modal dengan ID ${modalId} tidak ditemukan.`);
                }
            });
        });
    </script>
@endsection
