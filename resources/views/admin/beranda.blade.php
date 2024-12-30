@extends('admin.default')

@section('content')
    <div class="container mx-auto p-6 mt-12 bg-gray-50 rounded-lg shadow-lg min-h-screen">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-4 w-full sm:w-auto">
                <label for="filterDosen" class="text-base font-semibold text-gray-800">
                    Tampilkan Berdasarkan Dosen
                </label>
                <select id="pilihDosen" name="pilihDosen"
                    class="block w-full sm:w-64 py-2 px-3 border border-gray-300 bg-white rounded-md shadow focus:ring-blue-600 focus:border-blue-600 sm:text-base text-gray-700"
                    onchange="getJadwalByDosen(this)">
                    <option value="">Pilih Dosen</option>
                    @foreach ($dataDosen as $dosen)
                        <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama_dosen }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="overflow-x-auto shadow rounded-lg border border-gray-200 bg-white bg-nota" id="pdfContent">
            <div class="text-center mb-4">
                <h1 class="text-2xl font-bold">Jadwal Kuliah dan Bimbingan</h1>
                <p id="namaDosen" class="text-lg"></p>
            </div>
            <table class="w-full border-separate border-spacing-0 text-sm text-black" id="jadwalTable">
                <thead class="bg-gray-200 text-gray-800">
                    <tr>
                        <th class="p-2 text-left">Jam</th>

                        @foreach ($dataHari as $hari)
                            <th class="p-2 text-left">{{ $hari }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody id="jadwalTable" class="bg-white">

                </tbody>
            </table>
        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        function getJadwalByDosen(selectElement) {
            const dosenId = selectElement.value; // ID dosen yang terpilih
            const dosenName = selectElement.options[selectElement.selectedIndex].text; // Nama dosen yang terpilih
            

            // Memperbarui teks di elemen <p> dengan nama dosen yang terpilih
            const namaDosenElement = document.getElementById('pilihDosen');
            // namaDosenElement.innerText = dosenName;

            if (!dosenId) {
                alert("Pilih dosen terlebih dahulu");
                return;
            }

            fetch(`/admin/dashboard/${dosenId}`)
                .then(response => response.json())
                .then(data => {
                    // Ambil id dari table
                    const tableBody     = document.getElementById('jadwalTable').querySelector('tbody');
                    tableBody.innerHTML = ''; // Reset tabel body ketika melakukan fetching

                    // Ambil Keseluruhan Data
                    const jadwalLengkap = data[0]; // Jadwal yang dikelompokkan berdasarkan hari
                    const dataSesi      = data[1]; // Data sesi
                    const hariKerja     = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']; // Format Hari Kerja

                    // 1. Looping Sesi untuk mendapatkan Jadwal Jamnya
                    dataSesi.forEach(sesi => {
                        const row = document.createElement('tr'); // Buat satu baris untuk sesi
                        const jamCell = document.createElement('td'); // Kolom untuk jam awal dan akhir
                        jamCell.textContent = `${sesi.jam_awal} - ${sesi.jam_akhir}`; // Isi tabel dengan data sesi
                        row.appendChild(jamCell); // terapkan ke tabel

                        // 2. Looping hari kerja agar pengambilan data sesuai dengan data jadwal & Bimbingan
                        hariKerja.forEach(hariKerja => {
                            const kegiatanCell = document.createElement('td'); // Kolom untuk hari
                            const jadwalHari = jadwalLengkap[hariKerja] || []; // Ambil jadwal untuk hari tertentu

                            // Cari apakah ada jadwal yang cocok dengan sesi
                            const jadwal = jadwalHari.find(j => 
                                j.jam_awal === sesi.jam_awal && j.jam_akhir === sesi.jam_akhir
                            );

                            // Jika data jadwal sesuai maka isi konten tabelnya
                            if (jadwal) {
                                kegiatanCell.textContent = `${jadwal.kegiatan}`;
                            } else {
                                // Jika tidak, Maka akan diisi strip
                                kegiatanCell.textContent = '-';
                            }

                            row.appendChild(kegiatanCell); // Tambahkan kolom ke baris
                        });

                        tableBody.appendChild(row); // Tambahkan baris ke tabel
                    });
                })
                // Jika terdapat Error, Pesan akan dimunculkan ke console web
                .catch(error => {
                    console.error('Error fetching data:', error);
                });

        }
    </script>
@endsection
