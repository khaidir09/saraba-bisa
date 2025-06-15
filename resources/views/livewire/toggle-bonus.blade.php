<div>
    <h3 class="text-xl leading-snug text-slate-800 font-bold mb-1">Informasi Bonus</h3>
    <div class="text-sm">Dengan meangktifkan ini maka informasi bonus pada akun Admin, Teknisi, Sales akan dimunculkan pada sistem.</div>
    <div class="flex items-center mt-3">
        <div class="form-switch">
            <input type="checkbox" id="toggleBonus" class="sr-only" wire:model="bonusApplied" />
            <label class="bg-slate-400" for="toggleBonus">
                <span class="bg-white shadow-sm" aria-hidden="true"></span>
                <span class="sr-only">Informasi Bonus</span>
            </label>
        </div>
        <div class="text-sm text-slate-400 italic ml-2" x-text="bonusApplied ? 'Aktif' : 'Tidak Aktif'"></div>
    </div>
</div>