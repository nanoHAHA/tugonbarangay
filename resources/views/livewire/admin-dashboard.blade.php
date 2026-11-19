<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8"
     x-data="{
         localLang: localStorage.getItem('tugonLang') || 'tl',
         chartInstance: null,
         chartLabels: @js($categoryLabels ?? []),
         chartData: @js($categoryCounts ?? []),
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
         drawChart() {
             const canvas = document.getElementById('categoryChart');
             if (!canvas || typeof Chart === 'undefined') return;

             if (this.chartInstance) {
                 this.chartInstance.destroy();
                 this.chartInstance = null;
             }

             const isTl = this.currentLang === 'tl';
             const ctx = canvas.getContext('2d');

             this.chartInstance = new Chart(ctx, {
                 type: 'bar',
                 data: {
                     labels: this.chartLabels,
                     datasets: [{
                         label: isTl ? 'Bilang ng Insidente' : 'Number of Incidents',
                         data: this.chartData,
                         backgroundColor: ['#3b82f6', '#6366f1', '#10b981', '#f59e0b', '#ef4444'],
                         borderRadius: 8
                     }]
                 },
                 options: {
                     responsive: true,
                     maintainAspectRatio: false,
                     interaction: {
                         mode: 'index',
                         intersect: false
                     },
                     plugins: {
                         legend: { display: false },
                         tooltip: {
                             enabled: true,
                             callbacks: {
                                 title: (items) => {
                                     if (!items.length) return '';
                                     const categoryTitle = items[0].label || '';
                                     return isTl
                                         ? `Kategorya: ${categoryTitle}`
                                         : `Category: ${categoryTitle}`;
                                 },
                                 label: (item) => {
                                     const count = item.parsed.y ?? 0;
                                     return isTl
                                         ? `Bilang: ${count}`
                                         : `Count: ${count}`;
                                 }
                             }
                         }
                     },
                     scales: {
                         y: {
                             beginAtZero: true,
                             ticks: {
                                 precision: 0
                             }
                         }
                     }
                 }
             });
         },
         init() {
             const tryDraw = () => {
                 if (typeof Chart !== 'undefined') {
                     this.drawChart();
                 } else {
                     setTimeout(tryDraw, 150);
                 }
             };

             this.$nextTick(tryDraw);

             this.$effect(() => {
                 const activeLang = this.currentLang;
                 this.$nextTick(() => {
                     if (this.chartInstance) {
                         this.drawChart();
                     }
                 });
             });

             if (typeof lang !== 'undefined') {
                 this.$watch('lang', (val) => {
                     this.localLang = val;
                     localStorage.setItem('tugonLang', val);
                 });
             }
         }
     }">

   
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white"
                x-text="currentLang === 'tl' ? 'Admin Command Center Dashboard' : 'Admin Command Center Dashboard'"></h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                <span x-text="currentLang === 'tl' ? 'Nakareserve para sa mga Barangay Officials at Dispatchers. Naka-login bilang: ' : 'Reserved for Barangay Officials and Dispatchers. Logged in as: '"></span>
                <span class="font-semibold text-blue-600 dark:text-blue-400">{{ Auth::user()->name }}</span>
                ({{ Auth::user()->position }})
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <button type="button"
                    @click="currentLang = currentLang === 'tl' ? 'en' : 'tl'"
                    class="px-3.5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-800 dark:text-slate-200 text-xs font-semibold hover:bg-slate-100 dark:hover:bg-slate-700 transition cursor-pointer">
            </button>

            <a href="/admin/archives"
               class="px-4 py-2.5 rounded-xl bg-slate-900 dark:bg-slate-700 text-white text-xs font-semibold hover:bg-slate-800 transition shadow-sm"
               x-text="currentLang === 'tl' ? 'Pumunta sa Blotter Archives →' : 'Go to Blotter Archives →'"></a>
        </div>
    </div>

    
    @if(session()->has('message'))
        <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-sm font-medium">
            {{ session('message') }}
        </div>
    @endif

   
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400"
                  x-text="currentLang === 'tl' ? 'Kabuuang Kaso' : 'Total Incidents'"></span>
            <div class="text-3xl font-extrabold text-slate-900 dark:text-white mt-2">{{ $totalIncidents }}</div>
        </div>
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-blue-500"
                  x-text="currentLang === 'tl' ? 'Nakabinbin (Pending)' : 'Pending'"></span>
            <div class="text-3xl font-extrabold text-blue-600 dark:text-blue-400 mt-2">{{ $pendingCount }}</div>
        </div>
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-500"
                  x-text="currentLang === 'tl' ? 'Ginagawa (In Progress)' : 'In Progress'"></span>
            <div class="text-3xl font-extrabold text-amber-600 dark:text-amber-400 mt-2">{{ $inProgressCount }}</div>
        </div>
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-500"
                  x-text="currentLang === 'tl' ? 'Nalutas (Resolved)' : 'Resolved'"></span>
            <div class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mt-2">{{ $resolvedCount }}</div>
        </div>
    </div>

   
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4"
            x-text="currentLang === 'tl' ? 'Analytics: Insidente Ayon sa Kategorya' : 'Analytics: Incidents by Category'"></h3>
        <div class="h-64 relative" wire:ignore>
            <canvas id="categoryChart"></canvas>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="w-full md:w-72">
                <input type="text"
                       wire:model.live.debounce.300ms="search"
                       :placeholder="currentLang === 'tl' ? 'Hanapin ang tracking code o pamagat...' : 'Search tracking code or title...'"
                       class="w-full px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-900 dark:text-white outline-none">
            </div>
            <div class="flex flex-wrap gap-3 w-full md:w-auto">
                <select wire:model.live="statusFilter"
                        class="px-3 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-900 dark:text-white outline-none">
                    <option value="" x-text="currentLang === 'tl' ? 'Lahat ng Status' : 'All Statuses'"></option>
                    <option value="Pending" x-text="currentLang === 'tl' ? 'Pending' : 'Pending'"></option>
                    <option value="In Progress" x-text="currentLang === 'tl' ? 'In Progress' : 'In Progress'"></option>
                    <option value="Resolved" x-text="currentLang === 'tl' ? 'Resolved' : 'Resolved'"></option>
                </select>
                <select wire:model.live="categoryFilter"
                        class="px-3 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-900 dark:text-white outline-none">
                    <option value="" x-text="currentLang === 'tl' ? 'Lahat ng Kategorya' : 'All Categories'"></option>
                    <option value="Public Safety" x-text="currentLang === 'tl' ? 'Kaligtasang Pampubliko (Public Safety)' : 'Public Safety'"></option>
                    <option value="Neighborhood Dispute" x-text="currentLang === 'tl' ? 'Alitan sa Komunidad (Neighborhood Dispute)' : 'Neighborhood Dispute'"></option>
                    <option value="Medical / Emergency" x-text="currentLang === 'tl' ? 'Medikal / Emerhensiya (Medical / Emergency)' : 'Medical / Emergency'"></option>
                    <option value="Infrastructure / Hazard" x-text="currentLang === 'tl' ? 'Imprastraktura / Panganib (Infrastructure / Hazard)' : 'Infrastructure / Hazard'"></option>
                    <option value="Peace and Order" x-text="currentLang === 'tl' ? 'Kapayapaan at Kaayusan (Peace and Order)' : 'Peace and Order'"></option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 uppercase text-xs tracking-wider border-b border-slate-200 dark:border-slate-800">
                        <th class="p-4" x-text="currentLang === 'tl' ? 'Tracking Code' : 'Tracking Code'"></th>
                        <th class="p-4" x-text="currentLang === 'tl' ? 'Pamagat & Kategorya' : 'Title & Category'"></th>
                        <th class="p-4" x-text="currentLang === 'tl' ? 'Lokasyon' : 'Location'"></th>
                        <th class="p-4" x-text="currentLang === 'tl' ? 'Status' : 'Status'"></th>
                        <th class="p-4" x-text="currentLang === 'tl' ? 'Petsa' : 'Date'"></th>
                        <th class="p-4 text-right" x-text="currentLang === 'tl' ? 'Aksyon' : 'Action'"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse($incidents as $incident)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition">
                            <td class="p-4 font-mono font-bold text-blue-600 dark:text-blue-400">{{ $incident->tracking_code }}</td>
                            <td class="p-4">
                                <div class="font-bold text-slate-900 dark:text-white">{{ $incident->title }}</div>
                                <span class="text-xs text-slate-500 dark:text-slate-400">{{ $incident->category }}</span>
                            </td>
                            <td class="p-4 text-slate-600 dark:text-slate-300">
                                {{ $incident->location }}
                                @if($incident->latitude && $incident->longitude)
                                    <span class="block text-[10px] text-indigo-500 font-mono">GPS: {{ $incident->latitude }}, {{ $incident->longitude }}</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $incident->status === 'Resolved' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300' :
                                       ($incident->status === 'In Progress' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300' :
                                       'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300') }}">
                                    {{ $incident->status }}
                                </span>
                            </td>
                            <td class="p-4 text-xs text-slate-500 dark:text-slate-400">{{ $incident->created_at->format('M d, Y h:i A') }}</td>
                            <td class="p-4 text-right">
                                <button wire:click="openUpdateModal({{ $incident->id }})"
                                        class="px-3 py-1.5 rounded-lg bg-blue-50 dark:bg-blue-950 text-blue-600 dark:text-blue-400 font-semibold text-xs hover:bg-blue-100 transition cursor-pointer"
                                        x-text="currentLang === 'tl' ? 'I-update' : 'Update'">
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-500 dark:text-slate-400"
                                x-text="currentLang === 'tl' ? 'Walang nakitang insidente o ulat.' : 'No incidents or reports found.'"></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-200 dark:border-slate-800">
            {{ $incidents->links() }}
        </div>
    </div>

    
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4">
            <h3 class="text-base font-bold text-slate-900 dark:text-white"
                x-text="currentLang === 'tl' ? 'Mga Kamakailang Activity Logs (Audit Trail)' : 'Recent Activity Logs (Audit Trail)'"></h3>
            <span class="text-xs text-slate-400"
                  x-text="currentLang === 'tl' ? 'Read-only na tala ng mga aksyon sa sistema' : 'Read-only system action history'"></span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 uppercase text-xs tracking-wider border-b border-slate-200 dark:border-slate-800">
                        <th class="p-3" x-text="currentLang === 'tl' ? 'Staff / Admin' : 'Staff / Admin'"></th>
                        <th class="p-3" x-text="currentLang === 'tl' ? 'Aksyon na Ginawa' : 'Action Taken'"></th>
                        <th class="p-3" x-text="currentLang === 'tl' ? 'Incident Code' : 'Incident Code'"></th>
                        <th class="p-3" x-text="currentLang === 'tl' ? 'Oras' : 'Time'"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse($activityLogs as $log)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition">
                            <td class="p-3 font-medium text-slate-900 dark:text-white">
                                {{ $log->user->name ?? 'Unknown' }}
                            </td>
                            <td class="p-3 text-slate-600 dark:text-slate-300">
                                {{ $log->action }}
                            </td>
                            <td class="p-3 font-mono text-xs text-blue-600 dark:text-blue-400">
                                {{ $log->incident_code ?? 'N/A' }}
                            </td>
                            <td class="p-3 text-xs text-slate-400">
                                {{ $log->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-6 text-center text-slate-500 dark:text-slate-400 text-xs"
                                x-text="currentLang === 'tl' ? 'Wala pang naitalang aktibidad o log sa sistema.' : 'No activity or system logs recorded yet.'"></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm px-4">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 max-w-lg w-full p-6 shadow-2xl space-y-5 max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-4">
                    <h3 class="font-bold text-lg text-slate-900 dark:text-white"
                        x-text="currentLang === 'tl' ? 'I-update ang Status & Ebidensya' : 'Update Status & Evidence'"></h3>
                    <button wire:click="closeModal" class="text-slate-400 hover:text-slate-600 cursor-pointer">✕</button>
                </div>

                @php
                    $currentIncident = \App\Models\Incident::find($selectedIncidentId);
                @endphp

                @if($currentIncident && $currentIncident->evidence_path)
                    <div x-data="{ zoomOpen: false }">
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5"
                               x-text="currentLang === 'tl' ? 'Ebidensyang Larawan:' : 'Evidence Photo:'"></label>
                        
                        <div class="relative w-full h-56 overflow-hidden rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800 p-2 text-center">
                            <img 
                                src="{{ asset('storage/' . $currentIncident->evidence_path) }}" 
                                alt="Incident Evidence" 
                                @click="zoomOpen = true"
                                class="w-full h-full rounded-lg object-cover cursor-pointer hover:opacity-90 transition duration-150"
                                :title="currentLang === 'tl' ? 'I-click para palakihin ang larawan' : 'Click to enlarge photo'"
                            >
                        </div>
                        <span class="text-[10px] text-slate-400 mt-1 block text-center"
                              x-text="currentLang === 'tl' ? 'I-click ang larawan para buksan nang malaki.' : 'Click the photo to view in full size.'"></span>

                        <div 
                            x-show="zoomOpen" 
                            x-transition.opacity
                            style="display: none;"
                            class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-black/90 p-4"
                        >
                            <div class="w-full max-w-4xl flex justify-start mb-3">
                                <button 
                                    type="button" 
                                    @click="zoomOpen = false"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg border border-slate-600 transition shadow-lg cursor-pointer"
                                >
                                    &larr; <span x-text="currentLang === 'tl' ? 'Bumalik' : 'Back'"></span>
                                </button>
                            </div>

                            <img 
                                src="{{ asset('storage/' . $currentIncident->evidence_path) }}" 
                                alt="Enlarged Incident Evidence" 
                                @click.away="zoomOpen = false"
                                class="max-h-[80vh] max-w-full rounded-lg object-contain shadow-2xl border border-slate-700"
                            >
                        </div>
                    </div>
                @else
                    <div class="p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl text-xs text-slate-400 text-center"
                         x-text="currentLang === 'tl' ? 'Walang inilakip na larawan ang residente sa ulat na ito.' : 'No photo evidence attached by the resident for this report.'"></div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1"
                               x-text="currentLang === 'tl' ? 'Status ng Kaso' : 'Case Status'"></label>
                        <select wire:model="newStatus" class="w-full px-3 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-900 dark:text-white outline-none">
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Resolved">Resolved</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1"
                               x-text="currentLang === 'tl' ? 'Tala / Remarks ng Barangay' : 'Barangay Notes / Remarks'"></label>
                        <textarea wire:model="adminRemarks" rows="3"
                                  :placeholder="currentLang === 'tl' ? 'Maglagay ng update o aksyon na ginawa ng mga opisyal...' : 'Enter an update or action taken by officials...'"
                                  class="w-full px-3 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm text-slate-900 dark:text-white outline-none"></textarea>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button wire:click="closeModal"
                            class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-semibold text-xs cursor-pointer"
                            x-text="currentLang === 'tl' ? 'Kanselahin' : 'Cancel'"></button>
                    <button wire:click="updateIncidentStatus"
                            class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-sm cursor-pointer"
                            x-text="currentLang === 'tl' ? 'I-save ang Pagbabago' : 'Save Changes'"></button>
                </div>
            </div>
        </div>
    @endif
</div>