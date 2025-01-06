@extends('guest.default')

@section('content')
    <div class="container mx-auto p-6 mt-12 min-h-screen">
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-200 p-6">
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
                    <input type="hidden" name='id_kampus' value=4>
                    <input type="text" id="kampus" name="kampus" value="Kampus 4 PSDKU Kabupaten Sidoarjo" readonly
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4 mx-4">
                    <label for="jurusan" class="block text-sm font-bold text-gray-700 mb-2">Jurusan</label>
                    {{-- INFO! Data ini masih menggunakan id Statis. Tidak perlu action apapun disini --}}
                    <input type="hidden" name='id_jurusan' value=1>
                    <input type="text" id="kampus" name="jurusan" value="Teknologi Informasi" readonly
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="mb-4 mx-4">
                    <label for="prodi" class="block text-sm font-bold text-gray-700 mb-2">Program Studi (Prodi)</label>
                    {{-- INFO! Data ini masih menggunakan id Statis. Tidak perlu action apapun disini --}}
                    <input type="hidden" name='id_prodi' value=1>
                    <input type="text" id="kampus" name="prodi" value="Teknik Informatika" readonly
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4 mx-4">
                    <label for="dosen" class="block text-sm font-bold text-gray-700 mb-2">Dosen Pembimbing</label>
                    {{-- EDIT HERE: Lakukan pengeditan disini. Gunakan foreach di option dan Ambil data dosen. 
                        option valuenya adalah id_dosen sedangkan yang muncul adalah nama Dosen --}}
                    <select id="dosen" name="dosen" required
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option disabled>Pilih Dosen</option>
                        <option value="1">Rifqi Aji Widarso, S.T. M.T.</option>
                        <option value="2">Adi Sucipto, S.ST., M.Tr.T.</option>
                        <option value="3">Rani Purbaningtyas, S.Kom., MT.</option>
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
                     {{-- EDIT HERE: Lakukan pengeditan disini. Gunakan foreach di option dan Ambil data Sesi. 
                        option valuenya adalah id_sesi sedangkan yang muncul adalah Daftar Sesinya
                        
                        Note: Sesi ini muncul semua, fitur disable dilewatin dulu karna perlu algortima khusus.
                        --}}
                    <select id="sesi" name="sesi" required
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Sesi</option>
                        <option value="1">Sesi 1 - 08:00</option>
                        <option value="2">Sesi 2 - 09:00</option>
                        <option value="3" disabled>Sesi 3 - 10:00 (Tidak tersedia)</option>
                        <option value="4">Sesi 4 - 11:00</option>
                        <option value="5" disabled>Sesi 5 - 12:00 (Tidak tersedia)</option>
                        <option value="6">Sesi 6 - 13:00</option>
                        <option value="7" disabled>Sesi 7 - 14:00 (Tidak tersedia)</option>
                        <option value="8">Ses   i 8 - 15:00</option>
                    </select>
                </div>
                
            </div>
            <div class="col-span-2 mb-4 mx-4">
                <label for="keperluan" class="block text-sm font-bold text-gray-700 mb-2">Keperluan Bimbingan</label>
                <textarea id="keperluan" name="keperluan" rows="4" placeholder="Masukkan keperluan bimbingan" required
                    class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <div class="col-span-2 text-right my-2 mx-auto">
                <button type="button" id="submitButton"
                    class="w-full md:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none font-bold">
                    Ajukan Jadwal
                </button>
            </div>
        </div>
    </div>
    <script>
        // INFO: Tadi aku coba kirim, apakah ini bukan form submit? Soalnya datanya ndamasuk semua :/ 
        document.getElementById("submitButton").addEventListener("click", function(event) {
            event.preventDefault(); // Mencegah submit form langsung
    
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
                    window.location.href = '/pengajuan/submit';
                }
            });
        });
    </script>
@endsection
