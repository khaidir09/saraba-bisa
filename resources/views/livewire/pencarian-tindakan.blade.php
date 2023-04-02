<div>
        <x-select
            wire:model.defer="service_actions_id"
            placeholder="Pilih Tindakan"
            :options="$service_actions"
            option-description="harga_pelanggan"
            option-label="nama_tindakan"
            option-value="id"
        />
</div>