<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/daeng.png') }}">
    <title>Masuk Portal - DAENG SUDA Kabupaten Jeneponto</title>

    {{-- Tailwind CSS & Google Fonts --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(1deg); }
        }

        @keyframes float-reverse {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(14px) rotate(-1.5deg); }
        }

        @keyframes pulse-glow {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 0.75; transform: scale(1.08); }
        }

        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.96) translateY(12px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .animate-float-slow {
            animation: float-slow 7s ease-in-out infinite;
        }

        .animate-float-reverse {
            animation: float-reverse 8s ease-in-out infinite;
        }

        .animate-pulse-glow {
            animation: pulse-glow 5s ease-in-out infinite;
        }

        .animate-card-in {
            animation: fadeInScale 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .shimmer-effect::after {
            content: '';
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            transform: translateX(-100%);
            background-image: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0) 0,
                rgba(255, 255, 255, 0.25) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            animation: shimmer 2.8s infinite;
        }
    </style>
</head>
<body class="min-h-screen bg-slate-950 flex items-center justify-center p-3 sm:p-6 lg:p-10 relative overflow-x-hidden selection:bg-emerald-500 selection:text-white"
      x-data="{ showPass: false, isSubmitting: false }">

    {{-- ================= BACKGROUND ANIMATED AMBIENT LIGHTS ================= --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        {{-- Top Right Emerald Orb --}}
        <div class="absolute -top-32 -right-32 w-80 sm:w-[500px] h-80 sm:h-[500px] bg-emerald-500/20 rounded-full blur-[100px] sm:blur-[140px] animate-pulse-glow"></div>
        {{-- Bottom Left Teal/Cyan Orb --}}
        <div class="absolute -bottom-32 -left-32 w-80 sm:w-[500px] h-80 sm:h-[500px] bg-teal-600/20 rounded-full blur-[100px] sm:blur-[140px] animate-pulse-glow" style="animation-delay: 2.5s;"></div>
        {{-- Center Indigo Accent --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-emerald-700/10 rounded-full blur-[120px] pointer-events-none"></div>

        {{-- Subtle Grid Pattern --}}
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff08_1px,transparent_1px)] [background-size:28px_28px] opacity-70"></div>
    </div>

    {{-- ================= MAIN CONTAINER ================= --}}
    <div class="w-full max-w-5xl relative z-10 animate-card-in">
        
        {{-- CARD WRAPPER --}}
        <div class="bg-white/95 backdrop-blur-xl rounded-3xl sm:rounded-[32px] shadow-2xl shadow-black/40 border border-white/20 overflow-hidden grid grid-cols-1 lg:grid-cols-12">
            
            {{-- ================= LEFT HERO BRANDING PANEL (lg:col-span-5) ================= --}}
            <div class="lg:col-span-5 bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-950 p-6 sm:p-10 lg:p-12 text-white flex flex-col justify-between relative overflow-hidden">
                
                {{-- Decorative Ambient Lights Inside Panel --}}
                <div class="absolute -top-24 -left-24 w-56 h-56 bg-emerald-500/25 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-teal-400/20 rounded-full blur-3xl pointer-events-none"></div>

                {{-- Header Inside Panel --}}
                <div class="relative z-10 flex items-center justify-between lg:block">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/15 backdrop-blur-md text-[11px] font-semibold text-emerald-300 shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>Portal Terpadu Pemkab</span>
                    </div>

                    {{-- Mobile Home Link Icon --}}
                    <a href="{{ route('home') }}" class="lg:hidden text-slate-300 hover:text-white text-xs flex items-center gap-1 transition">
                        <span>Beranda</span>
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- Center Graphic: Animated Logo Badge --}}
                <div class="relative z-10 my-8 sm:my-10 lg:my-12 flex flex-col items-center text-center">
                    <div class="relative group">
                        {{-- Outer glowing pulse ring --}}
                        <div class="absolute -inset-2 bg-gradient-to-r from-emerald-500 to-teal-400 rounded-3xl blur-lg opacity-40 group-hover:opacity-75 transition duration-500 animate-pulse-glow"></div>
                        
                        {{-- Logo Container Box --}}
                        <div class="relative w-28 h-28 sm:w-36 sm:h-36 rounded-2xl sm:rounded-3xl bg-slate-900/90 border border-white/20 p-4 sm:p-5 flex items-center justify-center shadow-xl backdrop-blur-md animate-float-slow transition-transform duration-300 group-hover:scale-105">
                            <img src="{{ asset('images/jepot.png') }}" 
                                 alt="Logo Kabupaten Jeneponto" 
                                 class="w-full h-full object-contain drop-shadow-md">
                        </div>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight mt-6 text-white leading-tight">
                        KABUPATEN<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-emerald-200 to-teal-200">
                            JENEPONTO
                        </span>
                    </h1>

                    <div class="mt-2.5 inline-flex items-center gap-1.5 text-xs text-emerald-200/90 font-medium bg-emerald-950/60 border border-emerald-500/30 px-3.5 py-1 rounded-full">
                        <span class="font-bold text-amber-300">DAENG SUDA</span>
                        <span>• Bagian SDA</span>
                    </div>

                    <p class="mt-3 text-xs sm:text-sm text-slate-300/90 max-w-xs font-light leading-relaxed">
                        Data Elektronik Digital Sumber Daya Alam dan Pelaporan ESDM Desa
                    </p>
                </div>

                {{-- Footer Info Inside Panel --}}
                <div class="relative z-10 hidden lg:flex items-center justify-between pt-6 border-t border-white/10 text-[11px] text-slate-400">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        Koneksi Terenkripsi SSL
                    </span>
                    <span>v2.0 Production</span>
                </div>
            </div>

            {{-- ================= RIGHT FORM PANEL (lg:col-span-7) ================= --}}
            <div class="lg:col-span-7 p-6 sm:p-10 lg:p-12 flex flex-col justify-between bg-white relative">
                
                {{-- Form Header --}}
                <div>
                    <div class="flex items-center justify-between mb-6 sm:mb-8">
                        <div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                                Selamat Datang
                            </h2>
                            <p class="text-slate-500 text-xs sm:text-sm mt-1">
                                Silakan masuk dengan akun resmi Anda untuk mengelola portal.
                            </p>
                        </div>

                        {{-- Desktop Home Link --}}
                        <a href="{{ route('home') }}" 
                           class="hidden lg:inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-emerald-700 bg-slate-50 hover:bg-emerald-50 border border-slate-200 hover:border-emerald-200 px-3 py-1.5 rounded-xl transition-all shadow-2xs group">
                            <svg class="w-3.5 h-3.5 group-hover:-translate-x-0.5 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                            <span>Beranda</span>
                        </a>
                    </div>

                    {{-- Role Pills Preview --}}
                    <div class="mb-6 p-2.5 rounded-2xl bg-slate-50 border border-slate-100 flex flex-wrap items-center gap-1.5 text-[11px]">
                        <span class="text-slate-400 font-medium px-1">Akses:</span>
                        <span class="px-2.5 py-0.5 rounded-lg bg-emerald-100/70 text-emerald-800 font-semibold border border-emerald-200/60">Admin SDA</span>
                        <span class="px-2.5 py-0.5 rounded-lg bg-blue-100/70 text-blue-800 font-semibold border border-blue-200/60">Admin Desa</span>
                        <span class="px-2.5 py-0.5 rounded-lg bg-purple-100/70 text-purple-800 font-semibold border border-purple-200/60">Pimpinan</span>
                    </div>

                    {{-- Session Status Alert --}}
                    @if (session('status'))
                        <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl text-xs sm:text-sm flex items-center gap-2.5 shadow-2xs animate-fade-in">
                            <svg class="w-5 h-5 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            <span>{{ session('status') }}</span>
                        </div>
                    @endif

                    {{-- Error Summary Alert --}}
                    @if ($errors->any())
                        <div class="mb-5 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-2xl text-xs sm:text-sm flex items-start gap-2.5 shadow-2xs animate-fade-in">
                            <svg class="w-5 h-5 text-rose-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            <div>
                                <span class="font-bold block">Gagal Masuk:</span>
                                <span class="text-xs text-rose-700">{{ $errors->first() }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- ================= FORM ================= --}}
                    <form method="POST" action="{{ route('login') }}" @submit="isSubmitting = true" class="space-y-4 sm:space-y-5">
                        @csrf

                        {{-- Email Address Field --}}
                        <div>
                            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                Alamat Email
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-600 transition-colors">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                        <polyline points="22,6 12,13 2,6"/>
                                    </svg>
                                </div>
                                <input 
                                    id="email" 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    placeholder="contoh: sda@jeneponto.go.id"
                                    required 
                                    autofocus 
                                    autocomplete="username"
                                    class="w-full pl-11 pr-4 py-3 sm:py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all shadow-2xs"
                                />
                            </div>
                            @error('email')
                                <p class="mt-1.5 text-xs text-rose-600 font-medium flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password Field with Show/Hide Toggle --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                                    Password
                                </label>
                                @if (Route::has('password.request'))
                                    <a class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 hover:underline transition" 
                                       href="{{ route('password.request') }}">
                                        Lupa password?
                                    </a>
                                @endif
                            </div>

                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-600 transition-colors">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                    </svg>
                                </div>
                                <input 
                                    id="password" 
                                    :type="showPass ? 'text' : 'password'" 
                                    name="password" 
                                    placeholder="••••••••••••"
                                    required 
                                    autocomplete="current-password"
                                    class="w-full pl-11 pr-11 py-3 sm:py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all shadow-2xs"
                                />
                                {{-- Password Toggle Button --}}
                                <button 
                                    type="button" 
                                    @click="showPass = !showPass"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none transition-colors"
                                    tabindex="-1"
                                    title="Lihat / Sembunyikan Password">
                                    {{-- Eye icon when hidden --}}
                                    <svg x-show="!showPass" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    {{-- Eye-off icon when visible --}}
                                    <svg x-show="showPass" x-cloak class="w-5 h-5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                                        <line x1="1" y1="1" x2="23" y2="23"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1.5 text-xs text-rose-600 font-medium flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Remember Me Checkbox --}}
                        <div class="flex items-center justify-between pt-1">
                            <label class="flex items-center gap-2.5 cursor-pointer select-none group">
                                <input 
                                    id="remember_me" 
                                    type="checkbox" 
                                    name="remember" 
                                    class="w-4 h-4 rounded-md border-slate-300 text-emerald-600 focus:ring-emerald-500 focus:ring-offset-0 transition cursor-pointer"
                                />
                                <span class="text-xs font-medium text-slate-600 group-hover:text-slate-900 transition">
                                    Ingat saya di perangkat ini
                                </span>
                            </label>
                        </div>

                        {{-- Submit Button with Shimmer & Loading State --}}
                        <button 
                            type="submit" 
                            :disabled="isSubmitting"
                            class="relative w-full py-3.5 px-6 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold text-sm shadow-lg shadow-emerald-600/25 hover:shadow-xl hover:shadow-emerald-600/35 hover:scale-[1.01] active:scale-[0.99] transition-all duration-200 overflow-hidden group disabled:opacity-75 disabled:cursor-not-allowed">
                            
                            {{-- Shimmer Effect --}}
                            <div class="absolute inset-0 shimmer-effect pointer-events-none"></div>

                            {{-- Normal Label --}}
                            <span x-show="!isSubmitting" class="flex items-center justify-center gap-2">
                                <span>Masuk ke Panel Admin</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </span>

                            {{-- Loading Spinner --}}
                            <span x-show="isSubmitting" x-cloak class="flex items-center justify-center gap-2">
                                <svg class="animate-spin w-4 h-4 text-white" viewBox="0 0 24 24" fill="none">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                                <span>Memverifikasi Kredensial...</span>
                            </span>
                        </button>
                    </form>
                </div>

                {{-- Bottom Mobile Footer --}}
                <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left text-xs text-slate-400">
                    <p>© {{ date('Y') }} Bagian SDA Setda Kab. Jeneponto</p>
                    <a href="{{ route('home') }}" class="font-semibold text-emerald-600 hover:text-emerald-700 flex items-center gap-1 transition">
                        <span>← Kembali ke Portal Beranda</span>
                    </a>
                </div>

            </div>
        </div>

    </div>

</body>
</html>