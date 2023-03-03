@section('title')
    Perbarui Status Menjadi Sudah Diambil
@endsection

<x-toko-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-5">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Transaksi Servis ✨</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Search form -->
                <x-search-form placeholder="Cari berdasarkan nomor servis" />

                <!-- Create invoice button -->
                <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" @click.prevent="modalOpen = true" aria-controls="tambah-modal">
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
                <div class="bg-white rounded shadow-lg overflow-auto max-w-xl w-full max-h-full">
                    <!-- Modal header -->
                    <div class="px-5 py-3 border-b border-slate-200">
                        <div class="flex justify-between items-center">
                            <div class="font-semibold text-sm text-slate-800">Ubah status untuk nomor servis #{{ $item->nomor_servis }} menjadi <strong>Sudah Diambil</strong></div>
                            <a href="{{ route('transaksi-servis-bisa-diambil.index') }}">
                                <button class="text-slate-400 hover:text-slate-500" @click="modalOpen = false">
                                    <div class="sr-only">Close</div>
                                    <svg class="w-4 h-4 fill-current">
                                        <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                                    </svg>
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- Modal content -->
                    <form action="{{ route('transaksi-servis-bisa-diambil.update', $item->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="status_servis" value="Sudah Diambil"/>
                        <input type="hidden" name="tgl_ambil" value="<?php echo date('Y/m/d') ?>"/>
                        <div class="px-5 py-4">
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="customers_id">Pelanggan</label>
                                    <input id="customers_id" name="customers_id" class="form-input w-full px-2 py-1 disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed" type="text" value="{{ $item->customer->nama }}" disabled />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Nama Barang</label>
                                    <input class="form-input w-full px-2 py-1 disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed" type="text" value="{{ $item->type->name }} {{ $item->brand->name }} {{ $item->modelserie->name }}" disabled />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Warna & Kapasitas Barang</label>
                                    <input class="form-input w-full px-2 py-1 disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed" type="text" value="{{ $item->warna }} - {{ $item->capacity->name }}" disabled />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Kerusakan</label>
                                    <input class="form-input w-full px-2 py-1 disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed" type="text" value="{{ $item->kerusakan }}" disabled />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Kondisi Servis</label>
                                    <input class="form-input w-full px-2 py-1 disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed" type="text" value="{{ $item->kondisi_servis }}" disabled />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Tindakan</label>
                                    <input class="form-input w-full px-2 py-1 disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed" type="text" value="{{ $item->tindakan_servis }}" disabled />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Biaya</label>
                                    <input class="form-input w-full px-2 py-1 disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed" type="text" value="{{ number_format($item->biaya) }}" disabled />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="cara_pembayaran">Cara Pembayaran <span class="text-rose-500">*</span></label>
                                    <select id="cara_pembayaran" name="cara_pembayaran" class="form-select text-sm py-1 w-full">
                                        <option selected value="Tunai">Tunai</option>
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
                                    <label class="block text-sm font-medium mb-1" for="diskon">Diskon</label>
                                    <input id="diskon" name="diskon" class="form-input w-full px-2 py-1" type="text" placeholder="Kosongkan jika tidak ada diskon"/>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1" for="garansi">Garansi <span class="text-rose-500">*</span></label>
                                    <select id="garansi" name="garansi" class="form-select text-sm py-2 w-full" required>
                                        <option value="Tidak Ada">Tidak Ada</option>
                                        <option value="1 Hari">1 Hari</option>
                                        <option value="2 Hari">2 Hari</option>
                                        <option value="3 Hari">3 Hari</option>
                                        <option value="4 Hari">4 Hari</option>
                                        <option value="5 Hari">5 Hari</option>
                                        <option value="6 Hari">6 Hari</option>
                                        <option value="1 Minggu">1 Minggu</option>
                                        <option value="2 Minggu">2 Minggu</option>
                                        <option value="3 Minggu">3 Minggu</option>
                                        <option value="1 Bulan">1 Bulan</option>
                                        <option value="2 Bulan">2 Bulan</option>
                                        <option value="3 Bulan">3 Bulan</option>
                                        <option value="4 Bulan">4 Bulan</option>
                                        <option value="5 Bulan">5 Bulan</option>
                                        <option value="6 Bulan">6 Bulan</option>
                                        <option value="7 Bulan">7 Bulan</option>
                                        <option value="8 Bulan">8 Bulan</option>
                                        <option value="9 Bulan">9 Bulan</option>
                                        <option value="10 Bulan">10 Bulan</option>
                                        <option value="11 Bulan">11 Bulan</option>
                                        <option value="1 Tahun">1 Tahun</option>
                                        <option value="2 Tahun">2 Tahun</option>
                                        <option value="3 Tahun">3 Tahun</option>
                                        <option value="4 Tahun">4 Tahun</option>
                                        <option value="5 Tahun">5 Tahun</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="px-5 py-4 border-t border-slate-200">
                            <div class="flex flex-wrap justify-end space-x-2">
                                <a href="{{ route('transaksi-servis.index') }}" class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600">
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
</x-toko-layout>
