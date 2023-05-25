<div>
    <!-- Page header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-3">

        <!-- Left: Title -->
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Point of Sales (POS) ✨</h1>
        </div>

    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-7 bg-white shadow-lg rounded-sm border border-slate-200">
            <header class="px-5 py-4 border-b border-slate-100"><h2 class="font-semibold text-slate-800">Keranjang</h2></header>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <!-- Table header -->
                    <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
                        <tr>
                            <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-semibold text-left">Nama</div>
                            </th>
                            <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-semibold text-left">Jumlah</div>
                            </th>
                            <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-semibold text-left">Harga</div>
                            </th>
                            <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-semibold text-left">Total</div>
                            </th>
                            <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-semibold text-left">Aksi</div>
                            </th>
                        </tr>
                    </thead>

                    @php
                        $allcart = Cart::content();
                    @endphp

                    <!-- Table body -->
                    <tbody class="text-sm divide-y divide-slate-200">
                        @foreach ($allcart as $cart)
                            <!-- Row -->
                            <tr>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-medium">{{ $cart->name }}</div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="space-x-1 flex">
                                        <form action="{{ url('/produk/cart-update/'.$cart->rowId) }}" method="post">
                                            @csrf
                                            <input type="number" name="qty" value="{{ $cart->qty }}" min="1" class="text-sm font-medium" style="width: 60px;">
                                            <button type="submit" class="text-rose-500 hover:text-rose-600 rounded-full">
                                                <span class="sr-only">Update</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6f32be" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-medium">{{ $cart->price }}</div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-medium">{{ $cart->price * $cart->qty }}</div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="space-x-1 flex">
                                        <a href="{{ url('/produk/cart-remove/'.$cart->rowId) }}">
                                            <button class="text-rose-400 hover:text-rose-500 rounded-full">
                                                <span class="sr-only">Delete</span>
                                                <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                                    <path d="M13 15h2v6h-2zM17 15h2v6h-2z" />
                                                    <path d="M20 9c0-.6-.4-1-1-1h-6c-.6 0-1 .4-1 1v2H8v2h1v10c0 .6.4 1 1 1h12c.6 0 1-.4 1-1V13h1v-2h-4V9zm-6 1h4v1h-4v-1zm7 3v9H11v-9h10z" />
                                                </svg>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-slate-50 p-5 shadow-lg">
                <div class="text-slate-500 font-semibold mb-2">Ringkasan Penjualan</div>
                <!-- Order details -->
                <ul class="mb-4">
                    <li class="text-sm w-full flex justify-between py-3 border-b border-slate-200">
                        <div>Jumlah Barang</div>
                        <div class="font-medium text-slate-800">{{ Cart::count() }}</div>
                    </li>
                    <li class="text-sm w-full flex justify-between py-3 border-b border-slate-200">
                        <div>Total Harga</div>
                        <div class="font-medium text-emerald-600">{{ Cart::subtotal() }}</div>
                    </li>
                </ul>
                <div class="mb-4">
                    <button class="btn w-full bg-indigo-500 hover:bg-indigo-600 text-white" href="#0">Proses</button>
                </div>
            </div>
        </div>

        <div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-5">
            <div class="sm:flex sm:justify-between sm:items-center mb-5">
                <div class="mb-0">
                    <select wire:model="paginate" id="" class="form-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="mt-2 md:mt-0">
                    <x-search-form placeholder="Masukkan nama produk" />
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-sm border border-slate-200">
                <header class="px-5 py-4">
                    <h2 class="font-semibold text-slate-800">Semua Produk <span class="text-slate-400 font-medium">{{ $products_count }}</span></h2>
                </header>
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <!-- Table header -->
                        <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
                            <tr>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">No.</div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">Nama Produk</div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm divide-y divide-slate-200">
                            <!-- Row -->
                            @php
                                $i = 1
                            @endphp
                            @foreach($products as $item)                  
                            <form action="{{ url('/produk/add-cart') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="hidden" name="name" value="{{ $item->product_name }}">
                                <input type="hidden" name="qty" value="1">
                                <input type="hidden" name="price" value="{{ $item->harga_pelanggan }}">
                                <tr>    
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <div class="font-medium">{{ $i++ }}</div>
                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <div class="font-medium">{{ $item->product_name }}</div>
                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <div class="space-x-1 flex">
                                            <button type="submit" class="text-slate-400 hover:text-slate-500 rounded-full">
                                                <span class="sr-only">Masukkan keranjang</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M17 17h-11v-14h-2" />
                                                    <path d="M6 5l6 .429m7.138 6.573l-.143 1h-13" />
                                                    <path d="M15 6h6m-3 -3v6" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>
