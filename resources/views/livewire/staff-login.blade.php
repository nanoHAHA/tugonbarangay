<div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 p-8 transition-colors">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600/10 text-blue-600 dark:text-blue-400 mb-4">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white" x-text="lang === 'tl' ? 'Barangay Official Login' : 'Barangay Official Login'"></h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1" x-text="lang === 'tl' ? 'Mag-sign in upang ma-access ang Command Center at Archives.' : 'Sign in to access the Command Center and Blotter Archives.'"></p>
        </div>

        <form wire:submit.prevent="login" class="space-y-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Email Address</label>
                <input type="email" wire:model="email" placeholder="admin@tugonbarangay.ph"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-transparent outline-none transition">
                @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Password</label>
                <input type="password" wire:model="password" placeholder="••••••••"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-transparent outline-none transition">
                @error('password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-slate-600 dark:text-slate-400 cursor-pointer">
                    <input type="checkbox" wire:model="remember" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    <span x-text="lang === 'tl' ? 'Tandaan ako' : 'Remember me'"></span>
                </label>
            </div>

            <button type="submit"
                    class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition duration-200 flex items-center justify-center gap-2">
                <span wire:loading.remove x-text="lang === 'tl' ? 'Mag-login sa Dashboard' : 'Sign In to Dashboard'"></span>
                <span wire:loading x-text="lang === 'tl' ? 'Sinusuri...' : 'Authenticating...'"></span>
            </button>
        </form>

     
        <div class="mt-6 pt-5 border-t border-slate-200 dark:border-slate-700 text-xs text-slate-500 dark:text-slate-400">
            <p class="font-semibold text-slate-700 dark:text-slate-300 mb-1" x-text="lang === 'tl' ? 'Mga Test Account (Para sa Ebalwasyon):' : 'Test Accounts (For Evaluation):'"></p>
            <p>Admin: <code class="text-blue-600 dark:text-blue-400">admin@tugonbarangay.ph</code> | <code class="text-blue-600 dark:text-blue-400">password123</code></p>
            <p>Staff: <code class="text-blue-600 dark:text-blue-400">staff@tugonbarangay.ph</code> | <code class="text-blue-600 dark:text-blue-400">password123</code></p>
        </div>
    </div>
</div>