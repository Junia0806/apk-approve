<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .show-password-toggle {
            cursor: pointer;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4 bg-blue-500">
    <div class="w-full max-w-md mx-auto mt-10 px-4 py-8">
        <!-- Card transparan dengan shadow -->
        <div class="bg-white bg-opacity-60 rounded-lg shadow-lg p-8">
            <div class="mb-6 text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Login</h1>
                <p class="text-lg text-gray-800">Masukkan username dan password</p>
            </div>

            <form class="max-w-sm mx-auto"  action="/dashboard" method="POST">
                @csrf
                <!-- Username -->
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                <div class="flex mb-4">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                        </svg>
                    </span>
                    <input type="text" id="username" name="username"
                        class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 w-full text-sm p-2.5"
                        placeholder="Bonnie Green">
                </div>

                <!-- Password -->
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <div class="flex mb-4">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                        </svg>
                    </span>
                    <input type="password" id="password" name="password"
                        class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 w-full text-sm p-2.5"
                        placeholder="••••••••">
                </div>

                <!-- Toggle Lihat Password -->
                <div class="flex items-center mb-4">
                    <input id="show-password" type="checkbox"
                        class="show-password-toggle w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                    <label for="show-password" class="ml-2 text-sm font-medium text-gray-900">Lihat Password</label>
                </div>

                <!-- Button -->
                <div>
                    <a href="#" 
                       class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 font-medium rounded-lg text-sm py-2.5 text-center block">
                        Login
                    </a>
                </div>
                
            </form>
        </div>
    </div>

    <!-- Script untuk toggle lihat password -->
    <script>
        const showPasswordCheckbox = document.getElementById('show-password');
        const passwordField = document.getElementById('password');

        showPasswordCheckbox.addEventListener('change', function () {
            if (this.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
</body>

</html>