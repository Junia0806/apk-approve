@extends('guest.default')

@section('content')
    <div class="container mx-auto p-6 mt-12 min-h-screen">
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-200 p-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center mt-4">Form Pengajuan Jadwal Bimbingan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="mb-4 mx-4">
                    <label for="nim" class="block text-base font-bold text-gray-700 mb-2">NIM</label>
                    <input type="text" id="nim" name="nim" placeholder="Masukkan NIM" required
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4 mx-4">
                    <label for="nama" class="block text-base font-bold text-gray-700 mb-2">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="mb-4 mx-4">
                    <label for="kampus" class="block text-base font-bold text-gray-700 mb-2">Kampus</label>
                    <input type="text" id="kampus" name="kampus" placeholder="Masukkan Kampus" required
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4 mx-4">
                    <label for="jurusan" class="block text-base font-bold text-gray-700 mb-2">Jurusan</label>
                    <select id="jurusan" name="jurusan" required
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Jurusan</option>
                        <option value="jurusan1">Jurusan 1</option>
                        <option value="jurusan2">Jurusan 2</option>
                        <option value="jurusan3">Jurusan 3</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="mb-4 mx-4">
                    <label for="prodi" class="block text-base font-bold text-gray-700 mb-2">Program Studi (Prodi)</label>
                    <select id="prodi" name="prodi" required
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Program Studi</option>
                        <option value="prodi1">Prodi 1</option>
                        <option value="prodi2">Prodi 2</option>
                        <option value="prodi3">Prodi 3</option>
                    </select>
                </div>
                <div class="mb-4 mx-4">
                    <label for="dosen" class="block text-base font-bold text-gray-700 mb-2">Dosen Pembimbing</label>
                    <select id="dosen" name="dosen" required
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Dosen</option>
                        <option value="dosen1">Dosen 1</option>
                        <option value="dosen2">Dosen 2</option>
                        <option value="dosen3">Dosen 3</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="mb-4 mx-4">
                    <label for="tanggal" class="block text-base font-bold text-gray-700 mb-2">Tanggal Bimbingan</label>
                    <input type="date" id="tanggal" name="tanggal" required
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4 mx-4">
                    <label for="slot" class="block text-base font-bold text-gray-700 mb-2">Pilih Slot</label>
                    <select id="slot" name="slot" required
                        class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Slot</option>
                        <option value="slot1">Slot 1</option>
                        <option value="slot2">Slot 2</option>
                        <option value="slot3">Slot 3</option>
                    </select>
                </div>
            </div>
            <div class="col-span-2 mb-4 mx-4">
                <label for="keperluan" class="block text-base font-bold text-gray-700 mb-2">Keperluan Bimbingan</label>
                <textarea id="keperluan" name="keperluan" rows="4" placeholder="Masukkan keperluan bimbingan" required
                    class="w-full px-4 py-3 border rounded-md text-gray-800 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="col-span-2 text-right my-2 mx-auto">
                <button type="submit"
                    class="w-full md:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none font-bold">
                    Ajukan Jadwal
                </button>
            </div>
        </div>
    </div>
@endsection
