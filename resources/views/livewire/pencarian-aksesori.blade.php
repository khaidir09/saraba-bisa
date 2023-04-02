<div>
        <x-select
            wire:model.defer="accessories_id"
            placeholder="Pilih Aksesori"
            :options="$accessories"
            option-description="harga_pelanggan"
            option-label="name"
            option-value="id"
        />
</div>