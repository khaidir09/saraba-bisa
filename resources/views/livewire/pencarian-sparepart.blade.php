<div>
        <x-select
            wire:model.defer="spareparts_id"
            placeholder="Pilih Sparepart"
            :options="$spareparts"
            option-description="harga_pelanggan"
            option-label="name"
            option-value="id"
        />
</div>