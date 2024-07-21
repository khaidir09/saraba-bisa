<div>
    <div class="w-full px-2" dir="ltr">
        <x-validation-errors class="mb-4" :errors="$errors" />

        <div class="flex gap-4">
            <div class="w-full relative inline-flex">
                <select required id="customer_id" name="customer_id" wire:model="customer_id" class="form-select text-sm block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                    <option value="">{{ __('Pilih Pelanggan') }}</option>
                    @foreach ($this->customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <livewire:product-cart :cartInstance="'sale'" />

        <button
            class="w-full inline-flex items-center px-4 py-2 border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 bg-green-500 hover:bg-green-700"
            type="submit" wire:click="proceed" wire:loading.attr="disabled" {{ $total_amount == 0 ? 'disabled' : '' }}>
            {{ __('Proses Pembayaran') }}
        </button>

    </div>

    <div x-data="{ modalOpen: @entangle('checkoutModal') }">
        <div
            class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity"
            x-show="modalOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-out duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            aria-hidden="true"
            x-cloak
        ></div>
        
        <div
            id="checkout-modal"
            class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center px-4 sm:px-6"
            role="dialog"
            aria-modal="true"
            x-show="modalOpen"
            x-transition:enter="transition ease-in-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in-out duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            x-cloak
        >
            <div class="bg-white rounded shadow-lg overflow-auto max-w-xl w-full max-h-full" @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
                <div class="px-5 py-4">
                    <div class="text-center text-xl">
                        {{ __('Pembayaran') }}
                    </div>
                    <form id="checkout-form" wire:submit.prevent="store">
                        <input type="hidden" wire:model="order_date" name="order_date" value="{{ \Carbon\Carbon::today()->locale('id')->translatedFormat('d F Y') }}">
                        <div class="space-y-3">
                            <div class="w-full px-2">
                                <label class="block text-sm font-medium mb-1" for="total_amount" :value="__('Total Amount')">{{ __('Jumlah Total') }} <span class="text-rose-500">*</span></label>
                                <input id="total_amount" type="text" wire:model="total_amount"
                                    class="block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md mt-1"
                                    name="total_amount" readonly required>
                            </div>
                            <div class="w-full px-2">
                                <label class="block text-sm font-medium mb-1" for="paid_amount" :value="__('Paid Amount')">{{ __('Jumlah Pembayaran') }} <span class="text-rose-500">*</span></label>
                                <input id="paid_amount" type="text" wire:model="paid_amount"
                                    class="block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md mt-1"
                                    name="paid_amount" required>
                            </div>
                            <div class="w-full px-2">
                                <label class="block text-sm font-medium" for="payment_method" :value="__('Payment Method')">{{ __('Metode Pembayaran') }} <span class="text-rose-500">*</span></label>
                                <small class="mb-1">Jika jumlah pembayaran kurang dari jumlah total maka pilih Kredit</small>
                                <select wire:model="payment_method" id="payment_method" required
                                    class="block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md mt-1">
                                    <option value="Tunai">{{ __('Tunai') }}</option>
                                    <option value="Bank Transfer">{{ __('Bank Transfer') }}</option>
                                    <option value="Kredit">{{ __('Kredit') }}</option>
                                    <option value="Lainnya">{{ __('Lainnya') }}</option>
                                </select>
                            </div>
                            <div class="mb-4 w-full px-2">
                                <label class="block text-sm font-medium mb-1" for="note" :value="__('Note')">{{ __('Catatan') }}</label>
                                <textarea name="note" id="note" rows="5" wire:model="note"
                                    class="block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md mt-1"></textarea>
                            </div>
                            <div class="w-full px-2">
                                <x-table-responsive>
                                    <x-table.tr>
                                        <x-table.th>
                                            {{ __('Total Produk') }}
                                        </x-table.th>
                                        <x-table.td>
                                            <span class="badge badge-success">
                                                {{ Cart::instance($cart_instance)->count() }} item
                                            </span>
                                        </x-table.td>
                                    </x-table.tr>
                                    {{-- @if ($toko->is_tax === 1)
                                        <x-table.tr>
                                            <x-table.th>
                                                {{ __('PPN') }} ({{ $toko->ppn }}%)
                                            </x-table.th>
                                            <x-table.td>
                                                (+) Rp. {{ number_format(Cart::instance($cart_instance)->tax()) }}
                                            </x-table.td>
                                        </x-table.tr>
                                    @endif --}}
                                    <x-table.tr>
                                        <x-table.th>
                                            {{ __('Diskon') }} ({{ $global_discount }}%)
                                        </x-table.th>
                                        <x-table.td>
                                            (-) Rp. {{ number_format(Cart::instance($cart_instance)->discount()) }}
                                        </x-table.td>
                                    </x-table.tr>
                                    <x-table.tr>
                                        <x-table.th>
                                            {{ __('Total') }}
                                        </x-table.th>
                                        <x-table.td>
                                            (=) Rp. {{ number_format($total_amount) }}
                                        </x-table.td>
                                    </x-table.tr>
                                </x-table-responsive>
                                <div class="float-left py-4">
                                    <button type="submit" x-on:click="modalOpen = false" class="btn border-slate-200 hover:border-slate-300 text-slate-600 mr-2">
                                        Batal
                                    </button>
                                    <button type="submit" wire:loading.attr="disabled" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                                        Selesaikan Transaksi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
