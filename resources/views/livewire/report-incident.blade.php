<div class="max-w-2xl mx-auto px-4 py-10"
     x-data="{
         gettingLocation: false,
         gpsMessage: '',
         getLocation() {
             if (!navigator.geolocation) {
                 this.gpsMessage = 'Geolocation is not supported by your browser.';
                 return;
             }
             this.gettingLocation = true;
             this.gpsMessage = '';
             navigator.geolocation.getCurrentPosition(
                 (pos) => {
                     $wire.set('latitude', pos.coords.latitude.toFixed(6));
                     $wire.set('longitude', pos.coords.longitude.toFixed(6));
                     this.gettingLocation = false;
                     this.gpsMessage = 'GPS Coordinates captured!';
                 },
                 (err) => {
                     this.gettingLocation = false;
                     this.gpsMessage = 'Unable to retrieve GPS. Please allow location permission.';
                 }
             );
         }
     }">

    @if($submittedCode)
        <div class="mb-6 p-6 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-emerald-900 dark:text-emerald-200 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
                <span class="text-2xl">✅</span>
                <h3 class="font-bold text-lg" x-text="lang === 'tl' ? 'Matagumpay na Naisumite ang Ulat!' : 'Incident Report Submitted Successfully!'"></h3>
            </div>
            <p class="text-sm mb-3" x-text="lang === 'tl' ? 'Itabi ang iyong Tracking Code upang masubaybayan ang aksyon ng barangay:' : 'Save your Tracking Code to monitor barangay response:'"></p>
            <div class="flex items-center justify-between bg-white dark:bg-slate-900 px-4 py-3 rounded-xl border border-emerald-300 dark:border-emerald-700">
                <span class="font-mono font-extrabold text-xl tracking-wider text-blue-600 dark:text-blue-400">{{ $submittedCode }}</span>
                <a href="/track" class="text-xs font-bold px-3 py-1.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition"
                   x-text="lang === 'tl' ? 'I-track Ngayon →' : 'Track Now →'"></a>
            </div>
        </div>
    @endif

    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-800 p-6 md:p-8">
        <div class="border-b border-slate-200 dark:border-slate-800 pb-5 mb-6">
            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white"
                x-text="lang === 'tl' ? 'Mag-ulat ng Insidente' : 'Submit Incident Report'"></h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1"
               x-text="lang === 'tl' ? 'Punan ang mga detalye sa ibaba. Ang lahat ng impormasyon ay protektado ng Data Privacy Act.' : 'Fill out the details below. All information is protected under the Data Privacy Act.'"></p>
        </div>

        <form wire:submit.prevent="submitReport" class="space-y-5">
           
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5"
                       x-text="lang === 'tl' ? 'Pamagat ng Insidente / Isyu:' : 'Incident Title / Subject:'"></label>
                <input type="text" wire:model="title" placeholder="Hal. Sirang poste ng ilaw / Alitan sa kalsada"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 outline-none transition">
                @error('title') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5"
                       x-text="lang === 'tl' ? 'Kategorya:' : 'Incident Category:'"></label>
                <select wire:model.live="category"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 outline-none transition">
                    <option value="Public Safety">Public Safety (Kaligtasan sa Publiko)</option>
                    <option value="Neighborhood Dispute">Neighborhood Dispute (Alitan sa Kapitbahay)</option>
                    <option value="Medical / Emergency">Medical / Emergency (Emerhensyang Medikal)</option>
                    <option value="Infrastructure / Hazard">Infrastructure / Hazard (Sirang Daan / Baha)</option>
                    <option value="Peace and Order">Peace and Order (Katahimikan at Kaayusan)</option>
                    <option value="Other">Other (Iba pa)</option>
                </select>
                @error('category') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            @if($category === 'Other')
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5"
                           x-text="lang === 'tl' ? 'Tukuyin ang Iba pang Kategorya:' : 'Specify Other Category:'"></label>
                    <input type="text" wire:model="otherCategory" placeholder="Hal. Stray animals, sunog, ingay sa gabi..."
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 outline-none transition">
                    @error('otherCategory') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            @endif

           
            <div class="space-y-3">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300"
                       x-text="lang === 'tl' ? 'Lokasyon / Purok:' : 'Location / Purok:'"></label>
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="text" wire:model="location" placeholder="Hal. Purok 3, malapit sa Chapel"
                           class="flex-grow px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 outline-none transition">
                    <button type="button" @click="getLocation()"
                            class="px-4 py-2.5 rounded-xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-700 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800 font-semibold text-xs hover:bg-indigo-100 transition flex items-center justify-center gap-1.5 shrink-0 cursor-pointer">
                        <span>📍</span>
                        <span x-text="gettingLocation ? 'Locating...' : (lang === 'tl' ? 'I-geotag (GPS)' : 'Pin GPS Location')"></span>
                    </button>
                </div>
                @error('location') <span class="text-xs text-red-500 block">{{ $message }}</span> @enderror

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <input type="text" wire:model="latitude" readonly placeholder="Latitude (Auto-GPS)"
                               class="w-full px-3 py-1.5 text-xs rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800/60 text-slate-600 dark:text-slate-400">
                    </div>
                    <div>
                        <input type="text" wire:model="longitude" readonly placeholder="Longitude (Auto-GPS)"
                               class="w-full px-3 py-1.5 text-xs rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800/60 text-slate-600 dark:text-slate-400">
                    </div>
                </div>
                <p x-show="gpsMessage" x-text="gpsMessage" class="text-xs text-emerald-600 dark:text-emerald-400 font-medium"></p>
            </div>

            
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5"
                       x-text="lang === 'tl' ? 'Deskripsyon ng Pangyayari:' : 'Incident Description:'"></label>
                <textarea wire:model="description" rows="4" placeholder="Ikwento ang buong detalye ng insidente..."
                          class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 outline-none transition"></textarea>
                @error('description') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

          
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5"
                       x-text="lang === 'tl' ? 'Maglakip ng Ebidensya (Larawan):' : 'Attach Photo Evidence (Optional):'"></label>
                <input type="file" wire:model="evidence" accept="image/*"
                       class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 dark:file:bg-blue-950 file:text-blue-700 dark:file:text-blue-300 hover:file:bg-blue-100 cursor-pointer">
                @error('evidence') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror

                @if ($evidence)
                    <div class="mt-3">
                        <img src="{{ $evidence->temporaryUrl() }}" class="h-36 rounded-xl object-cover border border-slate-200 dark:border-slate-700 shadow-sm">
                    </div>
                @endif
            </div>


            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 space-y-2">
                <div class="flex items-start gap-3">
                    <input type="checkbox" wire:model="terms" id="privacy-terms"
                           class="mt-1 h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                    <label for="privacy-terms" class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed cursor-pointer">
                        <span class="font-semibold" x-text="lang === 'tl' ? 'Pahayag sa Pagkapribado ng Datos (Data Privacy Consent):' : 'Data Privacy Consent Statement:'"></span>
                        <span x-text="lang === 'tl' ? 'Sumasang-ayon ako na kolektahin at iproseso ng TugonBarangay ang aking mga impormasyon para sa pagtugon sa insidenteng ito alinsunod sa Data Privacy Act of 2012.' : 'I agree that TugonBarangay may collect and process my information for incident response purposes in accordance with the Data Privacy Act of 2012.'"></span>
                    </label>
                </div>
                @error('terms') <span class="text-xs text-red-500 block pl-7">{{ $message }}</span> @enderror
            </div>

            
            <div class="pt-2 flex justify-end">
                <button type="submit"
                        class="w-full sm:w-auto px-8 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-md hover:shadow-lg transition cursor-pointer">
                    <span wire:loading.remove wire:target="submitReport" x-text="lang === 'tl' ? 'Isumite ang Report' : 'Submit Incident Report'"></span>
                    <span wire:loading wire:target="submitReport" x-text="lang === 'tl' ? 'Ipinapadala...' : 'Submitting...'"></span>
                </button>
            </div>
        </form>
    </div>
</div>