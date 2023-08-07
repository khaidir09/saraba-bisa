<div>
    <h3 class="text-xl leading-snug text-slate-800 font-bold mb-1">Penerapan Pajak</h3>
    <div class="text-sm">Dengan meangktifkan penerapan pajak maka menu, inputan, dan perhitungan pajak akan dimunculkan pada sistem.</div>
    <div class="flex items-center mt-5">
        <div class="form-switch">
            <input type="checkbox" id="toggle" class="sr-only" wire:model="taxApplied" />
            <label class="bg-slate-400" for="toggle">
                <span class="bg-white shadow-sm" aria-hidden="true"></span>
                <span class="sr-only">Penerapan Pajak</span>
            </label>
        </div>
        <div class="text-sm text-slate-400 italic ml-2" x-text="taxApplied ? 'Aktif' : 'Tidak Aktif'"></div>
    </div>
</div>