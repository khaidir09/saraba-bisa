<div>
        <x-select
            wire:model.defer="kerusakan"
            placeholder="Pilih Kerusakan"
            :options="$service_actions"
            option-label="nama_tindakan"
            option-value="nama_tindakan"
        />
</div>