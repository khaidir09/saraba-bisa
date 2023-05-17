<div class="flex flex-col col-span-full bg-white shadow-lg rounded-sm border border-slate-200">
    <div class="px-5 py-6">
        <div class="md:items-center">
            <!-- Left side -->
            <div class="flex items-center mb-4 md:mb-0">
                <!-- Avatar -->
                <div class="mr-4">
                    @if (Auth::user()->profile_photo_path != null)
                        <img class="inline-flex rounded-full" src="{{ Storage::url(Auth::user()->profile_photo_path ) }}" width="64" height="64" alt="{{ Auth::user()->name }}" />
                    @else
                        <img class="inline-flex rounded-full" src="{{ Auth::user()->profile_photo_url }}" width="64" height="64" alt="{{ Auth::user()->name }}" />
                    @endif
                </div>
                <!-- User info -->
                <div>
                    <div class="mb-2">Halo <strong class="font-medium text-slate-800">{{ Auth::user()->name }}</strong> 👋, ini adalah ringkasan bonus kamu sebagai Teknisi bulan ini:</div>
                    @if ($pengeluaran != null)
                        <div class="text-3xl font-bold text-emerald-500">Rp. {{ number_format($totalbonus) }} <span class="text-sm text-slate-800">(sudah dikurangi beban pengeluaran)</span></div>
                    @else
                        <div class="text-3xl font-bold text-emerald-500">Rp. {{ number_format($totalbonus) }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>