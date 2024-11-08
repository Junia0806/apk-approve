<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bimbingan JTI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-jti flex flex-col items-center justify-center relative">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <h1 class="text-4xl z-10 font-bold text-white mb-6 px-4 text-center typing-effect">Selamat Datang Mahasiswa JTI</h1>
    <div
        class="relative z-10 shadow-2xl rounded-lg p-8 max-w-md w-full text-center bg-white opacity-90 border border-gray-200">
        <p class="text-gray-600 text-lg mb-8 px-4">Pilih kampus untuk melanjutkan pendaftaran bimbingan:</p>
        <div class="grid grid-cols-2 gap-6">
            <button id="kampusPusatBtn"
                class="bg-blue-600 text-white px-8 py-4 rounded-md shadow-lg transform transition duration-300 hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50">
                Kampus Pusat
            </button>
            <button id="kampusBondowosoBtn"
                class="bg-blue-600 text-white px-8 py-4 rounded-md shadow-lg transform transition duration-300 hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50">
                Kampus 2 Bondowoso
            </button>
            <button id="kampusNganjukBtn"
                class="bg-blue-600 text-white px-8 py-4 rounded-md shadow-lg transform transition duration-300 hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50">
                Kampus 3 Nganjuk
            </button>
            <button id="kampusSidoarjoBtn"
                class="bg-blue-600 text-white px-8 py-4 rounded-md shadow-lg transform transition duration-300 hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50">
                Kampus 4 Sidoarjo
            </button>
        </div>
    </div>

    <!-- Modal Pilih Program Studi -->
    <div id="modalProgramStudi"
        class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-96">
            <h2 class="text-xl font-bold text-center mb-4">Pilih Program Studi</h2>
            <div id="programStudiButtons" class="space-y-4">
                <!-- Tombol Program Studi akan dinamis diubah dengan JavaScript -->
            </div>
            <button id="closeModalBtn" class="mt-4 text-red-500 w-full text-center py-2">Tutup</button>
        </div>
    </div>

    <script>
        // Menangani klik tombol Kampus Pusat untuk membuka modal
        document.getElementById('kampusPusatBtn').addEventListener('click', function() {
            openProgramStudiModal(true);
        });

        // Menangani klik tombol Kampus Sidoarjo untuk membuka modal
        document.getElementById('kampusSidoarjoBtn').addEventListener('click', function() {
            openProgramStudiModal(false);
        });

        // Menangani klik tombol tutup untuk menutup modal
        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('modalProgramStudi').classList.add('hidden');
        });

        // Fungsi untuk membuka modal dan mengatur pilihan program studi
        function openProgramStudiModal(isKampusPusat) {
            const modal = document.getElementById('modalProgramStudi');
            const programStudiButtons = document.getElementById('programStudiButtons');
            programStudiButtons.innerHTML = ''; // Reset tombol program studi

            if (isKampusPusat) {
                // Jika kampus pusat, tampilkan 3 pilihan
                programStudiButtons.innerHTML = `
                    <button class="bg-blue-600 text-white px-8 py-4 rounded-md w-full">Teknik Informatika</button>
                    <button class="bg-blue-600 text-white px-8 py-4 rounded-md w-full">Teknik Komputer</button>
                    <button class="bg-blue-600 text-white px-8 py-4 rounded-md w-full">Manajemen Informatika</button>
                `;
            } else {
                // Jika kampus sidoarjo, tampilkan 1 pilihan
                programStudiButtons.innerHTML = `
                  <button onclick="window.location.href='{{ route('dashboard') }}'" class="bg-blue-600 text-white px-8 py-4 rounded-md w-full">
                    Teknik Informatika </button>

                `;
            }

            modal.classList.remove('hidden');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
