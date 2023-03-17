<div>
    <div class="sm:flex sm:justify-between sm:items-center">
        <select wire:model="paginate" id="" class="form-select">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>

        <!-- Right: Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

            <!-- Search form -->
            <x-search-form placeholder="Masukkan nomor transaksi" />

            <!-- Create invoice button -->
            <div x-data="{ modalOpen: false }">
                <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" @click.prevent="modalOpen = true" aria-controls="tambah-modal">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">Tambah Transaksi Baru</span>
                </button>
                <!-- Modal backdrop -->
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
                <!-- Modal dialog -->
                <div
                    id="tambah-modal"
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
                    <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full" @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
                        <!-- Modal header -->
                        <div class="px-5 py-3 border-b border-slate-200">
                            <div class="flex justify-between items-center">
                                <div class="font-semibold text-slate-800">Tambah Transaksi Baru</div>
                                <button class="text-slate-400 hover:text-slate-500" @click="modalOpen = false">
                                    <div class="sr-only">Close</div>
                                    <svg class="w-4 h-4 fill-current">
                                        <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <!-- Modal content -->
                        <form action="{{ route('sales-transaksi-sparepart.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="persen_sales" value="{{ Auth::user()->persen }}">
                            <div class="px-5 py-4">
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="customers_id">Nama Pelanggan <span class="text-rose-500">*</span></label>
                                        <livewire:customer-search></livewire:customer-search>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="spareparts_id">Sparepart <span class="text-rose-500">*</span></label>
                                        <select id="spareparts_id" name="spareparts_id" class="form-select text-sm py-1 w-full" required>
                                            <option>Pilih Sparepart</option>
                                            @foreach ($spareparts as $sparepart)
                                                <option value="{{ $sparepart->id }}">{{ $sparepart->name }} | Modal {{ number_format($sparepart->modal) }} | Toko {{ number_format($sparepart->harga_toko) }} | Pelanggan {{ number_format($sparepart->harga_pelanggan) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="quantity">Jumlah <span class="text-rose-500">*</span></label>
                                        <input id="quantity" name="quantity" class="form-input w-full px-2 py-1" type="number" required/>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="modal">Modal <span class="text-rose-500">*</span></label>
                                        <div class="relative">
                                            <input id="modal" name="modal" class="form-input w-full pl-10 px-2 py-1" type="number" required/>
                                            <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                                <span class="text-sm text-slate-400 font-medium px-3">Rp.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="harga">Harga Jual <span class="text-rose-500">*</span></label>
                                        <div class="relative">
                                            <input id="harga" name="harga" class="form-input w-full pl-10 px-2 py-1" type="number" required/>
                                            <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                                <span class="text-sm text-slate-400 font-medium px-3">Rp.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="diskon">Diskon</label>
                                        <div class="relative">
                                            <input id="diskon" name="diskon" class="form-input w-full pl-10 px-2 py-1" type="number"/>
                                            <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                                <span class="text-sm text-slate-400 font-medium px-3">Rp.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="cara_pembayaran">Cara Pembayaran</label>
                                        <select id="cara_pembayaran" name="cara_pembayaran" class="form-select text-sm py-1 w-full">
                                            <option value="Tunai">Tunai</option>
                                            <option value="Tempo 1 Hari">Tempo 1 Hari</option>
                                            <option value="Tempo 2 Hari">Tempo 2 Hari</option>
                                            <option value="Tempo 3 Hari">Tempo 3 Hari</option>
                                            <option value="Tempo 4 Hari">Tempo 4 Hari</option>
                                            <option value="Tempo 5 Hari">Tempo 5 Hari</option>
                                            <option value="Tempo 6 Hari">Tempo 6 Hari</option>
                                            <option value="Tempo 1 Minggu">Tempo 1 Minggu</option>
                                            <option value="Tempo 2 Minggu">Tempo 2 Minggu</option>
                                            <option value="Tempo 3 Minggu">Tempo 3 Minggu</option>
                                            <option value="Tempo 1 Bulan">Tempo 1 Bulan</option>
                                            <option value="Tempo 2 Bulan">Tempo 2 Bulan</option>
                                            <option value="Tempo 3 Bulan">Tempo 3 Bulan</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="garansi">Garansi</label>
                                        <select id="garansi" name="garansi" class="form-select text-sm py-1 w-full">
                                            <option value="">Tidak Ada</option>
                                            <option value="1">1 Hari</option>
                                            <option value="2">2 Hari</option>
                                            <option value="3">3 Hari</option>
                                            <option value="4">4 Hari</option>
                                            <option value="5">5 Hari</option>
                                            <option value="6">6 Hari</option>
                                            <option value="7">1 Minggu</option>
                                            <option value="14">2 Minggu</option>
                                            <option value="21">3 Minggu</option>
                                            <option value="30">1 Bulan</option>
                                            <option value="60">2 Bulan</option>
                                            <option value="90">3 Bulan</option>
                                            <option value="120">4 Bulan</option>
                                            <option value="150">5 Bulan</option>
                                            <option value="180">6 Bulan</option>
                                            <option value="210">7 Bulan</option>
                                            <option value="240">8 Bulan</option>
                                            <option value="270">9 Bulan</option>
                                            <option value="300">10 Bulan</option>
                                            <option value="330">11 Bulan</option>
                                            <option value="365">1 Tahun</option>
                                            <option value="730">2 Tahun</option>
                                            <option value="1095">3 Tahun</option>
                                            <option value="1460">4 Tahun</option>
                                            <option value="1825">5 Tahun</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="users_id">Penerima/Sales</label>
                                        <input type="text" id="users_id" name="users_id" class="form-input w-full px-2 py-1 disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed" value="{{ Auth::user()->name }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="px-5 py-4 border-t border-slate-200">
                                <div class="flex flex-wrap justify-between">
                                    <a href="{{ route('sales-pelanggan.index') }}" class="btn-sm bg-green-500 hover:bg-green-600 text-white">
                                        Tambah Pelanggan Baru
                                    </a>
                                    <div>
                                        <button class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-sm border border-slate-200 mt-5 mb-8">
        <header class="px-5 py-4">
            <h2 class="font-semibold text-slate-800">Jumlah Transaksi <span class="text-slate-400 font-medium">{{ $sparepart_transactions_count }}</span></h2>
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
                            <div class="font-semibold text-left">Nomor Transaksi</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Tgl Transaksi</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Penerima/Sales</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Pelanggan</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Nama Barang</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Kuantitas</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Modal</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Harga Jual</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Diskon</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Pembayaran</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Masa Garansi</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Status</div>
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
                    @foreach($sparepart_transactions as $item)               
                        @php
                            if ($item->profit < '0') :
                                $color = 'text-red-600';
                            else :
                                $color = '';
                            endif;
                        @endphp
                        <tr class="{{ $color }}">
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-medium">{{ $i++ }}</div>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <a href="{{ route('sales-transaksi-sparepart.edit', $item->id) }}">
                                    <div class="flex items-center text-blue-600">
                                        <svg class="w-6 h-6 fill-current" viewBox="0 0 32 32">
                                            <path d="M19.7 8.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM12.6 22H10v-2.6l6-6 2.6 2.6-6 6zm7.4-7.4L17.4 12l1.6-1.6 2.6 2.6-1.6 1.6z" />
                                        </svg>
                                        <div class="font-medium">{{ $item->nomor_transaksi }}</div>
                                    </div>
                                </a>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</div>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-medium">{{ $item->user->name }}</div>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                @if ($item->customer != null)
                                    <div class="font-medium">{{ $item->customer->nama }}</div>
                                @else
                                    <div class="font-medium text-red-600">Data pelanggan sudah dihapus</div>
                                @endif
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                @if ($item->sparepart != null)
                                    <div class="font-medium">{{ $item->sparepart->name }}</div>
                                @else
                                    <div class="font-medium text-red-600">Data sparepart sudah dihapus</div>
                                @endif
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-medium">{{ $item->quantity }}</div>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-medium">Rp. {{ number_format($item->modal) }}</div>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-medium">Rp. {{ number_format($item->harga) }}</div>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-medium">Rp. {{ number_format($item->diskon) }}</div>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-medium">{{ $item->cara_pembayaran }}</div>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                @if ($item->exp_garansi === null)
                                    <div class="font-medium">Tidak Ada</div>
                                @elseif ($item->exp_garansi < \Carbon\Carbon::now())
                                    <div class="font-medium text-red-600">{{ \Carbon\Carbon::parse($item->exp_garansi)->format('d/m/Y') }}</div>
                                @else
                                    <div class="font-medium text-blue-600">{{ \Carbon\Carbon::parse($item->exp_garansi)->format('d/m/Y') }}</div>
                                @endif
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                @if ($item->is_approve === null)
                                    <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 bg-amber-500 text-white">Belum Disetujui</div>
                                @elseif ($item->is_approve === 'Setuju')
                                    <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 bg-blue-500 text-white">Sudah Disetujui</div>
                                @else
                                    <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 bg-red-500 text-white">Ditolak</div>
                                @endif
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                                <div class="space-x-1 flex">
                                    <!-- Start -->
                                    <div x-data="{ modalOpen: false }">
                                        <button class="text-rose-500 hover:text-rose-600 rounded-full" @click.prevent="modalOpen = true" aria-controls="danger-modal">
                                            <span class="sr-only">Delete</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <line x1="4" y1="7" x2="20" y2="7" />
                                                <line x1="10" y1="11" x2="10" y2="17" />
                                                <line x1="14" y1="11" x2="14" y2="17" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                        <!-- Modal backdrop -->
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
                                        <!-- Modal dialog -->
                                        <div
                                            id="danger-modal"
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
                                            <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full" @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
                                                <div class="p-5 flex space-x-4">
                                                    <!-- Icon -->
                                                    <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 bg-rose-100">
                                                        <svg class="w-4 h-4 shrink-0 fill-current text-rose-500" viewBox="0 0 16 16">
                                                            <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z" />
                                                        </svg>
                                                    </div>
                                                    <!-- Content -->
                                                    <div>
                                                        <!-- Modal header -->
                                                        <div class="mb-2">
                                                            <div class="text-lg font-semibold text-slate-800">Apakah anda sudah yakin ?</div>
                                                        </div>
                                                        <!-- Modal content -->
                                                        <div class="text-sm mb-10">
                                                            <div class="space-y-2">
                                                                <p>Jika sudah terhapus, maka tidak bisa dikembalikan lagi.</p>
                                                            </div>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="flex flex-wrap justify-end space-x-2">
                                                            <button class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600" @click="modalOpen = false">Batal</button>
                                                            <form action="{{ route('sales-transaksi-sparepart.destroy', $item->id) }}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="btn-sm bg-rose-500 hover:bg-rose-600 text-white">Ya, Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                            
                                    </div>
                                    <!-- End -->
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <!-- Pagination -->
    <div class="mt-8">
        {{ $sparepart_transactions->links() }}
    </div>
</div>
