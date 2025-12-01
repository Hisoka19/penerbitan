<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Penerbitan ISBN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=literata:400,500,600,700|inter:400,500,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #FF66C4 0%, #fed7e2 50%, #5271FF 100%);
            min-height: 100vh;
        }
        .book-title {
            font-family: 'Literata', serif;
            position: relative;
        }
        .book-shadow {
            box-shadow: 
                0 1px 1px rgba(0,0,0,0.15),
                0 2px 2px rgba(0,0,0,0.15),
                0 4px 4px rgba(0,0,0,0.15),
                0 8px 8px rgba(0,0,0,0.15);
        }
        .page-corner {
            position: relative;
            overflow: hidden;
        }
        .page-corner::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 40px 40px 0;
            border-color: transparent #f3f4f6 transparent transparent;
            opacity: 0.5;
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-5xl flex bg-white rounded-2xl overflow-hidden book-shadow">
            <!-- Left Side - Illustration/Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-white p-0 relative page-corner">
                <img src="{{ asset('images/loginbackground.png') }}" alt="Register Background" class="w-full h-full object-cover object-center rounded-l-2xl">
            </div>
            <!-- Right Side - Register Form -->
            <div class="w-full lg:w-1/2 p-8 sm:p-12 lg:p-16">
                <div class="max-w-md mx-auto">
                    <!-- Logo Perusahaan -->
                    <div class="mb-8 text-center">
                        <img src="{{ asset('images/Logo.png') }}" alt="Logo Perusahaan" class="w-45 h-45 object-contain mx-auto mb-4">
                    </div>
                    <!-- Header -->
                    <div class="mb-10">
                        <div class="lg:hidden mb-6 text-center">
                            <svg class="w-20 h-20 text-pink-600 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 4H7a2 2 0 00-2 2v11a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2z"/>
                                <path d="M7 22h14a2 2 0 002-2v-1H7a2 2 0 00-2 2v1h2z" opacity="0.7"/>
                            </svg>
                        </div>
                        <h2 class="book-title text-3xl font-bold text-gray-800 mb-2 text-center">Daftar Akun</h2>
                        <p class="text-gray-600 text-center">Buat akun penerbitan buku ISBN Anda</p>
                    </div>
                    <!-- Register Form -->
                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                                    class="block w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition duration-150 ease-in-out text-gray-900 placeholder-gray-400"
                                    placeholder="Nama lengkap">
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                                    class="block w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition duration-150 ease-in-out text-gray-900 placeholder-gray-400"
                                    placeholder="nama@email.com">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input id="password" type="password" name="password" required autocomplete="new-password"
                                    class="block w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition duration-150 ease-in-out text-gray-900 placeholder-gray-400"
                                    placeholder="Password minimal 8 karakter">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                    class="block w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition duration-150 ease-in-out text-gray-900 placeholder-gray-400"
                                    placeholder="Ulangi password">
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <!-- Register Button -->
                        <button type="submit" class="w-full bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 text-white font-semibold py-3.5 px-4 rounded-lg hover:from-pink-500 hover:via-pink-600 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-400 transform hover:scale-[1.02] transition duration-150 ease-in-out shadow-lg">
                            Daftar
                        </button>
                        <!-- Login Link -->
                        <div class="text-center pt-4">
                            <p class="text-sm text-gray-600">
                                Sudah punya akun?
                                <a href="{{ route('login') }}" class="font-medium text-pink-600 hover:text-pink-700 transition duration-150 ease-in-out">
                                    Masuk di sini
                                </a>
                            </p>
                        </div>
                    </form>
                    <!-- Footer -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <p class="text-xs text-center text-gray-500">
                            © {{ date('Y') }} Winnicode Publisher. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
