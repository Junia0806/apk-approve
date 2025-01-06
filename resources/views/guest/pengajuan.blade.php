@extends('guest.default')

@section('content')
    <div class="container mx-auto p-6 mt-12 min-h-screen">
        <form action="{{ route('submit-pengajuan') }}" method="POST" class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-200 p-6">
            @csrf
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center mt-4">Form Pengajuan Jadwal Bimbingan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="mb-4 mx-4">
                    <label for="nim" class="block text-sm font-bold text-gray-700 mb-2">NIM</label>
                    <input type="text" id="nim" name="nim" placeholder="Masukkan NIM" required
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4 mx-4">
                    <label for="nama" class="block text-sm font-bold text-gray-700 mb-2">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="mb-4 mx-4">
                    <label for="kampus" class="block text-sm font-bold text-gray-700 mb-2">Kampus</label>
                    {{-- INFO! Data ini masih menggunakan id Statis. Tidak perlu action apapun disini --}}
                    <input type="hidden" name='kampus' value=4>
                    <input type="text" id="kampus" name="kampus" value="Kampus 4 PSDKU Kabupaten Sidoarjo" readonly
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4 mx-4">
                    <label for="jurusan" class="block text-sm font-bold text-gray-700 mb-2">Jurusan</label>
                    {{-- INFO! Data ini masih menggunakan id Statis. Tidak perlu action apapun disini --}}
                    <input type="hidden" name='jurusan' value=1>
                    <input type="text" id="jurusan" name="jurusan" value="Teknologi Informasi" readonly
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="mb-4 mx-4">
                    <label for="prodi" class="block text-sm font-bold text-gray-700 mb-2">Program Studi (Prodi)</label>
                    {{-- INFO! Data ini masih menggunakan id Statis. Tidak perlu action apapun disini --}}
                    <input type="hidden" name='prodi' value=1>
                    <input type="text" id="prodi" name="prodi" value="Teknik Informatika" readonly
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4 mx-4">
                    <label for="dosen" class="block text-sm font-bold text-gray-700 mb-2">Dosen Pembimbing</label>
                    {{-- EDIT HERE: Menggunakan foreach untuk menampilkan daftar dosen --}}
                    <select id="dosen" name="dosen" required
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option disabled selected>Pilih Dosen</option>
                        @foreach ($dataDosen as $dosen)
                            <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama_dosen }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="mb-4 mx-4">
                    <label for="tanggal" class="block text-sm font-bold text-gray-700 mb-2">Tanggal Bimbingan</label>
                    <input type="date" id="tanggal" name="tanggal" required
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4 mx-4">
                    <label for="slot" class="block text-sm font-bold text-gray-700 mb-2">Pilih Sesi Bimbingan</label>
                    {{-- Menggunakan foreach untuk menampilkan daftar sesi --}}
                    <select id="sesi" name="sesi" required
                    class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Pilih Sesi</option>
                    @foreach ($dataSesi as $sesi)
                        <option value="{{ $sesi->id_sesi }}" {{ $sesi->disabled ? 'disabled' : '' }}>
                            {{ $sesi->jam_awal }} - {{ $sesi->jam_akhir }}
                        </option>
                    @endforeach
                </select>
                
                </div>
            </div>
            <div class="col-span-2 mb-4 mx-4">
                <label for="keperluan" class="block text-sm font-bold text-gray-700 mb-2">Keperluan Bimbingan</label>
                <textarea id="keperluan" name="keperluan" rows="4" placeholder="Masukkan keperluan bimbingan" required
                    class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <div class="col-span-2 text-right my-2 mx-auto">
                <button type="submit" id="submitButton"
                    class="w-full md:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none font-bold">
                    Ajukan Jadwal
                </button>
            </div>
        </form>
    </div>
    <script>
        // INFO: Tadi aku coba kirim, apakah ini bukan form submit? Soalnya datanya ndamasuk semua :/ 
        document.getElementById("submitButton").addEventListener("click", function(event) {
            event.preventDefault(); 

            Swal.fire({
                title: 'Konfirmasi Pengajuan',
                text: "Pengajuan bimbingan tidak bisa dibatalkan. Periksa kembali.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ajukan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Terimakasih!",
                        text: "Pengajuan bimbingan Anda berhasil dikirimkan",
                        icon: "success",
                        confirmButtonColor: "#388e3c"
                    }).then(() => {
                    document.querySelector('form').submit(); 
                });
                }
            });
        });

           // Fungsi untuk memvalidasi input file dan menampilkan konfirmasi
        //    function validateAndSubmit() {
        //     Swal.fire({
        //         title: "Apakah Anda yakin?",
        //         text: "Anda tidak akan bisa membatalkan pesanan ini!",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#388e3c",
        //         cancelButtonColor: "#d33",
        //         confirmButtonText: "Ya, Pesan"
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             Swal.fire({
        //                 title: "Terimakasih!",
        //                 text: "Pesanan Anda telah di proses. Bukti pembayaran telah dikirim.",
        //                 icon: "success",
        //                 confirmButtonColor: "#388e3c"
        //             }).then(() => {
        //                 // Kirim form setelah konfirmasi
        //                 document.getElementById('order-form').submit();
        //             });
        //         }
        //     });
        // }

    </script>
@endsection
