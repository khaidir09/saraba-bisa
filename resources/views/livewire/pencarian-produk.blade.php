<div>
        <x-select
            wire:model.defer="products_id"
            placeholder="Pilih Produk"
            :options="$products"
            option-description="harga_modal"
            option-label="product_name"
            option-value="id"
        />
</div>