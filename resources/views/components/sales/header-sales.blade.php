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
                    @if ($toko->is_bonus === 1)
                        <div class="mb-2">Halo <strong class="font-medium text-slate-800">{{ Auth::user()->name }}</strong> 👋, ini adalah ringkasan bonus kamu sebagai Sales bulan ini:</div>
                        <div class="text-3xl font-bold text-emerald-500">Rp. {{ number_format($totalbonus) }}</div>
                        @if ($target != 0)
                            @if ($result < $target)
                                <p class="mt-2">Namun karena target kamu belum tercapai, saat ini kamu hanya mendapatkan bonus sebesar <span class="font-bold bg-blue-500 text-white rounded-full px-2.5 py-1">Rp. {{ number_format($reward) }}</span></p>
                            @endif
                        @endif
                    @else
                        <div class="mb-2">Halo, <strong class="font-medium text-slate-800">{{ Auth::user()->name }}</strong> 👋</div>
                    @endif
                </div>
                {{-- @if ($target != 0)
                    <div>
                        <div class="mb-2">Halo <strong class="font-medium text-slate-800">{{ Auth::user()->name }}</strong> 👋, ini adalah ringkasan bonus kamu sebagai Sales bulan ini:</div>
                        <div class="text-2xl font-bold text-emerald-500">Rp. {{ number_format($totalbonus) }} + <span class="text-blue-700">Rp. {{ number_format($reward) }}</span> <span class="text-sm text-blue-700">(Reward Target)</span> = Rp. {{ number_format($totalbonus + $reward) }}
                        </div>
                    </div>
                @else
                    <div>
                        <div class="mb-2">Halo <strong class="font-medium text-slate-800">{{ Auth::user()->name }}</strong> 👋, ini adalah ringkasan bonus kamu sebagai Sales bulan ini:</div>
                        <div class="text-2xl font-bold text-emerald-500">Rp. {{ number_format($totalbonus) }}</div>
                    </div>
                @endif --}}
            </div>
        </div>
    </div>
</div>