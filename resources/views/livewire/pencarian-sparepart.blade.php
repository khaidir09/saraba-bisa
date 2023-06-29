<div>
        <x-select
            wire:model.defer="products_id"
            placeholder="Pilih Sparepart"
            :options="$products"
            option-description="harga_jual"
            option-label="product_name"
            option-value="id"
        />
</div>