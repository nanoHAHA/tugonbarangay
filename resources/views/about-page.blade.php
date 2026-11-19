<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16" x-data="{ lang: 'en' }">
    
    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 mb-2">
                <span x-show="lang === 'en'">About the Platform</span>
                <span x-show="lang === 'ph'">Tungkol sa Platform</span>
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                <span x-show="lang === 'en'">Empowering Barangays Through Digital Governance</span>
                <span x-show="lang === 'ph'">Pagpapalakas sa mga Barangay Gamit ang Digital na Pamamahala</span>
            </h1>
        </div>

        <button @click="lang = lang === 'en' ? 'ph' : 'en'" class="px-4 py-2 rounded-xl text-xs font-bold bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 border border-slate-200 dark:border-slate-800 shadow-sm hover:border-blue-500 transition cursor-pointer flex items-center gap-2 shrink-0">
            🌐 
        </button>
    </div>

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 md:p-12 shadow-sm transition-colors duration-300">
        
     
        <div class="max-w-4xl space-y-4 text-slate-700 dark:text-slate-300 leading-relaxed text-sm sm:text-base">
            <p>
                <strong class="text-slate-900 dark:text-white font-semibold" x-show="lang === 'en'">TugonBarangay</strong>
                <strong class="text-slate-900 dark:text-white font-semibold" x-show="lang === 'ph'">Ang TugonBarangay</strong> 
                <span x-show="lang === 'en'">is a modern web-based citizen response and incident management system built using the TALL Stack. It bridges the communication gap between local residents and barangay officials through fast, transparent, and organized digital reporting.</span>
                <span x-show="lang === 'ph'">ay isang makabagong web-based na sistema ng pagtugon sa mamamayan at pamamahala ng insidente na binuo gamit ang TALL Stack. Pinapag-ugnay nito ang mga residente at opisyal ng barangay sa pamamagitan ng mabilis, malinaw, at organisadong digital na pag-uulat.</span>
            </p>
            <p>
                <span x-show="lang === 'en'">Replacing manual paper logbooks, the platform enables citizens to submit incident reports with structured categories, GPS geotagging, and photo evidence—while giving barangay administrators a centralized command center.</span>
                <span x-show="lang === 'ph'">Bilang kapalit ng lumang manual na logbook, binibigyang-daan ng platapormang ito ang mga residente na magsumite ng mga ulat ng insidente na may structured categories, GPS geotagging, at photo evidence—habang binibigyan ang mga administrador ng sentralisadong command center.</span>
            </p>
        </div>

       
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12 pt-8 border-t border-slate-100 dark:border-slate-800">
          
            <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60">
                <div class="text-2xl mb-3"></div>
                <h3 class="font-bold text-slate-900 dark:text-white mb-2 text-sm sm:text-base">
                    <span x-show="lang === 'en'">Our Mission</span>
                    <span x-show="lang === 'ph'">Aming Misyon</span>
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    <span x-show="lang === 'en'">To modernize barangay emergency response and incident documentation with secure web technology.</span>
                    <span x-show="lang === 'ph'">Isapuso ang makabagong pagtugon sa emergency at dokumentasyon ng insidente gamit ang ligtas na teknolohiya sa web.</span>
                </p>
            </div>

            
            <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60">
                <div class="text-2xl mb-3"></div>
                <h3 class="font-bold text-slate-900 dark:text-white mb-2 text-sm sm:text-base">
                    <span x-show="lang === 'en'">Security & Privacy</span>
                    <span x-show="lang === 'ph'">Seguridad at Privacy</span>
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    <span x-show="lang === 'en'">Engineered in alignment with ISO/IEC 25010 software quality standards and the Data Privacy Act (RA 10173).</span>
                    <span x-show="lang === 'ph'">Nakadisenyo alinsunod sa ISO/IEC 25010 software quality standards at Data Privacy Act (RA 10173).</span>
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60">
                <div class="text-2xl mb-3"></div>
                <h3 class="font-bold text-slate-900 dark:text-white mb-2 text-sm sm:text-base">
                    <span x-show="lang === 'en'">Real-Time Tracking</span>
                    <span x-show="lang === 'ph'">Real-Time Tracking</span>
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    <span x-show="lang === 'en'">Residents can monitor the live status of their submitted concerns anytime using unique tracking codes.</span>
                    <span x-show="lang === 'ph'">Maaaring subaybayan ng mga residente ang live status ng kanilang mga sumbong gamit ang natatanging tracking codes.</span>
                </p>
            </div>

        </div>
    </div>
</div>