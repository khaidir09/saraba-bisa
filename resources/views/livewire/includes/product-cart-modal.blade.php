<div>
    <!-- Button trigger Discount Modal -->
    <button type="button" wire:click="discountModal('{{ $cart_item->id }}', '{{ $cart_item->rowId }}')"
        class="border border-red-500 text-red-500 hover:text-reg-800">
        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-percentage"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M7 7m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M6 18l12 -12" /></svg>
    </button>
    <!-- Discount Modal -->
    <x-modal wire:model="discountModal">
        <x-slot name="title">
            <div class="text-center text-xl">
                {{ $cart_item->name }}
                <x-badge type="success">
                    {{ $cart_item->options->code }}
                </x-badge>
            </div>
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="productDiscount('{{ $cart_item->rowId }}', '{{ $cart_item->id }}')">
                <!-- Validation Errors -->
                <x-validation-errors class="mb-4" :errors="$errors" />
                <div class="grid grid-cols-2 gap-4 my-4">
                    <div>
                        <label>{{ __('Discount Type') }}<span class="text-red-500">*</span></label>
                        <select wire:model="discount_type.{{ $cart_item->id }}"
                            class="block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md mt-1"
                            required>
                            <option value="fixed">{{ __('Fixed') }}</option>
                            <option value="percentage">{{ __('Percentage') }}</option>
                        </select>
                    </div>
                    <div>
                        @if ($discount_type[$cart_item->id] == 'percentage')
                            <label>{{ __('Discount(%)') }} <span class="text-red-500">*</span></label>
                            <x-input wire:model.defer="item_discount.{{ $cart_item->id }}" type="text"
                                value="{{ $item_discount[$cart_item->id] }}" min="0" max="100" />
                        @elseif($discount_type[$cart_item->id] == 'fixed')
                            <label>{{ __('Discount') }} <span class="text-red-500">*</span></label>
                            <x-input wire:model.defer="item_discount.{{ $cart_item->id }}" type="text"
                                value="{{ $item_discount[$cart_item->id] }}" />
                        @endif
                    </div>
                </div>
                <div class="w-full">
                    <x-button primary type="submit" class="w-full text-center">
                        {{ __('Save changes') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
