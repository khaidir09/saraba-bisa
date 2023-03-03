<div>
    <div x-data="{ modalOpen: false }">
        <div class="relative">
            <input wire:model="search" id="modal_sparepart"
            name="modal_sparepart" class="form-input w-full pl-9 px-2 py-1" 
            type="text" @input.prevent="modalOpen = true"
            placeholder="Ketik nama tindakan servis"
            required/>
            <button class="absolute inset-0 right-auto group" aria-label="Search" disabled>
                <svg class="w-3 h-3 shrink-0 fill-current text-slate-400 ml-3 mr-2" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
                    <path d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
                </svg>
            </button>
        </div>
        <div>
            <select wire:model.defer="modal_sparepart" id="modal_sparepart" name="modal_sparepart" class="form-select w-full mt-2 bg-indigo-500 text-white" x-show="modalOpen">
                @foreach($service_actions as $action)
                <option value="{{ $action->modal_sparepart }}">{{ $action->nama_tindakan }} | {{ $action->modal_sparepart }}</option>
                @endforeach
            </select>
        </div>      
    </div>
</div>
