<div class="max-w-4xl mx-auto px-4 py-12 space-y-10"
     x-data="{
         localLang: localStorage.getItem('tugonLang') || 'tl',
         get currentLang() {
             return (typeof lang !== 'undefined' && lang) ? lang : this.localLang;
         },
         set currentLang(val) {
             this.localLang = val;
             localStorage.setItem('tugonLang', val);
             if (typeof lang !== 'undefined') {
                 lang = val;
             }
         },
         init() {
             if (typeof lang !== 'undefined') {
                 this.$watch('lang', () => {
                     this.localLang = lang;
                     localStorage.setItem('tugonLang', lang);
                 });
             }
         }
     }">

    
    @if($successMessage)
        <div class="p-6 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-emerald-900 dark:text-emerald-200 shadow-sm">
            <h3 class="font-bold text-lg"
                x-text="currentLang === 'tl' ? 'Maraming Salamat sa Inyong Ebalwasyon!' : 'Thank You for Your Evaluation!'"></h3>
            <p class="text-sm mt-1"
               x-text="currentLang === 'tl' ? 'Matagumpay na naitala ang iyong mga marka ayon sa ISO/IEC 25010 software quality standards.' : 'Your ratings have been successfully recorded based on ISO/IEC 25010 software quality standards.'"></p>
        </div>
    @endif

    
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-800 p-6 md:p-10">
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 border-b border-slate-200 dark:border-slate-800 pb-6 mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white"
                    x-text="currentLang === 'tl' ? 'TugonBarangay — ISO/IEC 25010 System Evaluation' : 'TugonBarangay — ISO/IEC 25010 System Evaluation'"></h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1"
                   x-text="currentLang === 'tl' ? 'Punan ang form na ito upang suriin ang kalidad ng sistema batay sa pamantayan ng Software Quality Standards (Functional Suitability, Performance Efficiency, Usability, Reliability, Security, at Portability).' : 'Complete this form to evaluate the system quality against ISO/IEC 25010 Software Quality Standards (Functional Suitability, Performance Efficiency, Usability, Reliability, Security, and Portability).'"></p>
            </div>

            <button type="button"
                    @click="currentLang = currentLang === 'tl' ? 'en' : 'tl'"
                    class="px-3.5 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-800 dark:text-slate-200 text-xs font-semibold hover:bg-slate-100 dark:hover:bg-slate-700 transition cursor-pointer shrink-0">
            </button>
        </div>

        <form wire:submit.prevent="submitEvaluation" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2"
                           x-text="currentLang === 'tl' ? 'Pangalan ng Tagasuri (Evaluator):' : 'Evaluator Name:'"></label>
                    <input type="text"
                           wire:model="evaluator_name"
                           :placeholder="currentLang === 'tl' ? 'Ilagay ang pangalan...' : 'Enter name...'"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                    @error('evaluator_name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2"
                           x-text="currentLang === 'tl' ? 'Uri ng Tagasuri:' : 'Evaluator Role:'"></label>
                    <select wire:model="evaluator_role"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                        <option value="Community Resident" x-text="currentLang === 'tl' ? 'Community Resident (Residente)' : 'Community Resident'"></option>
                        <option value="Barangay Staff" x-text="currentLang === 'tl' ? 'Barangay Staff / Official' : 'Barangay Staff / Official'"></option>
                        <option value="IT Expert" x-text="currentLang === 'tl' ? 'IT Expert' : 'IT Expert'"></option>
                    </select>
                </div>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-200 dark:border-slate-800">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1"
                           x-text="currentLang === 'tl' ? '1. Functional Suitability (1-5):' : '1. Functional Suitability (1-5):'"></label>
                    <input type="number" min="1" max="5" wire:model="functional_suitability"
                           class="w-full px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1"
                           x-text="currentLang === 'tl' ? '2. Performance Efficiency (1-5):' : '2. Performance Efficiency (1-5):'"></label>
                    <input type="number" min="1" max="5" wire:model="performance_efficiency"
                           class="w-full px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1"
                           x-text="currentLang === 'tl' ? '3. Usability & UI (1-5):' : '3. Usability & UI (1-5):'"></label>
                    <input type="number" min="1" max="5" wire:model="usability"
                           class="w-full px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1"
                           x-text="currentLang === 'tl' ? '4. Reliability (1-5):' : '4. Reliability (1-5):'"></label>
                    <input type="number" min="1" max="5" wire:model="reliability"
                           class="w-full px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1"
                           x-text="currentLang === 'tl' ? '5. Security (1-5):' : '5. Security (1-5):'"></label>
                    <input type="number" min="1" max="5" wire:model="security"
                           class="w-full px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1"
                           x-text="currentLang === 'tl' ? '6. Portability (1-5):' : '6. Portability (1-5):'"></label>
                    <input type="number" min="1" max="5" wire:model="portability"
                           class="w-full px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                </div>
            </div>

            
            <div class="pt-4">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2"
                       x-text="currentLang === 'tl' ? 'Komento at Rekomendasyon:' : 'Comments & Recommendations:'"></label>
                <textarea wire:model="comments"
                          rows="4"
                          :placeholder="currentLang === 'tl' ? 'Ilagay ang inyong mga obserbasyon, lakas, o rekomendasyon sa sistema...' : 'Enter your observations, strengths, or recommendations for the system...'"
                          class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white outline-none"></textarea>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit"
                        class="px-8 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-md transition cursor-pointer"
                        x-text="currentLang === 'tl' ? 'Isumite ang ISO Evaluation' : 'Submit ISO Evaluation'"></button>
            </div>
        </form>
    </div>

    @if($stats && $stats->total > 0)
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-800 p-6 md:p-8 space-y-4">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white">
                <span x-text="currentLang === 'tl' ? 'Live Evaluation Summary (Kabuuang Tagasuri: ' : 'Live Evaluation Summary (Total Evaluators: '"></span>{{ $stats->total }})
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-center">
                <div class="bg-slate-50 dark:bg-slate-800/60 p-4 rounded-xl">
                    <span class="text-xs text-slate-500 block" x-text="currentLang === 'tl' ? 'Functional Suitability' : 'Functional Suitability'"></span>
                    <span class="text-2xl font-extrabold text-blue-600">{{ number_format($stats->avg_func, 2) }} / 5.0</span>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800/60 p-4 rounded-xl">
                    <span class="text-xs text-slate-500 block" x-text="currentLang === 'tl' ? 'Performance Efficiency' : 'Performance Efficiency'"></span>
                    <span class="text-2xl font-extrabold text-indigo-600">{{ number_format($stats->avg_perf, 2) }} / 5.0</span>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800/60 p-4 rounded-xl">
                    <span class="text-xs text-slate-500 block" x-text="currentLang === 'tl' ? 'Usability & UI' : 'Usability & UI'"></span>
                    <span class="text-2xl font-extrabold text-emerald-600">{{ number_format($stats->avg_usable, 2) }} / 5.0</span>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800/60 p-4 rounded-xl">
                    <span class="text-xs text-slate-500 block" x-text="currentLang === 'tl' ? 'Reliability' : 'Reliability'"></span>
                    <span class="text-2xl font-extrabold text-amber-600">{{ number_format($stats->avg_rel, 2) }} / 5.0</span>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800/60 p-4 rounded-xl">
                    <span class="text-xs text-slate-500 block" x-text="currentLang === 'tl' ? 'Security' : 'Security'"></span>
                    <span class="text-2xl font-extrabold text-purple-600">{{ number_format($stats->avg_sec, 2) }} / 5.0</span>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800/60 p-4 rounded-xl">
                    <span class="text-xs text-slate-500 block" x-text="currentLang === 'tl' ? 'Portability' : 'Portability'"></span>
                    <span class="text-2xl font-extrabold text-teal-600">{{ number_format($stats->avg_port, 2) }} / 5.0</span>
                </div>
            </div>
        </div>
    @endif
</div>