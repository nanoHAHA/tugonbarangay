<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16" x-data="{ lang: 'en' }">
    
    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
        <div>
            <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 mb-2">
                <span x-show="lang === 'en'">Get in Touch</span>
                <span x-show="lang === 'ph'">Makipag-ugnayan</span>
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                <span x-show="lang === 'en'">Contact the Barangay Command Center</span>
                <span x-show="lang === 'ph'">Makipag-ugnayan sa Barangay Command Center</span>
            </h1>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
                <span x-show="lang === 'en'">Have questions, suggestions, or need emergency assistance? Reach out to us below.</span>
                <span x-show="lang === 'ph'">May mga katanungan, suhestiyon, o kailangan ng agarang tulong? Narito ang aming mga detalye.</span>
            </p>
        </div>

        <button @click="lang = lang === 'en' ? 'ph' : 'en'" class="px-4 py-2 rounded-xl text-xs font-bold bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 border border-slate-200 dark:border-slate-800 shadow-sm hover:border-blue-500 transition cursor-pointer flex items-center gap-2 shrink-0">
            🌐 
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
        
        
        <div class="lg:col-span-5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 shadow-sm flex flex-col justify-between transition-colors duration-300">
            <div class="space-y-6">
                <div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-2">
                        <span x-show="lang === 'en'">Official Station Info</span>
                        <span x-show="lang === 'ph'">Impormasyon ng Tanggapan</span>
                    </h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                        <span x-show="lang === 'en'">Open for all residents for public concerns, emergency response, and blotter records processing.</span>
                        <span x-show="lang === 'ph'">Bukas para sa lahat ng residente para sa mga sumbong, emergency response, at pag-aayos ng rekord.</span>
                    </p>
                </div>

                <div class="space-y-5 text-sm text-slate-700 dark:text-slate-200 pt-4 border-t border-slate-100 dark:border-slate-800">
                    <div class="flex items-start gap-3.5">
                        <div class="p-2.5 rounded-xl bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400"> </div>
                        <div>
                            <p class="font-bold text-slate-900 dark:text-white text-xs uppercase tracking-wider">
                                <span x-show="lang === 'en'">Address</span>
                                <span x-show="lang === 'ph'">Lokasyon</span>
                            </p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Barangay Operations & Command Center</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="p-2.5 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400"> </div>
                        <div>
                            <p class="font-bold text-slate-900 dark:text-white text-xs uppercase tracking-wider">
                                <span x-show="lang === 'en'">24/7 Hotline</span>
                                <span x-show="lang === 'ph'">Numero ng Alisto</span>
                            </p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">09566355199</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="p-2.5 rounded-xl bg-purple-50 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400"> </div>
                        <div>
                            <p class="font-bold text-slate-900 dark:text-white text-xs uppercase tracking-wider">
                                <span x-show="lang === 'en'">Email Address</span>
                                <span x-show="lang === 'ph'">Email Address</span>
                            </p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">info@tugonbarangay.ph</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800">
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    <span x-show="lang === 'en'">Need to file a formal complaint? Use our <a href="/report" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline">Incident Reporting</a> module.</span>
                    <span x-show="lang === 'ph'">Kailangan magsumite ng pormal na reklamo? Gamitin ang <a href="/report" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline">Report Incident</a> module.</span>
                </p>
            </div>
        </div>

        <div class="lg:col-span-7 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 shadow-sm transition-colors duration-300">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-1">
                <span x-show="lang === 'en'">Send a Direct Message</span>
                <span x-show="lang === 'ph'">Magpadala ng Mensahe</span>
            </h2>
            <p class="text-xs text-slate-500 dark:text-slate-400 mb-6">
                <span x-show="lang === 'en'">Fill out the form below and our desk officer will get back to you.</span>
                <span x-show="lang === 'ph'">Punan ang form sa ibaba para sa iyong mga katanungan o feedback.</span>
            </p>

            @if (session()->has('success'))
                <div class="p-4 mb-6 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 text-xs font-medium flex items-center gap-2">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif

            <form wire:submit.prevent="sendMessage" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            <span x-show="lang === 'en'">Full Name</span>
                            <span x-show="lang === 'ph'">Buong Pangalan</span>
                        </label>
                        <input type="text" wire:model="full_name" required placeholder="Juan Dela Cruz" class="w-full px-4 py-3 rounded-xl text-sm bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:border-blue-500 transition">
                        @error('full_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            <span x-show="lang === 'en'">Email or Mobile Number</span>
                            <span x-show="lang === 'ph'">Email o Numero ng Telepono</span>
                        </label>
                        <input type="text" wire:model="contact_info" required placeholder="juan@example.com" class="w-full px-4 py-3 rounded-xl text-sm bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:border-blue-500 transition">
                        @error('contact_info') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                        <span x-show="lang === 'en'">Message</span>
                        <span x-show="lang === 'ph'">Mensahe</span>
                    </label>
                    <textarea rows="4" wire:model="message" required placeholder="Isulat ang iyong mensahe dito..." class="w-full px-4 py-3 rounded-xl text-sm bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:border-blue-500 transition resize-none"></textarea>
                    @error('message') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="w-full py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow-sm transition cursor-pointer">
                    <span x-show="lang === 'en'">Send Message</span>
                    <span x-show="lang === 'ph'">Ipadala ang Mensahe</span>
                </button>
            </form>
        </div>

    </div>
</div>