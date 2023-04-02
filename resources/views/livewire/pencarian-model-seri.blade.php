<div>
        <x-select
            wire:model.defer="model_series_id"
            placeholder="Pilih Model Seri"
            :options="$model_series"
            option-label="name"
            option-value="id"
        />
</div>