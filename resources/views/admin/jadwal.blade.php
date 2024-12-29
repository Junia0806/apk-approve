{{ $dosenId = null; }}

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
                <p id="nama-dosen" class="text-lg">Silahkan pilih nama dosen terlebih dahulu</p>
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
                        <th colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    {{-- @php
                        // Array jadwal kuliah contoh
                        $jadwal = [
                            [
                                'hari' => 'Senin',
                                'sesi' => '08:00 - 10:00',
                                'mata_kuliah' => 'Algoritma',
                                'dosen' => 'Dr. John Doe',
                            ],
                            [
                                'hari' => 'Senin',
                                'sesi' => '10:00 - 12:00',
                                'mata_kuliah' => 'Database',
                                'dosen' => 'Prof. Jane Doe',
                            ],
                            [
                                'hari' => 'Senin',
                                'sesi' => '13:00 - 15:00',
                                'mata_kuliah' => 'Jaringan',
                                'dosen' => 'Dr. Alan Turing',
                            ],
                            [
                                'hari' => 'Senin',
                                'sesi' => '15:00 - 17:00',
                                'mata_kuliah' => 'Pemrograman Web',
                                'dosen' => 'Mr. Linus Torvalds',
                            ],
                            [
                                'hari' => 'Senin',
                                'sesi' => '08:00 - 10:00',
                                'mata_kuliah' => 'Kecerdasan Buatan',
                                'dosen' => 'Ms. Ada Lovelace',
                            ],
                        ];
                    @endphp
                    @foreach ($jadwal as $i => $data)
                        <tr class="border-b border-gray-200">
                            <td class="px-4 py-4 text-sm text-gray-700">{{ $data['hari'] }}</td>
                            <td class="px-4 py-4 text-sm text-gray-700">{{ $data['sesi'] }}</td>
                            <td class="px-4 py-4 text-sm text-gray-700">{{ $data['mata_kuliah'] }}</td>
                            <td class="px-4 py-4 text-sm text-gray-700">{{ $data['dosen'] }}</td>
                            <td class="p-2">
                                <button type="button" data-modal-target="#edit-item-modal-{{ $i }}"
                                    class="inline-flex items-center justify-center w-8 h-8 text-gray-800 bg-gray-200 border border-gray-300 rounded-sm shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    <i class="fa-regular fa-pen-to-square text-lg"></i>
                                </button>
                                <form id="delete-form-{{ $i }}" action="/" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="inline-flex items-center justify-center w-8 h-8 text-white bg-red-700 border border-red-600 rounded shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 ml-1"
                                        onclick="confirmDelete('{{ $i }}')">
                                        <i class="fa-regular fa-trash-can text-base"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <!-- Modal Edit Dosen -->
                        <div id="edit-item-modal-<?php echo $i; ?>" tabindex="-1" aria-hidden="true"
                            class="fixed inset-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal hidden">
                            <div class="relative w-full max-w-full md:max-w-md h-full max-h-full md:h-auto">
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
                                        <h3 class="text-lg font-semibold text-gray-900 my-4">Edit jadwal</h3>
                                        <form action="/" method="POST" class="space-y-4">
                                            @csrf
                                            @method('PUT')
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
                                                      <option value="08:00 - 10:00">08:00 - 10:00</option>
                                                      <option value="10:00 - 12:00">10:00 - 12:00</option>
                                                      <option value="13:00 - 15:00">13:00 - 15:00</option>
                                                      <option value="15:00 - 17:00">15:00 - 17:00</option>
                                                  </select>
                                              </div>
                  
                                              <div class="text-left">
                                                  <label for="mata_kuliah" class="block text-sm font-medium text-gray-900">Mata
                                                      Kuliah</label>
                                                  <select name="mata_kuliah" id="mata_kuliah"
                                                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                      required>
                                                      <option value="Algoritma">Algoritma</option>
                                                      <option value="Database">Database</option>
                                                      <option value="Jaringan">Jaringan</option>
                                                      <option value="Pemrograman Web">Pemrograman Web</option>
                                                      <option value="Kecerdasan Buatan">Kecerdasan Buatan</option>
                                                  </select>
                                              </div>
                                              <div class="text-left">
                                                  <label for="dosen" class="block text-sm font-medium text-gray-900">Dosen
                                                      Pengampu</label>
                                                  <select name="dosen" id="dosen"
                                                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                      required>
                                                      <option value="Dr. John Doe">Dr. John Doe</option>
                                                      <option value="Prof. Jane Doe">Prof. Jane Doe</option>
                                                      <option value="Dr. Alan Turing">Dr. Alan Turing</option>
                                                      <option value="Mr. Linus Torvalds">Mr. Linus Torvalds</option>
                                                      <option value="Ms. Ada Lovelace">Ms. Ada Lovelace</option>
                                                  </select>
                                              </div>
                  
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
                    @endforeach --}}
                </tbody>
            </table>

            <!-- Modal Edit Approval -->
            <div id="edit-jadwal-modal" tabindex="-1" aria-hidden="true"
                class="fixed inset-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal hidden">
                <div class="relative w-full max-w-md h-full max-h-full md:h-auto">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" onclick="closeModal()"
                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-6 text-center">
                            <h3 class="text-lg font-semibold text-gray-900">Edit Status jadwal</h3>
                            <form id="edit-jadwal-form" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')
                                <div class="text-left">
                                    <label class="block text-sm font-medium text-gray-900">Tanggal</label>
                                    <p id="modal-tanggal"></p>
                                </div>
                                <div class="text-left mt-4">
                                    <label class="block text-sm font-medium text-gray-900">Hari</label>
                                    <p id="modal-hari"></p>
                                </div>
                                <div class="text-left mt-4">
                                    <label class="block text-sm font-medium text-gray-900">Jam</label>
                                    <p id="modal-jam"></p>
                                </div>
                                <div class="text-left mt-4">
                                    <label class="block text-sm font-medium text-gray-900">Nama Mahasiswa</label>
                                    <p id="modal-nama"></p>
                                </div>
                                <div class="text-left mt-4">
                                    <label class="block text-sm font-medium text-gray-900">Keperluan</label>
                                    <p id="modal-keperluan"></p>
                                </div>
                                <div class="text-left mt-4">
                                    <label class="block text-sm font-medium text-gray-900">Status jadwal</label>
                                    <select id="status" name="status"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                        required>
                                        <option value="1">Disetujui</option>
                                        <option value="2">Tidak Disetujui</option>
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
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                                        <option value="{{ $sesi->id_sesi }}">{{ $sesi->jam_awal }} - {{ $sesi->jam_akhir }}</option>
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
                text: "Anda tidak akan dapat mengembalikan sesi perkuliahan ini!",
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

        function openEditModal(index) {
            // Mengatur konten modal (sesuaikan dengan modal updatenya yaa!)
            // document.getElementById(`modal-tanggal`).innerText = tanggal;
            // document.getElementById(`modal-hari`).innerText = hari;
            // document.getElementById(`modal-jam`).innerText = jam;
            // document.getElementById(`modal-nama`).innerText = nama;
            // document.getElementById(`modal-keperluan`).innerText = keperluan;
            // document.getElementById(`status`).value = status;

            // const form = document.getElementById('edit-approval-form');
            // form.action = `/admin/bimbingan/${index}`;

            // Menampilkan modal
            const modal = document.getElementById(`edit-jadwal-modal`);
            modal.classList.remove('hidden');
        }

        function getJadwalByDosen(selectedId) {
            const dosenId = selectedId.value; // ID dosen yang terpilih
            const dosenName = selectedId.options[selectedId.selectedIndex].text; // Nama dosen yang terpilih

            // Memperbarui teks di elemen <p> dengan nama dosen yang terpilih
            const namaDosenElement = document.getElementById('nama-dosen');
            namaDosenElement.innerText = dosenName;

            if (!dosenId) {
                alert("Pilih dosen terlebih dahulu");
                return;
            }

            fetch(`/admin/jadwal/${dosenId}`)
                .then(response => response.json())
                .then(jadwals => {
                    const tableBody = document.getElementById('jadwalTable').querySelector('tbody');
                    tableBody.innerHTML = ''; // Reset tabel    

                    jadwals.forEach(jadwal => {
                        const row = document.createElement('tr');

                        row.innerHTML = `
                            <td class="px-4 py-4 text-sm text-gray-700 text-center">${jadwal.hari}</td>
                            <td class="px-4 py-4 text-sm text-gray-700 text-center">${jadwal.jam_awal} - ${jadwal.jam_akhir}</td>
                            <td class="px-4 py-4 text-sm text-gray-700 text-center">${jadwal.matkul}</td>
                            <td class="px-4 py-4 text-sm text-gray-700 text-center">${jadwal.dosen}</td>
                            <td><button onclick="openEditModal(${jadwal.id_jadwal})"
                                        class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button></td>
                            <td><button onclick="confirmDelete(${jadwal.id_jadwal})"
                                        class="bg-blue-500 text-white px-4 py-2 rounded">Hapus</button></td></td>
                        </td>
                        `;
                        tableBody.appendChild(row);

                    });
                });
        }

        function closeModal() {
            const modal = document.getElementById(`edit-jadwal-modal`);
            modal.classList.add('hidden');
        }

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
