@extends('dosen.default')

@section('content')
<div class="container mx-auto p-6 mt-12 bg-gray-50 rounded-lg shadow-lg min-h-screen">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 space-y-4 sm:space-y-0">
        <div class="flex items-center w-1/4">
            <label for="tahun_ajaran" class="block text-sm font-medium text-gray-700 mr-2">
              Hari
            </label>
            <select id="tahun_ajaran" name="tahun_ajaran" class="block w-full py-2 px-2 border border-gray-300 bg-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <option>Senin</option>
                <option>Selasa</option>
                <option>Rabu</option>
                <option>Kamis</option>
                <option>Jumat</option>
            </select>
        </div>
    </div>

    <!-- Elemen yang akan diunduh sebagai PDF -->
    <div class="overflow-x-auto shadow rounded-lg border border-gray-200 bg-white bg-nota" id="pdfContent">
      <div class="text-center mb-4">
          <h1 class="text-2xl font-bold">Jadwal Kuliah dan Bimbingan</h1>
          <p class="text-lg">Hari Senin</p>
      </div>
      <table class="w-full border-separate border-spacing-0 text-sm text-black" id="jadwalTable">
        <thead class="bg-gray-200 text-gray-800">
            <tr>
              
                <th class="p-2 text-left">Jam</th>
                <th class="p-2 text-left">Jadwal Kuliah</th>
                <th class="p-2 text-left">Jadwal Bimbingan</th>
                <th class="p-2 text-left">Mahasiswa</th>
                <th class="p-2 text-left">Presensi</th>
                <th class="p-2 text-left">Aprroval</th>
                
            </tr>
        </thead>
        <tbody class="bg-white">
            <tr class="border-b border-gray-200">
                <td class="px-4 py-4 text-sm text-gray-700">08.00 - 09.00</td>
                <td class="px-4 py-4 text-sm text-gray-700">Jaringan Komputer</td>
                <td class="px-4 py-4 text-sm text-gray-700">-</td>
                <td class="px-4 py-4 text-sm text-gray-700">-</td>
             
                <td class="px-4 py-4 text-sm text-gray-700">-</td>
                <td class="px-4 py-4 text-sm text-gray-700">-</td>
               
            </tr>
            <tr class="border-b border-gray-200">
              <td class="px-4 py-4 text-sm text-gray-700">09.00 - 10.00</td>
              <td class="px-4 py-4 text-sm text-gray-700">Matematika Diskrit</td>
              <td class="px-4 py-4 text-sm text-gray-700">-</td>
              <td class="px-4 py-4 text-sm text-gray-700">-</td>
          
              <td class="px-4 py-4 text-sm text-gray-700">-</td>
              <td class="px-4 py-4 text-sm text-gray-700">-</td>
         
          </tr>
          <tr class="border-b border-gray-200">
            <td class="px-4 py-4 text-sm text-gray-700">10.00 - 11.00</td>
            <td class="px-4 py-4 text-sm text-gray-700">-</td>
            <td class="px-4 py-4 text-sm text-gray-700">Ada</td>
            <td class="px-4 py-4 text-sm text-gray-700">Junia Vitasari</td>
            
            <td class="px-4 py-4 text-sm text-gray-700">-</td>
            <td class="px-4 py-4 text-sm text-gray-700">Ya</td>
         
        </tr>
        <tr class="border-b border-gray-200">
          <td class="px-4 py-4 text-sm text-gray-700">11.00 - 12.00</td>
          <td class="px-4 py-4 text-sm text-gray-700">-</td>
          <td class="px-4 py-4 text-sm text-gray-700">Ada</td>
          <td class="px-4 py-4 text-sm text-gray-700">Junia Vitasari</td>
      
          <td class="px-4 py-4 text-sm text-gray-700">-</td>
          <td class="px-4 py-4 text-sm text-gray-700">Tidak</td>
 
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