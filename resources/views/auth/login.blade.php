<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Weekly Budget | PT. Fokus Jasa Mitra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        fjm: {
                            red: '#D0021B',
                            blue: '#2D4B9E',
                            green: '#1A7A3C',
                            navy: '#1A1D2E',
                        }
                    },
                    fontFamily: {
                        jakarta: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4">

    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg overflow-hidden flex">

        <!-- ===== PANEL KIRI ===== -->
        <div
            class="hidden md:flex w-5/12 bg-gradient-to-br from-fjm-blue to-fjm-navy flex-col justify-between p-8 relative overflow-hidden">

            <!-- Dekorasi lingkaran -->
            <div class="absolute -top-16 -right-16 w-56 h-56 rounded-full bg-white opacity-5"></div>
            <div class="absolute -bottom-20 -left-10 w-72 h-72 rounded-full bg-fjm-red opacity-10"></div>

            <!-- Logo -->
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    {{-- Sesudah (ganti dengan ini) --}}
                    <div class="mb-4">
                        <img src="{{ asset('storage/logo-h.webp') }}" alt="PT. Fokus Jasa Mitra"
                            class="h-10 w-auto brightness-0 invert">
                    </div>
                </div>
                <div class="w-8 h-0.5 bg-fjm-red rounded-full mb-6"></div>

                <h2 class="text-white text-2xl font-bold leading-snug mb-3">
                    Sistem <span class="text-fjm-red">Weekly Budget</span> Keuangan
                </h2>
                <p class="text-white/50 text-sm leading-relaxed">
                    Kelola dan pantau anggaran mingguan perusahaan secara terpusat, akurat, dan real-time.
                </p>
            </div>

            <!-- Stat cards -->
            <div class="relative z-10 space-y-3">
                <div class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 flex items-center gap-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-fjm-green flex-shrink-0"></span>
                    <span class="text-white/60 text-xs flex-1">Anggaran berjalan</span>
                    <span class="text-white text-xs font-semibold">Minggu 26</span>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 flex items-center gap-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-400 flex-shrink-0"></span>
                    <span class="text-white/60 text-xs flex-1">Realisasi bulan ini</span>
                    <span class="text-white text-xs font-semibold">84%</span>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 flex items-center gap-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-fjm-red flex-shrink-0"></span>
                    <span class="text-white/60 text-xs flex-1">Pengajuan tertunda</span>
                    <span class="text-white text-xs font-semibold">3 item</span>
                </div>
            </div>
        </div>

        <!-- ===== PANEL KANAN (FORM) ===== -->
        <div class="flex-1 flex flex-col justify-center px-8 py-10">

            <!-- Header mobile logo -->
            <div class="flex md:hidden items-center gap-2 mb-6">
                <svg width="32" height="32" viewBox="0 0 40 40" fill="none">
                    <polygon points="2,20 20,4 20,36" fill="#2D4B9E" opacity="0.7" />
                    <polygon points="2,20 20,12 20,28" fill="#9CA3AF" opacity="0.6" />
                    <polygon points="20,4 38,20 20,20" fill="#D0021B" />
                    <polygon points="20,20 38,20 20,36" fill="#1A7A3C" />
                </svg>
                <div>
                    <p class="text-fjm-navy font-semibold text-sm leading-tight">PT. Fokus Jasa Mitra</p>
                    <p class="text-gray-400 text-xs tracking-widest uppercase">Weekly Budget</p>
                </div>
            </div>

            <!-- Judul form -->
            <div class="mb-7">
                <h1 class="text-gray-900 text-xl font-bold mb-1">Masuk ke akun Anda</h1>
                <p class="text-gray-400 text-sm">Gunakan kredensial yang diberikan oleh admin.</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <!-- NIK -->
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">NIK / Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </span>
                        <input name="username" type="text" value="{{ old('username') }}" placeholder="Masukkan NIK atau username"
                            class="w-full h-11 pl-10 pr-4 rounded-lg border border-gray-200 bg-gray-50 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-fjm-blue focus:ring-2 focus:ring-fjm-blue/10 focus:bg-white transition">
                    </div>
                    @error('username')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-2">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </span>
                        <input id="pwd" name="password" type="password" placeholder="Masukkan kata sandi"
                            class="w-full h-11 pl-10 pr-10 rounded-lg border border-gray-200 bg-gray-50 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-fjm-blue focus:ring-2 focus:ring-fjm-blue/10 focus:bg-white transition">
                        <button type="button" onclick="togglePwd()"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600 transition">
                            <svg id="eye-show" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg id="eye-hide" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 hidden"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Lupa sandi -->
                <div class="flex justify-between items-center mb-5">
                    <label class="flex items-center gap-2 text-xs text-gray-500 cursor-pointer select-none">
                        <input type="checkbox" class="w-3.5 h-3.5 rounded border-gray-300 accent-fjm-blue">
                        Ingat saya
                    </label>
                    <a href="#" class="text-xs text-fjm-blue font-medium hover:underline">Lupa kata sandi?</a>
                </div>

                <!-- Tombol masuk -->
                <button type="submit"
                    class="w-full h-11 bg-fjm-red hover:bg-red-700 active:scale-[0.99] text-white text-sm font-semibold rounded-lg transition flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Masuk
                </button>

                {{-- <!-- Divider -->
                <div class="flex items-center gap-3 my-5">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-xs text-gray-400">atau masuk dengan</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <!-- SSO -->
                <button type="button"
                    class="w-full h-11 border border-fjm-blue text-fjm-blue text-sm font-medium rounded-lg hover:bg-fjm-blue/5 active:scale-[0.99] transition flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                    </svg>
                    SSO Petrokimia Gresik Group
                </button> --}}

            </form>

            <!-- Footer -->
            <p class="mt-7 text-xs text-gray-400 text-center leading-relaxed">
                Butuh bantuan? Hubungi
                <a href="mailto:itsupport@fjm.co.id" class="text-fjm-blue hover:underline font-medium">IT Support
                    FJM</a><br>
                &copy; 2026 PT. Fokus Jasa Mitra. Hak cipta dilindungi.
            </p>
        </div>

    </div>

    <script>
        function togglePwd() {
            const input = document.getElementById('pwd');
            const show = document.getElementById('eye-show');
            const hide = document.getElementById('eye-hide');
            if (input.type === 'password') {
                input.type = 'text';
                show.classList.add('hidden');
                hide.classList.remove('hidden');
            } else {
                input.type = 'password';
                show.classList.remove('hidden');
                hide.classList.add('hidden');
            }
        }
    </script>

</body>

</html>
