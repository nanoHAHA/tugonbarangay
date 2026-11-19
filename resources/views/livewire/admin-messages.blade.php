<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6"
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

    
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <div>
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-purple-500/10 text-purple-600 dark:text-purple-400 border border-purple-500/20 mb-2"
                  x-text="currentLang === 'tl' ? 'Admin Control' : 'Admin Control'"></span>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight"
                x-text="currentLang === 'tl' ? 'Resident Contact Messages' : 'Resident Contact Messages'"></h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1"
               x-text="currentLang === 'tl' ? 'Lahat ng direktang mensahe at katanungan na isinumite ng mga residente mula sa Contact Us page.' : 'All direct messages and inquiries submitted by residents from the Contact Us page.'"></p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <button type="button"
                    @click="currentLang = currentLang === 'tl' ? 'en' : 'tl'"
                    class="px-3.5 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-800 dark:text-slate-200 text-xs font-semibold hover:bg-slate-100 dark:hover:bg-slate-700 transition cursor-pointer">
            </button>

            <a href="{{ route('admin.dashboard') }}"
               class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-200 dark:bg-slate-800 text-slate-800 dark:text-slate-200 hover:bg-slate-300 dark:hover:bg-slate-700 transition">
                &larr; <span x-text="currentLang === 'tl' ? 'Bumalik sa Dashboard' : 'Back to Dashboard'"></span>
            </a>
        </div>
    </div>

   
    @if (session()->has('message'))
        <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 text-xs font-medium">
            ✅ {{ session('message') }}
        </div>
    @endif

  
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/60 border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 text-xs uppercase tracking-wider">
                        <th class="p-4" x-text="currentLang === 'tl' ? 'Petsa / Oras' : 'Date / Time'"></th>
                        <th class="p-4" x-text="currentLang === 'tl' ? 'Pangalan ng Residente' : 'Resident Name'"></th>
                        <th class="p-4" x-text="currentLang === 'tl' ? 'Contact Info (Email/Mobile)' : 'Contact Info (Email/Mobile)'"></th>
                        <th class="p-4" x-text="currentLang === 'tl' ? 'Mensahe' : 'Message'"></th>
                        <th class="p-4 text-center" x-text="currentLang === 'tl' ? 'Aksyon' : 'Action'"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300 text-xs">
                    @forelse($messages as $msg)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition">
                            <td class="p-4 whitespace-nowrap text-slate-500">
                                {{ $msg->created_at->format('M d, Y - h:i A') }}
                            </td>
                            <td class="p-4 font-bold text-slate-900 dark:text-white">
                                {{ $msg->full_name }}
                            </td>
                            <td class="p-4 font-mono text-blue-600 dark:text-blue-400">
                                {{ $msg->contact_info }}
                            </td>
                            <td class="p-4 max-w-md leading-relaxed">
                                {{ $msg->message }}
                            </td>
                            <td class="p-4 text-center whitespace-nowrap">
                                <button wire:click="deleteMessage({{ $msg->id }})"
                                        wire:confirm="Sigurado ka bang gusto mong tanggalin ang mensaheng ito? / Are you sure you want to delete this message?"
                                        class="px-3 py-1.5 rounded-lg bg-red-50 dark:bg-red-950/50 text-red-600 dark:text-red-400 hover:bg-red-100 font-semibold transition cursor-pointer"
                                        x-text="currentLang === 'tl' ? 'Tanggalin' : 'Delete'">
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center text-slate-400"
                                x-text="currentLang === 'tl' ? 'Walang natatanggap na mensahe sa kasalukuyan.' : 'No messages received at the moment.'"></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>