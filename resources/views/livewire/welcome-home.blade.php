<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">
    
    <div style="background: linear-gradient(135deg, #0b1942 0%, #102359 50%, #050a1a 100%);" class="relative overflow-hidden rounded-3xl p-8 md:p-14 text-white shadow-2xl border border-blue-500/20">
        
        <div style="position: absolute; inset: 0; pointer-events: none; z-index: 1; display: flex; align-items: center; justify-content: center; opacity: 0.35;">
            <video 
                src="{{ asset('videos/sphere-bg.mp4.mp4') }}"
                autoplay 
                loop 
                muted 
                playsinline 
                style="width: 550px; height: 550px; object-fit: cover; border-radius: 9999px; mix-blend-mode: screen; -webkit-mask-image: radial-gradient(circle, black 50%, transparent 85%); mask-image: radial-gradient(circle, black 50%, transparent 85%);"
            ></video>
        </div>

      
        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
            <div class="lg:col-span-2 space-y-6">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-blue-500/20 border border-blue-400/30 text-blue-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    TugonBarangay Platform v2.0 (TALL Stack)
                </span>

                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight leading-tight"
                    x-text="lang === 'tl' ? 'Makabagong Web-Based Citizen Response at Incident Management' : 'Modern Web-Based Citizen Response & Incident Management'">
                </h1>

                <p class="text-blue-100/90 text-base md:text-lg max-w-2xl leading-relaxed"
                   x-text="lang === 'tl' ? 'Isang mabilis, transparent, at geotagged na digital na solusyon para sa pag-uulat ng insidente, command-center verification, at digital blotter record-keeping ng komunidad.' : 'A fast, transparent, and geotagged digital solution for community incident reporting, command-center verification, and digital blotter record-keeping.'">
                </p>

                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="/report"
                       class="px-6 py-3.5 rounded-xl bg-white text-blue-900 font-bold text-sm shadow-lg hover:bg-blue-50 hover:scale-[1.02] transition transform flex items-center gap-2">
                        <span x-text="lang === 'tl' ? 'Mag-ulat ng Insidente' : 'Report an Incident'"></span>
                    </a>
                    <a href="/track"
                       class="px-6 py-3.5 rounded-xl bg-slate-900/60 border border-white/20 text-white font-semibold text-sm hover:bg-slate-900/80 transition flex items-center gap-2">
                        <span x-text="lang === 'tl' ? 'I-track ang Status' : 'Track Report Status'"></span>
                    </a>
                </div>
            </div>

            
            <div class="bg-slate-950/50 backdrop-blur-md border border-white/20 rounded-2xl p-6 text-center space-y-3 shadow-inner">
                <div class="w-12 h-12 mx-auto rounded-xl bg-blue-500/30 flex items-center justify-center text-2xl">🛡️</div>
                <h3 class="font-bold text-lg">ISO/IEC 25010 Ready</h3>
                <p class="text-xs text-blue-100/80 leading-relaxed"
                   x-text="lang === 'tl' ? 'Sinuri batay sa pamantayan ng Functional Suitability, Performance Efficiency, Usability, Reliability, Security, at Portability.' : 'Evaluated against Functional Suitability, Performance Efficiency, Usability, Reliability, Security, and Portability standards.'">
                </p>
            </div>
        </div>
    </div>

   
    <div class="space-y-6">
        <div class="text-center max-w-2xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white"
                x-text="lang === 'tl' ? 'Mga Pangunahing Modulo ng Sistema' : 'Core System Modules'">
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1"
               x-text="lang === 'tl' ? 'Pumili ng modulo upang magamit ang mga serbisyo ng TugonBarangay.' : 'Select a module to access TugonBarangay services.'">
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-rose-600 dark:text-rose-400 mb-4">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
</div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Report Submission</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-2 leading-relaxed"
                       x-text="lang === 'tl' ? 'Nagbibigay-daan sa mga residente na magsumite ng reklamo o insidente nang may kategorya, GPS geotagging, at ebidensyang larawan.' : 'Enables residents to submit incident reports with structured categories, GPS geotagging, and photo evidence.'">
                    </p>
                </div>
                <a href="/report" class="mt-6 inline-flex items-center text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline">
                    <span x-text="lang === 'tl' ? 'Mag-sumite ngayon →' : 'Submit a report →'"></span>
                </a>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-sky-500/10 border border-sky-500/20 flex items-center justify-center text-sky-600 dark:text-sky-400 mb-4">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
    </svg>
</div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Admin Command Center</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-2 leading-relaxed"
                       x-text="lang === 'tl' ? 'Sentralisadong dashboard na may analytics charts, verification, at real-time status management para sa mga opisyal.' : 'Centralized dashboard featuring analytics charts, verification, and real-time status management for officials.'">
                    </p>
                </div>
                <a href="/admin/dashboard" class="mt-6 inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                    <span x-text="lang === 'tl' ? 'Buksan ang Dashboard →' : 'Open Dashboard →'"></span>
                </a>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-600 dark:text-amber-400 mb-4">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
    </svg>
</div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Digital Blotter Archives</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-2 leading-relaxed"
                       x-text="lang === 'tl' ? 'Digital na repository at automated summary reports para sa mga natapos na kaso bilang pamalit sa papel na logbook.' : 'Digital repository and automated summary reports for resolved cases replacing traditional paper logbooks.'">
                    </p>
                </div>
                <a href="/admin/archives" class="mt-6 inline-flex items-center text-sm font-semibold text-emerald-600 dark:text-emerald-400 hover:underline">
                    <span x-text="lang === 'tl' ? 'Tingnan ang Archives →' : 'View Archives →'"></span>
                </a>
            </div>
        </div>
    </div>
</div>