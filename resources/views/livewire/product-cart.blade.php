<div>
    <x-validation-errors class="mb-4" :errors="$errors" />

    <div>
        <div wire:loading.flex class="absolute top-0 left-0 w-full h-full bg-white bg-opacity-75 z-50">
            <div class="m-auto">
                <x-loading />
            </div>
        </div>
        <x-table>
            <x-slot name="thead">
                <x-table.th>{{ __('Produk') }}</x-table.th>
                <x-table.th>{{ __('Net Unit Price') }}</x-table.th>
                <x-table.th>{{ __('Stok') }}</x-table.th>
                <x-table.th>{{ __('Jumlah') }}</x-table.th>
                <x-table.th>{{ __('Sub Total') }}</x-table.th>
                <x-table.th>{{ __('Aksi') }}</x-table.th>
            </x-slot>
            <x-table.tbody>
                @if ($cart_items->isNotEmpty())
                    @foreach ($cart_items as $cart_item)
                        <x-table.tr>
                            <x-table.td>
                                {{ $cart_item->name }} @if ($cart_item->options->code != null)
                                    ({{ $cart_item->options->code }})
                                @endif
                                @include('livewire.includes.product-cart-modal')
                            </x-table.td>

                            <x-table.td>
                                Rp. {{ number_format($cart_item->options->unit_price) }}
                                @include('livewire.includes.product-cart-price')
                            </x-table.td>

                            <x-table.td>
                                <span
                                    class="badge badge-info">
                                    {{ $cart_item->options->stock . ' ' . $cart_item->options->unit }}
                                </span>
                            </x-table.td>

                            <x-table.td>
                                @include('livewire.includes.product-cart-quantity')
                            </x-table.td>

                            <x-table.td>
                                Rp. {{ number_format($cart_item->options->sub_total) }}
                            </x-table.td>

                            <x-table.td>
                                <a href="#" wire:click.prevent="removeItem('{{ $cart_item->rowId }}')">
                                    <button class="text-rose-400 hover:text-rose-500 rounded-full">
                                        <span class="sr-only">Delete</span>
                                        <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                            <path d="M13 15h2v6h-2zM17 15h2v6h-2z" />
                                            <path d="M20 9c0-.6-.4-1-1-1h-6c-.6 0-1 .4-1 1v2H8v2h1v10c0 .6.4 1 1 1h12c.6 0 1-.4 1-1V13h1v-2h-4V9zm-6 1h4v1h-4v-1zm7 3v9H11v-9h10z" />
                                        </svg>
                                    </button>
                                </a>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                @else
                    <x-table.tr>
                        <x-table.td colspan="8" class="text-center">
                            <span class="text-red-500">
                                {{ __('Please search & select products!') }}
                            </span>
                        </x-table.td>
                    </x-table.tr>
                @endif
            </x-table.tbody>
        </x-table>
    </div>
    <div class="flex flex-wrap md:justify-end">
        <div class="w-full">
            <div class="w-full py-2">
                <x-table-responsive>
                    @if ($toko->is_tax == 1)
                    <x-table.tr>
                        <x-table.th>{{ __('Order Tax') }} ({{ $global_tax }}%)</x-table.th>
                        <x-table.td>(+) {{ number_format(Cart::instance($cart_instance)->tax()) }}</x-table.td>
                    </x-table.tr>
                    @endif
                    <x-table.tr>
                        <x-table.th>{{ __('Discount') }} ({{ $global_discount }}%)</x-table.th>
                        <x-table.td>(-) {{ number_format(Cart::instance($cart_instance)->discount()) }}</x-table.td>
                    </x-table.tr>
                    <x-table.tr>
                        <x-table.th>{{ __('Grand Total') }}</x-table.th>
                        @php
                            $total_with_shipping = Cart::instance($cart_instance)->total();
                        @endphp
                        <x-table.th>
                            (=) {{ number_format($total_with_shipping) }}
                        </x-table.th>
                    </x-table.tr>
                </x-table-responsive>
            </div>
        </div>
    </div>

    <input type="hidden" name="total_amount" value="{{ $total_with_shipping }}">

    <div class="flex flex-wrap my-2">
        <div class="w-full md:w-1/3 px-2 mb-4 md:mb-0">
            <div class="mb-4">
                <label for="tax_percentage">{{ __('Order Tax (%)') }}</label>
                <x-input wire:model.lazy="global_tax" name="tax_percentage" value="{{ $global_tax }}" />
            </div>
        </div>
        <div class="w-full md:w-1/3 px-2 mb-4 md:mb-0">
            <div class="mb-4">
                <label for="discount_percentage">{{ __('Discount (%)') }}</label>
                <x-input wire:model.lazy="global_discount" name="discount_percentage" value="{{ $global_discount }}" />
            </div>
        </div>
    </div>
</div>
