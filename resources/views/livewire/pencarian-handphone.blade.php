<div>
        <x-select
            wire:model.defer="phones_id"
            placeholder="Pilih Handphone"
            :options="$phones"
            option-description="harga_pelanggan"
            option-label="modelserie.name"
            option-value="id"
        />
</div>