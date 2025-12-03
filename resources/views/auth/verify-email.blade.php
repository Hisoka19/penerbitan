<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-4" style="background: linear-gradient(135deg, #FF66C4 0%, #fed7e2 50%, #5271FF 100%);">
        <div class="w-full max-w-xl bg-white rounded-2xl shadow-2xl p-12 sm:p-16">
            <div class="flex flex-col items-center mb-8">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="w-50 h-50 object-contain mb-4">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Verifikasi Email Anda</h2>
                <p class="text-gray-600 text-center text-lg">
                    Terima kasih telah mendaftar!  <br> Sebelum mulai, silahkan verifikasi alamat email Anda dengan klik link yang baru saja kami kirimkan ke email Anda.<br>
                    Jika Anda belum menerima email, Silahkan klik tombol Kirim Ulang Email Verifikasi.
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-base text-green-600 text-center">
                    Link verifikasi baru telah dikirim ke email yang Anda daftarkan.
                </div>
            @endif

            <div class="flex flex-col gap-4">
                <form method="POST" action="{{ route('verification.send') }}" class="flex flex-col items-center">
                    @csrf
                    <button type="submit" class="w-full bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 text-white font-semibold py-3.5 px-4 rounded-lg hover:from-pink-500 hover:via-pink-600 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-400 transition duration-150 ease-in-out shadow-lg">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>
                <form method="POST" action="{{ route('logout') }}" class="flex flex-col items-center">
                    @csrf
                    <button type="submit" class="w-full mt-2 underline text-base text-gray-600 hover:text-pink-600 transition duration-150 ease-in-out rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-400">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
