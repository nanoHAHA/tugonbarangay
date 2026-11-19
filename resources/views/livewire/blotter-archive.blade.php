<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8"
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

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white"
                x-text="currentLang === 'tl' ? 'Digital Blotter Archive (TugonBarangay)' : 'Digital Blotter Archive (TugonBarangay)'"></h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1"
               x-text="currentLang === 'tl' ? 'Kalipunan ng lahat ng naitalang insidente at blotter records sa sistema.' : 'Repository of all recorded incidents and digital blotter records in the system.'"></p>
        </div>

        <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <button type="button"
                    @click="currentLang = currentLang === 'tl' ? 'en' : 'tl'"
                    class="px-3.5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-800 dark:text-slate-200 text-xs font-semibold hover:bg-slate-100 dark:hover:bg-slate-700 transition cursor-pointer">
                <span x-text="currentLang === 'tl' ? '🇺🇸 EN' : '🇵🇭 TL'"></span>
            </button>

            <div class="w-full sm:w-72">
                <input type="text"
                       wire:model.live.debounce.300ms="search"
                       :placeholder="currentLang === 'tl' ? 'Maghanap ng blotter record...' : 'Search blotter record...'"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-900 dark:text-white outline-none shadow-sm">
            </div>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-sm font-medium">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 uppercase text-xs tracking-wider border-b border-slate-200 dark:border-slate-800">
                        <th class="p-4" x-text="currentLang === 'tl' ? 'Tracking Code' : 'Tracking Code'"></th>
                        <th class="p-4" x-text="currentLang === 'tl' ? 'Pamagat ng Kaso' : 'Case Title'"></th>
                        <th class="p-4" x-text="currentLang === 'tl' ? 'Kategorya' : 'Category'"></th>
                        <th class="p-4" x-text="currentLang === 'tl' ? 'Lokasyon' : 'Location'"></th>
                        <th class="p-4" x-text="currentLang === 'tl' ? 'Petsa ng Pagkakasara' : 'Date Closed'"></th>
                        <th class="p-4 text-right" x-text="currentLang === 'tl' ? 'Aksyon' : 'Action'"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse($archives as $archive)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition">
                            <td class="p-4 font-mono font-bold text-blue-600 dark:text-blue-400">{{ $archive->tracking_code }}</td>
                            <td class="p-4 font-bold text-slate-900 dark:text-white">{{ $archive->title }}</td>
                            <td class="p-4 text-slate-600 dark:text-slate-300">{{ $archive->category }}</td>
                            <td class="p-4 text-slate-600 dark:text-slate-300">{{ $archive->location }}</td>
                            <td class="p-4 text-xs text-slate-500 dark:text-slate-400">{{ $archive->created_at->format('F d, Y') }}</td>

                            <td class="p-4 text-right">
                                <button type="button"
                                        wire:click="deleteIncident({{ $archive->id }})"
                                        wire:confirm="Sigurado ka bang gusto mong burahin ang blotter record na ito? / Are you sure you want to delete this blotter record?"
                                        class="px-3 py-1.5 rounded-lg bg-red-50 dark:bg-red-950 text-red-600 dark:text-red-400 font-semibold text-xs hover:bg-red-100 transition cursor-pointer"
                                        x-text="currentLang === 'tl' ? 'Burahin' : 'Remove'">
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-500 dark:text-slate-400"
                                x-text="currentLang === 'tl' ? 'Walang nakitang blotter archive records.' : 'No blotter archive records found.'"></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-200 dark:border-slate-800">
            {{ $archives->links() }}
        </div>
    </div>
</div>