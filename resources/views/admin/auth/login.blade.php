<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk Portal Admin - PPID ARKAN</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons 6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        },
                        navy: {
                            900: '#0b1120',
                            950: '#060a14',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .bg-grid {
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="h-full font-sans antialiased bg-slate-950 text-slate-100 flex items-center justify-center p-4 sm:p-6 relative overflow-hidden bg-grid">

    <!-- Ambient glowing light spots -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10" x-data="{ showPassword: false }">

        <!-- Back to Website Link -->
        <div class="mb-6 text-center">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-xs font-medium text-slate-400 hover:text-white transition py-1.5 px-3 rounded-xl bg-slate-800/50 hover:bg-slate-800 border border-slate-700/50 backdrop-blur-sm">
                <i class="fa-solid fa-arrow-left text-[11px]"></i>
                <span>Kembali ke Beranda Website</span>
            </a>
        </div>

        <!-- Login Card -->
        <div class="rounded-3xl bg-slate-900/90 border border-slate-800/90 shadow-2xl p-6 sm:p-8 backdrop-blur-xl">
            
            <!-- Branding Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-sky-400 p-0.5 shadow-xl shadow-blue-500/25 mb-4">
                    <div class="w-full h-full bg-slate-950/40 rounded-[14px] flex items-center justify-center text-white">
                        <i class="fa-solid fa-landmark text-2xl"></i>
                    </div>
                </div>
                <h1 class="text-2xl font-black tracking-tight text-white">PPID ARKAN</h1>
                <p class="text-xs font-semibold uppercase tracking-wider text-blue-400 mt-1">Portal Administrator</p>
                <p class="text-xs text-slate-400 mt-2">Silakan masuk menggunakan kredensial akun terdaftar</p>
            </div>

            <!-- Validation Errors Alert -->
            @if(isset($errors) && $errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-rose-950/50 border border-rose-800/60 text-rose-200">
                    <div class="flex items-center gap-2 font-semibold text-xs mb-1">
                        <i class="fa-solid fa-circle-exclamation text-rose-400"></i>
                        <span>Gagal masuk, periksa kembali input Anda:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-0.5 text-rose-300/90 pl-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-2xl bg-rose-950/50 border border-rose-800/60 text-rose-200 flex items-center gap-2.5 text-xs">
                    <i class="fa-solid fa-triangle-exclamation text-rose-400 shrink-0"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(session('status'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-950/50 border border-emerald-800/60 text-emerald-200 flex items-center gap-2.5 text-xs">
                    <i class="fa-solid fa-circle-check text-emerald-400 shrink-0"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ Route::has('admin.login.submit') ? route('admin.login.submit') : (Route::has('admin.login') ? route('admin.login') : url('/admin/login')) }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-300 mb-1.5">
                        Alamat Email
                    </label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i class="fa-solid fa-envelope text-sm"></i>
                        </div>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="{{ old('email', 'admin@ppidarkan.go.id') }}" 
                               required 
                               autofocus
                               placeholder="admin@ppidarkan.go.id"
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-800/80 border border-slate-700 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-semibold text-slate-300">
                            Kata Sandi
                        </label>
                    </div>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </div>
                        <input :type="showPassword ? 'text' : 'password'" 
                               name="password" 
                               id="password" 
                               value="password"
                               required 
                               placeholder="••••••••"
                               class="w-full pl-10 pr-10 py-2.5 bg-slate-800/80 border border-slate-700 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <button type="button" 
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-200">
                            <i :class="showPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-400 hover:text-slate-300">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded bg-slate-800 border-slate-700 text-blue-600 focus:ring-blue-500 focus:ring-offset-slate-900">
                        <span>Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-semibold text-sm shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-150 flex items-center justify-center gap-2">
                    <span>Masuk ke Panel Admin</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>

            <!-- Demo Hint Box -->
            <div class="mt-6 pt-5 border-t border-slate-800 text-center">
                <p class="text-[11px] text-slate-400">
                    <span class="text-slate-500">Kredensial Default:</span><br>
                    <span class="text-blue-400 font-mono">admin@ppidarkan.go.id</span> / <span class="text-blue-400 font-mono">password</span>
                </p>
            </div>

        </div>

        <!-- Footer Notice -->
        <p class="text-center text-xs text-slate-400 mt-6">
            &copy; {{ date('Y') }} PPID Arkan &bull; Sistem Pengelolaan Informasi Publik
        </p>
    </div>

</body>
</html>
