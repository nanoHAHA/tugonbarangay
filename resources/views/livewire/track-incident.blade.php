<div class="max-w-2xl mx-auto px-4 py-12">
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-800 p-6 md:p-8">
        <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white mb-2"
            x-text="lang === 'tl' ? 'Tignan ang Status ng Insidente' : 'Track Incident Status'"></h2>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-6"
           x-text="lang === 'tl' ? 'Ilagay ang iyong Tracking Code upang makita ang real-time na aksyon ng barangay.' : 'Enter your Tracking Code to view real-time barangay response updates.'"></p>

        <form wire:submit.prevent="searchIncident" class="flex flex-col sm:flex-row gap-3">
            <input type="text" wire:model="tracking_code" placeholder="Hal. TB-XXXXXX"
                   class="flex-grow px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white font-mono uppercase focus:ring-2 focus:ring-blue-600 outline-none">
            <button type="submit"
                    class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-sm transition cursor-pointer"
                    x-text="lang === 'tl' ? 'Hanapin' : 'Search'">
            </button>
        </form>

        @if(session()->has('error'))
            <div class="mt-4 p-4 rounded-xl bg-red-50 dark:bg-red-950/50 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 text-sm">
                {{ session('error') }}
            </div>
        @endif

        @if(isset($incident) && $incident)
            <div class="mt-8 pt-6 border-t border-slate-200 dark:border-slate-800 space-y-5">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">CODE: {{ $incident->tracking_code }}</span>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ $incident->title }}</h3>
                    </div>
                    <span class="px-3.5 py-1.5 rounded-full text-xs font-bold
                        {{ $incident->status === 'Resolved' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300' :
                           ($incident->status === 'In Progress' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300' :
                           'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300') }}">
                        {{ $incident->status }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm bg-slate-50 dark:bg-slate-800/60 p-4 rounded-xl">
                    <div>
                        <span class="text-slate-500 dark:text-slate-400 block text-xs" x-text="lang === 'tl' ? 'Kategorya' : 'Category'"></span>
                        <span class="font-semibold">{{ $incident->category }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 dark:text-slate-400 block text-xs" x-text="lang === 'tl' ? 'Lokasyon' : 'Location'"></span>
                        <span class="font-semibold">{{ $incident->location }}</span>
                    </div>
                    <div class="sm:col-span-2">
                        <span class="text-slate-500 dark:text-slate-400 block text-xs" x-text="lang === 'tl' ? 'Deskripsyon' : 'Description'"></span>
                        <p class="mt-1 text-slate-700 dark:text-slate-300">{{ $incident->description }}</p>
                    </div>
                    @if($incident->admin_remarks)
                        <div class="sm:col-span-2 pt-3 border-t border-slate-200 dark:border-slate-700">
                            <span class="text-blue-600 dark:text-blue-400 font-bold block text-xs" x-text="lang === 'tl' ? 'Tala / Aksyon ng Barangay:' : 'Barangay Official Remarks:'"></span>
                            <p class="mt-1 text-slate-800 dark:text-slate-200">{{ $incident->admin_remarks }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>