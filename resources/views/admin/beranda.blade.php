@extends('admin.default')

@section('content')
    <div class="container mx-auto p-6 mt-12 bg-gray-50 rounded-lg shadow-lg min-h-screen">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-4 w-full sm:w-auto">
                <label for="tahun_ajaran" class="text-base font-semibold text-gray-800">
                    Tampilkan Berdasarkan Dosen
                </label>
                <select id="tahun_ajaran" name="tahun_ajaran"
                    class="block w-full sm:w-64 py-2 px-3 border border-gray-300 bg-white rounded-md shadow focus:ring-blue-600 focus:border-blue-600 sm:text-base text-gray-700">
                    <option>Rifqi Aji Widarso, S.T. M.T.</option>
                    <option>Adi Sucipto, S.ST., M.Tr.T.</option>
                    <option>Rani Purbaningtyas, S.Kom., MT.</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto shadow rounded-lg border border-gray-200 bg-white bg-nota" id="pdfContent">
            <div class="text-center mb-4">
                <h1 class="text-2xl font-bold">Jadwal Kuliah dan Bimbingan</h1>
                <p class="text-lg">Rifqi Aji Widarso, S.T. M.T.</p>
            </div>
            <table class="w-full border-separate border-spacing-0 text-sm text-black" id="jadwalTable">
                <thead class="bg-gray-200 text-gray-800">
                    <tr>
                        <th class="p-2 text-left">Jam</th>
                        <th class="p-2 text-left">Senin</th>
                        <th class="p-2 text-left">Selasa</th>
                        <th class="p-2 text-left">Rabu</th>
                        <th class="p-2 text-left">Kamis</th>
                        <th class="p-2 text-left">Jumat</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-4 text-sm text-gray-700">08.00 - 09.00</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Jaringan Komputer</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Algoritma</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Matematika Diskrit</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Pemrograman</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Bimbingan</td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-4 text-sm text-gray-700">09.00 - 10.00</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Jaringan Komputer</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Algoritma</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Bimbingan</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Pemrograman</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Pemrograman</td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-4 text-sm text-gray-700">10.00 - 11.00</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Bimbingan</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Sistem Operasi</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Matematika Diskrit</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Jaringan Komputer</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Pemrograman</td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-4 text-sm text-gray-700">11.00 - 12.00</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Basis Data</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Sistem Operasi</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Bimbingan</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Jaringan Komputer</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Bimbingan</td>
                    </tr>
                    <tr class="border-b border-gray-200 bg-gray-100">
                        <td class="px-4 py-4 text-sm text-gray-700">12.00 - 13.00</td>
                        <td colspan="5" class="text-center px-4 py-4 text-sm text-gray-700">Istirahat</td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-4 text-sm text-gray-700">13.00 - 14.00</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Pemrograman Web</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Bimbingan</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Bimbingan</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Basis Data</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Bimbingan</td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-4 text-sm text-gray-700">14.00 - 15.00</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Pemrograman Web</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Bimbingan</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Kecerdasan Buatan</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Basis Data</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Bimbingan</td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-4 text-sm text-gray-700">15.00 - 16.00</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Pemrograman Web</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Bimbingan</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Kecerdasan Buatan</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Bimbingan</td>
                        <td class="px-4 py-4 text-sm text-gray-700">Bimbingan</td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById('downloadBtn').addEventListener('click', function() {
            const element = document.querySelector('#pdfContent');
            html2pdf()
                .from(element)
                .set({
                    margin: 1,
                    filename: 'jadwal_kuliah.pdf',
                    html2canvas: {
                        scale: 2,
                        background: true,
                        useCORS: true
                    },
                    jsPDF: {
                        orientation: 'landscape',
                        unit: 'in',
                        format: 'letter',
                        compressPDF: true
                    }
                })
                .save();
        });
    </script>
@endsection
