<div>
        <x-select
            wire:model.defer="customers_id"
            placeholder="Pilih Pelanggan"
            :options="$customers"
            option-label="nama"
            option-value="id"
            required
        />
</div>