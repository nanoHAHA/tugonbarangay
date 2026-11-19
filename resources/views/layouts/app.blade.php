<!DOCTYPE html>
<html lang="en"
      x-data="{
          darkMode: localStorage.getItem('darkMode') === 'true',
          lang: localStorage.getItem('lang') || 'tl',
          mobileMenu: false
      }"
      x-init="
          $watch('darkMode', val => localStorage.setItem('darkMode', val));
          $watch('lang', val => localStorage.setItem('lang', val));
      "
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TugonBarangay - Citizen Response & Incident Management</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        [x-cloak] {
            display: none !important;
        }

        a:hover {
            color: #38bdf8;
            transition: color 150ms ease;
        }

        a.bg-blue-600:hover,
        a.bg-blue-700:hover,
        a.bg-indigo-600:hover,
        a.bg-indigo-700:hover,
        a.bg-slate-900:hover,
        a.bg-slate-700:hover {
            color: #ffffff;
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 transition-colors duration-300 min-h-screen flex flex-col antialiased">

   
    <header class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
           
            <a href="/" class="flex items-center gap-2.5">
                <span class="w-3 h-3 rounded-full bg-blue-600 ring-4 ring-blue-600/20"></span>
                <span class="font-extrabold text-xl tracking-tight text-slate-900 dark:text-white">
                    Tugon<span class="text-blue-600 dark:text-blue-400">Barangay</span>
                </span>
            </a>

            
            <nav class="hidden md:flex items-center gap-1.5 text-xs font-semibold">

                @guest
                    <a href="/" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('home') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}"
                       x-text="lang === 'tl' ? 'Home' : 'Home'"></a>

                    <a href="/report" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('report') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}"
                       x-text="lang === 'tl' ? 'Mag-ulat' : 'Report Incident'"></a>

                    <a href="/track" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('track') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}"
                       x-text="lang === 'tl' ? 'Mag-track' : 'Track Status'"></a>

                    <a href="/about" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('about') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}"
                       x-text="lang === 'tl' ? 'Tungkol sa Amin' : 'About Us'"></a>

                    <a href="/contact" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('contact') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}"
                       x-text="lang === 'tl' ? 'Contact Us' : 'Contact Us'"></a>

                    <a href="/evaluate" class="px-3.5 py-2 rounded-lg transition {{ request()->routeIs('evaluate') ? 'bg-indigo-700 text-white shadow-sm ring-2 ring-indigo-400/40' : 'bg-indigo-600 hover:bg-indigo-700 text-white' }}"
                       x-text="lang === 'tl' ? 'ISO Evaluation' : 'ISO Evaluation'"></a>
                @endguest

                @auth
                    <a href="/admin/dashboard" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}"
                       x-text="lang === 'tl' ? 'Admin Command' : 'Admin Command'"></a>

                    <a href="/admin/archives" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.archives') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}"
                       x-text="lang === 'tl' ? 'Archives' : 'Blotter Archives'"></a>

                    <a href="/admin/messages" class="px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.messages') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}"
                       x-text="lang === 'tl' ? 'Mensahe' : 'Messages'"></a>

                    <a href="/evaluate" class="px-3.5 py-2 rounded-lg transition {{ request()->routeIs('evaluate') ? 'bg-indigo-700 text-white shadow-sm ring-2 ring-indigo-400/40' : 'bg-indigo-600 hover:bg-indigo-700 text-white' }}"
                       x-text="lang === 'tl' ? 'ISO Evaluation' : 'ISO Evaluation'"></a>
                @endauth

            </nav>

            
            <div class="flex items-center gap-2.5">
                
                <button type="button"
                        @click="lang = (lang === 'tl' ? 'en' : 'tl')"
                        class="px-3 py-1.5 rounded-lg text-xs font-bold border border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:border-sky-400 transition cursor-pointer">
                    <span x-text="lang === 'tl' ? '🇵🇭 TL' : '🇺🇸 EN'"></span>
                </button>

                
                <button type="button"
                        @click="darkMode = !darkMode"
                        class="p-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:border-sky-400 transition cursor-pointer"
                        title="Toggle Theme"
                        aria-label="Toggle Theme">
                
                    <svg x-show="!darkMode"
                         class="w-4 h-4 text-slate-700 dark:text-slate-200"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                    </svg>

                   
                    <svg x-show="darkMode"
                         x-cloak
                         class="w-4 h-4 text-amber-400"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>

              
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-50 dark:bg-red-950/50 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800 hover:bg-red-100 transition cursor-pointer"
                                x-text="lang === 'tl' ? 'Logout' : 'Logout'">
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-900 dark:bg-slate-700 text-white hover:bg-slate-800 transition"
                       x-text="lang === 'tl' ? 'Staff Login' : 'Staff Login'">
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    
    <footer class="bg-slate-900 border-t border-slate-800 text-slate-300 py-12 mt-16 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 pb-8 border-b border-slate-800">

                
                <div class="space-y-3 md:col-span-1">
                    <div class="flex items-center gap-2.5">
                        <span class="w-3 h-3 rounded-full bg-blue-600 ring-4 ring-blue-600/20"></span>
                        <span class="font-extrabold text-xl tracking-tight text-white">
                            Tugon<span class="text-blue-400">Barangay</span>
                        </span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Empowering Barangays Through Digital Governance. A modern web-based citizen response and incident management system.
                    </p>
                </div>

                
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-white mb-3">Quick Links</h3>
                    <ul class="space-y-2 text-xs">
                        <li><a href="/" class="hover:text-sky-400 transition">Home</a></li>
                        <li><a href="/report" class="hover:text-sky-400 transition">Report Incident</a></li>
                        <li><a href="/track" class="hover:text-sky-400 transition">Track Status</a></li>
                        <li><a href="/evaluate" class="hover:text-sky-400 transition">ISO Evaluation</a></li>
                    </ul>
                </div>

               
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-white mb-3">Our Services</h3>
                    <ul class="space-y-2 text-xs">
                        <li class="text-slate-400">Incident Reporting & GPS</li>
                        <li class="text-slate-400">Blotter Archives</li>
                        <li class="text-slate-400">Real-time Status Tracking</li>
                        <li class="text-slate-400">ISO/IEC 25010 Compliance</li>
                    </ul>
                </div>

            
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-white mb-4">Get in Touch</h4>
                    <ul class="space-y-2.5 text-sm text-slate-300">
                        <li>
                            <div x-data="{ copied: false }" class="inline-flex items-center gap-2 flex-wrap">
                                <button type="button"
                                        @click="
                                            navigator.clipboard?.writeText('info@tugonbarangay.ph');
                                            copied = true;
                                            setTimeout(() => copied = false, 2000);
                                        "
                                        class="group inline-flex items-center gap-2.5 text-sm text-slate-300 hover:text-sky-400 transition cursor-pointer text-left">
                                    <svg class="w-4 h-4 text-sky-400 group-hover:text-sky-300 transition shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span>info@tugonbarangay.ph</span>
                                </button>

                                <span x-show="copied"
                                      x-cloak
                                      class="px-2 py-0.5 text-[11px] font-semibold rounded-md bg-emerald-500/20 text-emerald-300 border border-emerald-500/30"
                                      x-text="lang === 'tl' ? 'Nakopya!' : 'Copied!'"></span>
                            </div>
                        </li>
                        <li>
                            <a href="tel:09566355199"
                               class="group inline-flex items-center gap-2.5 text-sm text-slate-300 hover:text-emerald-400 transition">
                                <svg class="w-4 h-4 text-emerald-400 group-hover:text-emerald-300 transition shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span>09566355199</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

           
            <div class="pt-6 text-center text-xs text-slate-400">
                Copyright &copy; 2026 TugonBarangay. All rights reserved. &bull; ISO/IEC 25010 Compliant &bull; Data Privacy Act (RA 10173)
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>