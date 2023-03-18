@section('title')
    Edit Transaksi Handphone
@endsection

<x-sales-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-5">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Transaksi Handphone ✨</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Search form -->
                <x-search-form placeholder="Cari berdasarkan nomor transaksi" />

                <!-- Create invoice button -->
                <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                            <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                        </svg>
                        <span class="hidden xs:block ml-2">Tambah Transaksi Baru</span>
                </button>                      
                
            </div>

        </div>
        <div x-data="{ modalOpen: true }">
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
                id="edit-modal"
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
                <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full">
                    <!-- Modal header -->
                    <div class="px-5 py-3 border-b border-slate-200">
                        <div class="flex justify-between items-center">
                            <div class="font-semibold text-slate-800">Edit Transaksi Handphone</div>
                            <a href="{{ route('sales-transaksi-handphone.index') }}" class="text-slate-400 hover:text-slate-500">
                                <div class="sr-only">Close</div>
                                <svg class="w-4 h-4 fill-current">
                                    <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <!-- Modal content -->
                    <form action="{{ route('sales-transaksi-handphone.update', $item->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="persen_sales" value="{{ $item->persen_sales }}">
                        <div class="px-5 py-4">
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="created_at">Tgl. Terima</label>
                                    <input id="created_at" name="created_at" class="form-input w-full px-2 py-1" type="date" value="{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}"/>
                                </div>
                                <div>
                                    @if ($item->customer != null)
                                        <label class="block text-sm font-medium mb-1" for="customers_id">Nama Pelanggan</label>
                                        <select id="customers_id" name="customers_id" class="form-select text-sm py-1 w-full">
                                            <option selected value="{{ $item->customer->id }}">{{ $item->customer->nama }}</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <label class="block text-sm font-medium mb-1" for="customers_id">Nama Pelanggan</label>
                                        <select id="customers_id" name="customers_id" class="form-select text-sm py-1 w-full">
                                            <option selected value="">Data pelanggan sudah dihapus</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="phones_id">Nama Handphone</label>
                                    @if ($item->phone != null)
                                        <input disabled id="phones_id" name="phones_id" class="form-input w-full px-2 py-1 disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed" type="text" value="{{ $item->phone->brand->name }} {{ $item->phone->modelserie->name }} {{ $item->phone->keterangan }} | {{ $item->phone->warna }} {{ $item->phone->kapasitas }}"/>
                                    @else
                                        <input disabled id="phones_id" name="phones_id" class="form-input w-full px-2 py-1 disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed" type="text" value="Data handphone sudah dihapus"/>
                                    @endif
                                    <small>Jika terdapat kesalahan pemilihan item handphone, silahkan hapus transaksi dan input kembali</small>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="qc">Pengecekan Fungsi</label>
                                    <input id="qc" name="qc" class="form-input w-full px-2 py-1" type="text" value="{{ $item->qc }}"/>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="modal">Modal</label>
                                    <div class="relative">
                                        <input id="modal" name="modal" class="form-input w-full pl-10 px-2 py-1" type="number" value="{{ $item->modal }}"/>
                                        <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                            <span class="text-sm text-slate-400 font-medium px-3">Rp.</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="harga">Harga Jual</label>
                                    <div class="relative">
                                        <input id="harga" name="harga" class="form-input w-full pl-10 px-2 py-1" type="number" value="{{ $item->harga }}"/>
                                        <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                            <span class="text-sm text-slate-400 font-medium px-3">Rp.</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="diskon">Diskon</label>
                                    <div class="relative">
                                        <input id="diskon" name="diskon" class="form-input w-full pl-10 px-2 py-1" type="number" value="{{ $item->diskon }}"/>
                                        <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                            <span class="text-sm text-slate-400 font-medium px-3">Rp.</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="cara_pembayaran">Cara Pembayaran</label>
                                    <select id="cara_pembayaran" name="cara_pembayaran" class="form-select text-sm py-1 w-full">
                                            <option selected value="{{ $item->cara_pembayaran }}">{{ $item->cara_pembayaran }}</option>
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
                                    <label class="block text-sm font-medium mb-1" for="exp_garansi">Masa Garansi</label>
                                    @if ($item->exp_garansi != null)
                                        <input id="exp_garansi" name="exp_garansi" class="form-input w-full px-2 py-1" type="date" value="{{ \Carbon\Carbon::parse($item->exp_garansi)->format('Y-m-d') }}"/>
                                    @else
                                        <input id="exp_garansi" name="exp_garansi" class="form-input w-full px-2 py-1" type="date" value=""/>
                                    @endif
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="users_id">Penerima/Sales</label>
                                    <input type="text" id="users_id" name="users_id" class="form-input w-full px-2 py-1 disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed" value="{{ Auth::user()->name }}" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="px-5 py-4 border-t border-slate-200">
                            <div class="flex flex-wrap justify-end space-x-2">
                                <a href="{{ route('sales-transaksi-handphone.index') }}" class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600">
                                    Batal
                                </a>
                                <button class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</x-sales-layout>
