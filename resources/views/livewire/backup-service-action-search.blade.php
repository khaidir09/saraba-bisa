<div>
    <div x-data="{ modalOpen: false }">
        <input wire:model="search" id="kerusakan" name="kerusakan" class="form-input w-full px-2 py-1" type="text" @input.prevent="modalOpen = true" required/>
            <select wire:model.defer="kerusakan" id="kerusakan" name="kerusakan" class="form-select" x-show="modalOpen">
                @foreach($service_actions as $action)
                <option value="{{ $action->nama_tindakan }}">{{ $action->nama_tindakan }} | {{ $action->modal_sparepart }}</option>
                @endforeach
            </select>        
    </div>
</div>
