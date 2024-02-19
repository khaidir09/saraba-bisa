<div>
    <!-- Page header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-3">

        <!-- Left: Title -->
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Item Produk ✨</h1>
        </div>

        <!-- Right: Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

            <!-- Search form -->
            <x-search-form placeholder="Masukkan nama produk" />

            <!-- Create invoice button -->
            <div x-data="{ modalOpen: false }">
                <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" @click.prevent="modalOpen = true" aria-controls="tambah-modal">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">Tambah Produk</span>
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
                                <div class="font-semibold text-slate-800">Tambah Produk</div>
                                <button class="text-slate-400 hover:text-slate-500" @click="modalOpen = false">
                                    <div class="sr-only">Close</div>
                                    <svg class="w-4 h-4 fill-current">
                                        <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <!-- Modal content -->
                        <div x-data="{ tab: '1' }" class="px-5 py-4">
                            <!-- Tabs buttons -->
                            <div class="flex flex-wrap items-center -m-3 mb-0">
                                <div class="m-3">
                                    <!-- Start -->
                                    <label class="flex items-center">
                                        <input type="radio" name="radio-buttons" class="form-radio" checked @click="tab = '1'"/>
                                        <span class="text-sm ml-2">Handphone</span>
                                    </label>
                                    <!-- End -->
                                </div>
                                <div class="m-3">
                                    <!-- Start -->
                                    <label class="flex items-center">
                                        <input type="radio" name="radio-buttons" class="form-radio" @click="tab = '2'"/>
                                        <span class="text-sm ml-2">Sparepart</span>
                                    </label>
                                    <!-- End -->
                                </div>
                                <div class="m-3">
                                    <!-- Start -->
                                    <label class="flex items-center">
                                        <input type="radio" name="radio-buttons" class="form-radio" @click="tab = '3'"/>
                                        <span class="text-sm ml-2">Aksesoris</span>
                                    </label>
                                    <!-- End -->
                                </div>
                                <div class="m-3">
                                    <!-- Start -->
                                    <label class="flex items-center">
                                        <input type="radio" name="radio-buttons" class="form-radio" @click="tab = '4'"/>
                                        <span class="text-sm ml-2">Tool</span>
                                    </label>
                                    <!-- End -->
                                </div>
                            </div>
                            <div x-show="tab === '1'">
                                <form action="{{ route('handphone.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="categories_id" value="1">
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="brands_id">Merek <span class="text-rose-500">*</span></label>
                                            <select id="brands_id" name="brands_id" class="form-select text-sm py-1 w-full selectjs1" style="width: 100%" required>
                                                <option selected value="">Pilih Merek</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="model_series_id">Model Seri <span class="text-rose-500">*</span></label>
                                            <select id="model_series_id" name="model_series_id" class="form-select text-sm py-1 w-full selectjs2" style="width: 100%" required>
                                                <option selected value="">Pilih Model Seri</option>
                                                @foreach ($model_series as $model)
                                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="ram">RAM <span class="text-rose-500">*</span></label>
                                            <select id="ram" name="ram" class="form-select text-sm py-1 w-full" required>
                                                <option selected value="">Pilih RAM</option>
                                                <option value="2 GB">2 GB</option>
                                                <option value="3 GB">3 GB</option>
                                                <option value="4 GB">4 GB</option>
                                                <option value="6 GB">6 GB</option>
                                                <option value="8 GB">8 GB</option>
                                                <option value="12 GB">12 GB</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="capacities_id">Memori <span class="text-rose-500">*</span></label>
                                            <select id="capacities_id" name="capacities_id" class="form-select text-sm py-1 w-full" required>
                                                <option selected value="">Pilih Memori</option>
                                                @foreach ($capacities as $capacity)
                                                    <option value="{{ $capacity->id }}">{{ $capacity->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="nomor_seri">IMEI/SN</label>
                                            <input id="nomor_seri" name="nomor_seri" class="form-input w-full px-2 py-1" type="text"/>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="product_code">Kode Produk</label>
                                            <input id="product_code" name="product_code" class="form-input w-full px-2 py-1" type="text" />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="keterangan">Keterangan Produk</label>
                                            <input id="keterangan" name="keterangan" class="form-input w-full px-2 py-1" type="text" />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="stok">Stok <span class="text-rose-500">*</span></label>
                                            <input id="stok" name="stok" class="form-input w-full px-2 py-1" type="number" value="1"/>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="stok_minimal">Stok Minimal <small>(Sebagai pengingat untuk menambah stok produk)</small></label>
                                            <input id="stok_minimal" name="stok_minimal" class="form-input w-full px-2 py-1" type="number" placeholder="Abaikan jika produk tidak memerlukan pengingat"/>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="harga_modal">Harga Modal <span class="text-rose-500">*</span></label>
                                            <div class="relative">
                                                <input id="harga_modal" name="harga_modal" class="form-input w-full pl-10 px-2 py-1" type="number" required/>
                                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                                    <span class="text-sm text-slate-400 font-medium px-3">Rp.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="harga_jual">Harga Jual <span class="text-rose-500">*</span></label>
                                            <div class="relative">
                                                <input id="harga_jual" name="harga_jual" class="form-input w-full pl-10 px-2 py-1" type="number" required/>
                                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                                    <span class="text-sm text-slate-400 font-medium px-3">Rp.</span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($toko->is_tax === 1)
                                            <div>
                                                <label class="block text-sm font-medium mb-1" for="ppn">Apakah produk dikenakan pajak?</label>
                                                <div class="flex flex-wrap items-center -m-3">
                                                    <div class="m-3">
                                                        <!-- Start -->
                                                        <label class="flex items-center">
                                                            <input type="radio" name="ppn" value="" class="form-radio" checked x-on:click="showDetails = true"/>
                                                            <span class="text-sm ml-2">Tidak</span>
                                                        </label>
                                                        <!-- End -->
                                                    </div>
                                                    <div class="m-3">
                                                        <!-- Start -->
                                                        <label class="flex items-center">
                                                            <input type="radio" name="ppn" value="{{ $toko->ppn }}" class="form-radio" x-on:click="showDetails = false"/>
                                                            <span class="text-sm ml-2">Ya</span>
                                                        </label>
                                                        <!-- End -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="garansi">Garansi Produk</label>
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
                                            <label class="block text-sm font-medium mb-1" for="garansi_imei">
                                                Garansi IMEI <small>(Abaikan jika bukan produk iPhone)</small>
                                            </label>
                                            <select id="garansi_imei" name="garansi_imei" class="form-select text-sm py-1 w-full">
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
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="py-4 border-t border-slate-200">
                                        <div class="flex flex-wrap justify-end space-x-2">
                                            <a href="{{ route('item.index') }}" class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600">
                                                Batal
                                            </a>
                                            <button class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div x-show="tab === '2'">
                                <form action="{{ route('sparepart.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="categories_id" value="2">
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="sub_categories_id">Sub Kategori Produk <span class="text-rose-500">*</span></label>
                                            <select id="sub_categories_id" name="sub_categories_id" class="form-select text-sm w-full" required>
                                                <option selected value="">Pilih Sub Kategori</option>
                                                @foreach ($spareparts as $sparepart)
                                                    <option value="{{ $sparepart->id }}">{{ $sparepart->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="product_name">Nama Produk <span class="text-rose-500">*</span></label>
                                            <input id="product_name" name="product_name" class="form-input w-full px-2 py-1" type="text" required/>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="selectjs3">Model Seri <span class="text-rose-500">*</span></label>
                                            <select id="selectjs3" name="model_series_id" class="form-select text-sm py-1 w-full" style="width: 100%" required>
                                                <option selected value="">Pilih Model Seri</option>
                                                @foreach ($model_series as $model)
                                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="product_code">Kode Produk</label>
                                            <input id="product_code" name="product_code" class="form-input w-full px-2 py-1" type="text" />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="keterangan">Keterangan Produk</label>
                                            <input id="keterangan" name="keterangan" class="form-input w-full px-2 py-1" type="text" />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="stok">Stok <span class="text-rose-500">*</span></label>
                                            <input id="stok" name="stok" class="form-input w-full px-2 py-1" type="number" value="1"/>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="stok_minimal">Stok Minimal <small>(Sebagai pengingat untuk menambah stok produk)</small></label>
                                            <input id="stok_minimal" name="stok_minimal" class="form-input w-full px-2 py-1" type="number" placeholder="Abaikan jika produk tidak memerlukan pengingat"/>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="harga_modal">Harga Modal <span class="text-rose-500">*</span></label>
                                            <div class="relative">
                                                <input id="harga_modal" name="harga_modal" class="form-input w-full pl-10 px-2 py-1" type="number" required/>
                                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                                    <span class="text-sm text-slate-400 font-medium px-3">Rp.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="harga_jual">Harga Jual <span class="text-rose-500">*</span></label>
                                            <div class="relative">
                                                <input id="harga_jual" name="harga_jual" class="form-input w-full pl-10 px-2 py-1" type="number" required/>
                                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                                    <span class="text-sm text-slate-400 font-medium px-3">Rp.</span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($toko->is_tax === 1)
                                            <div>
                                                <label class="block text-sm font-medium mb-1" for="ppn">Apakah produk dikenakan pajak?</label>
                                                <div class="flex flex-wrap items-center -m-3">
                                                    <div class="m-3">
                                                        <!-- Start -->
                                                        <label class="flex items-center">
                                                            <input type="radio" name="ppn" value="" class="form-radio" checked x-on:click="showDetails = true"/>
                                                            <span class="text-sm ml-2">Tidak</span>
                                                        </label>
                                                        <!-- End -->
                                                    </div>
                                                    <div class="m-3">
                                                        <!-- Start -->
                                                        <label class="flex items-center">
                                                            <input type="radio" name="ppn" value="{{ $toko->ppn }}" class="form-radio" x-on:click="showDetails = false"/>
                                                            <span class="text-sm ml-2">Ya</span>
                                                        </label>
                                                        <!-- End -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="garansi">Garansi Produk</label>
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
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="py-4 border-t border-slate-200">
                                        <div class="flex flex-wrap justify-end space-x-2">
                                            <a href="{{ route('item.index') }}" class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600">
                                                Batal
                                            </a>
                                            <button class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div x-show="tab === '3'">
                                <form action="{{ route('aksesoris.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="categories_id" value="3">
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="sub_categories_id">Sub Kategori Produk <span class="text-rose-500">*</span></label>
                                            <select id="sub_categories_id" name="sub_categories_id" class="form-select text-sm w-full" required>
                                                <option value="">Pilih Sub Kategori</option>
                                                @foreach ($accessories as $accessory)
                                                    <option value="{{ $accessory->id }}">{{ $accessory->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="product_name">Nama Produk <span class="text-rose-500">*</span></label>
                                            <input id="product_name" name="product_name" class="form-input w-full px-2 py-1" type="text" required/>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="selectjs4">Model Seri <span class="text-rose-500">*</span></label>
                                            <select id="selectjs4" name="model_series_id" class="form-select text-sm py-1 w-full" style="width: 100%" required>
                                                <option selected value="">Pilih Model Seri</option>
                                                @foreach ($model_series as $model)
                                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="product_code">Kode Produk</label>
                                            <input id="product_code" name="product_code" class="form-input w-full px-2 py-1" type="text" />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="keterangan">Keterangan Produk</label>
                                            <input id="keterangan" name="keterangan" class="form-input w-full px-2 py-1" type="text" />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="stok">Stok <span class="text-rose-500">*</span></label>
                                            <input id="stok" name="stok" class="form-input w-full px-2 py-1" type="number" value="1"/>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="stok_minimal">Stok Minimal <small>(Sebagai pengingat untuk menambah stok produk)</small></label>
                                            <input id="stok_minimal" name="stok_minimal" class="form-input w-full px-2 py-1" type="number" placeholder="Abaikan jika produk tidak memerlukan pengingat"/>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="harga_modal">Harga Modal <span class="text-rose-500">*</span></label>
                                            <div class="relative">
                                                <input id="harga_modal" name="harga_modal" class="form-input w-full pl-10 px-2 py-1" type="number" required/>
                                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                                    <span class="text-sm text-slate-400 font-medium px-3">Rp.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="harga_jual">Harga Jual <span class="text-rose-500">*</span></label>
                                            <div class="relative">
                                                <input id="harga_jual" name="harga_jual" class="form-input w-full pl-10 px-2 py-1" type="number" required/>
                                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                                    <span class="text-sm text-slate-400 font-medium px-3">Rp.</span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($toko->is_tax === 1)
                                            <div>
                                                <label class="block text-sm font-medium mb-1" for="ppn">Apakah produk dikenakan pajak?</label>
                                                <div class="flex flex-wrap items-center -m-3">
                                                    <div class="m-3">
                                                        <!-- Start -->
                                                        <label class="flex items-center">
                                                            <input type="radio" name="ppn" value="" class="form-radio" checked x-on:click="showDetails = true"/>
                                                            <span class="text-sm ml-2">Tidak</span>
                                                        </label>
                                                        <!-- End -->
                                                    </div>
                                                    <div class="m-3">
                                                        <!-- Start -->
                                                        <label class="flex items-center">
                                                            <input type="radio" name="ppn" value="{{ $toko->ppn }}" class="form-radio" x-on:click="showDetails = false"/>
                                                            <span class="text-sm ml-2">Ya</span>
                                                        </label>
                                                        <!-- End -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="garansi">Garansi Produk</label>
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
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="py-4 border-t border-slate-200">
                                        <div class="flex flex-wrap justify-end space-x-2">
                                            <a href="{{ route('item.index') }}" class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600">
                                                Batal
                                            </a>
                                            <button class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div x-show="tab === '4'">
                                <form action="{{ route('tool.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="categories_id" value="4">
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="sub_categories_id">Sub Kategori Produk <span class="text-rose-500">*</span></label>
                                            <select id="sub_categories_id" name="sub_categories_id" class="form-select text-sm w-full" required>
                                                <option value="">Pilih Sub Kategori</option>
                                                @foreach ($tools as $tool)
                                                    <option value="{{ $tool->id }}">{{ $tool->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="product_name">Nama Produk <span class="text-rose-500">*</span></label>
                                            <input id="product_name" name="product_name" class="form-input w-full px-2 py-1" type="text" required/>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="product_code">Kode Produk</label>
                                            <input id="product_code" name="product_code" class="form-input w-full px-2 py-1" type="text" />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="keterangan">Keterangan Produk</label>
                                            <input id="keterangan" name="keterangan" class="form-input w-full px-2 py-1" type="text" />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="stok">Stok <span class="text-rose-500">*</span></label>
                                            <input id="stok" name="stok" class="form-input w-full px-2 py-1" type="number" value="1"/>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="stok_minimal">Stok Minimal <small>(Sebagai pengingat untuk menambah stok produk)</small></label>
                                            <input id="stok_minimal" name="stok_minimal" class="form-input w-full px-2 py-1" type="number" placeholder="Abaikan jika produk tidak memerlukan pengingat"/>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="harga_modal">Harga Modal <span class="text-rose-500">*</span></label>
                                            <div class="relative">
                                                <input id="harga_modal" name="harga_modal" class="form-input w-full pl-10 px-2 py-1" type="number" required/>
                                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                                    <span class="text-sm text-slate-400 font-medium px-3">Rp.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="harga_jual">Harga Jual <span class="text-rose-500">*</span></label>
                                            <div class="relative">
                                                <input id="harga_jual" name="harga_jual" class="form-input w-full pl-10 px-2 py-1" type="number" required/>
                                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                                    <span class="text-sm text-slate-400 font-medium px-3">Rp.</span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($toko->is_tax === 1)
                                            <div>
                                                <label class="block text-sm font-medium mb-1" for="ppn">Apakah produk dikenakan pajak?</label>
                                                <div class="flex flex-wrap items-center -m-3">
                                                    <div class="m-3">
                                                        <!-- Start -->
                                                        <label class="flex items-center">
                                                            <input type="radio" name="ppn" value="" class="form-radio" checked x-on:click="showDetails = true"/>
                                                            <span class="text-sm ml-2">Tidak</span>
                                                        </label>
                                                        <!-- End -->
                                                    </div>
                                                    <div class="m-3">
                                                        <!-- Start -->
                                                        <label class="flex items-center">
                                                            <input type="radio" name="ppn" value="{{ $toko->ppn }}" class="form-radio" x-on:click="showDetails = false"/>
                                                            <span class="text-sm ml-2">Ya</span>
                                                        </label>
                                                        <!-- End -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div>
                                            <label class="block text-sm font-medium mb-1" for="garansi">Garansi Produk</label>
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
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="py-4 border-t border-slate-200">
                                        <div class="flex flex-wrap justify-end space-x-2">
                                            <a href="{{ route('item.index') }}" class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600">
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
            </div>
            
        </div>

    </div>

    <!-- More actions -->
    <div class="sm:flex sm:justify-between sm:items-center mb-5">
        <!-- Left side -->
        <div class="mb-4 sm:mb-0">
            <ul class="flex flex-wrap -m-1">
                <li class="m-1">
                    <a href="{{ route('item.index') }}">
                        <button class="inline-flex items-center justify-center text-sm font-medium leading-5 rounded-full px-3 py-1 border border-transparent shadow-sm  bg-indigo-500 text-white duration-150 ease-in-out">Semua</button>
                    </a>
                </li>
                <li class="m-1">
                    <a href="{{ route('handphone.index') }}">
                        <button class="inline-flex items-center justify-center text-sm font-medium leading-5 rounded-full px-3 py-1 border border-slate-200 hover:border-slate-300 shadow-sm bg-white text-slate-500 duration-150 ease-in-out">Handphone</button>
                    </a>
                </li>
                <li class="m-1">
                    <a href="{{ route('sparepart.index') }}">
                        <button class="inline-flex items-center justify-center text-sm font-medium leading-5 rounded-full px-3 py-1 border border-slate-200 hover:border-slate-300 shadow-sm bg-white text-slate-500 duration-150 ease-in-out">Sparepart</button>
                    </a>
                </li>
                <li class="m-1">
                    <a href="{{ route('aksesoris.index') }}">
                        <button class="inline-flex items-center justify-center text-sm font-medium leading-5 rounded-full px-3 py-1 border border-slate-200 hover:border-slate-300 shadow-sm bg-white text-slate-500 duration-150 ease-in-out">Aksesoris</button>
                    </a>
                </li>
                <li class="m-1">
                    <a href="{{ route('tool.index') }}">
                        <button class="inline-flex items-center justify-center text-sm font-medium leading-5 rounded-full px-3 py-1 border border-slate-200 hover:border-slate-300 shadow-sm bg-white text-slate-500 duration-150 ease-in-out">Tool</button>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Right side -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
            <div>
                <select wire:model="paginate" id="" class="form-select">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div x-show="open" x-data="{ open: true }">
            <div class="px-4 py-2 rounded-sm text-sm bg-rose-500 text-white">
                <div class="flex w-full justify-between items-start">
                    <div class="flex">
                        <svg class="w-4 h-4 shrink-0 fill-current opacity-80 mt-[3px] mr-3" viewBox="0 0 16 16">
                            <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm1 12H7V7h2v5zM8 6c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1z" />
                        </svg>
                        @foreach ($errors->all() as $error)
                            <div class="font-medium">{{ $error }}</div>
                        @endforeach
                    </div>
                    <button class="opacity-70 hover:opacity-80 ml-3 mt-[3px]" @click="open = false">
                        <div class="sr-only">Close</div>
                        <svg class="w-4 h-4 fill-current">
                            <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-sm border border-slate-200 mt-5 mb-8">
        <div x-data="handleSelect">
            <div class="sm:flex sm:justify-between sm:items-center px-5 py-4">
                {{-- Left side --}}
                <h2 class="font-semibold text-slate-800">Semua Produk <span class="text-slate-400 font-medium">{{ $products_count }}</span></h2>
                {{-- Right side --}}
                <div class="relative inline-flex">
                    <div class="table-items-action hidden">
                        <div class="flex items-center">
                            <div class="text-sm italic mr-2 whitespace-nowrap"><span class="table-items-count"></span> item yang dipilih</div>
                            <button class="btn bg-white border-slate-200 hover:border-slate-300 text-rose-500 hover:text-rose-600" @click="deleteSelected">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <!-- Table header -->
                    <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
                        <tr>
                            <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                                <div class="flex items-center">
                                    <label class="inline-flex">
                                        <span class="sr-only">Select all</span>
                                        <input id="parent-checkbox" class="form-checkbox" type="checkbox" @click="toggleAll" />
                                    </label>
                                </div>
                            </th>
                            <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-semibold text-left">No.</div>
                            </th>
                            <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-semibold text-left">Nama Produk</div>
                            </th>
                            <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-semibold text-left">Kategori Produk</div>
                            </th>
                            <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-semibold text-left">Kode Produk</div>
                            </th>
                            <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-semibold text-left">Stok</div>
                            </th>
                            <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-semibold text-left">Stok Minimal</div>
                            </th>
                            <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-semibold text-left">Modal</div>
                            </th>
                            <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-semibold text-left">Harga Jual</div>
                            </th>
                            <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-semibold text-left">Garansi Produk</div>
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
                            <tr>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                                    <div class="flex items-center">
                                        <label class="inline-flex">
                                            <span class="sr-only">Select</span>
                                            <input class="table-item form-checkbox" type="checkbox" value="{{ $item->id }}" @click="uncheckParent" />
                                        </label>
                                    </div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-medium">{{ $i++ }}</div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-medium">{{ $item->product_name }} {{ $item->nomor_seri }}</div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-medium">{{ $item->category_name }}</div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-medium">
                                        @if ($item->product_code != null)
                                            {{ $item->product_code }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-medium">{{ $item->stok }}</div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-medium">
                                        @if ($item->stok_minimal != null)
                                            {{ $item->stok_minimal }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-medium">Rp. {{ number_format($item->harga_modal) }}</div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-medium">Rp. {{ number_format($item->harga_jual) }}</div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    @if ($item->garansi != null && $item->garansi_imei != null)
                                        <div class="font-medium">{{ $item->garansi }} hari / {{ $item->garansi_imei }} hari</div>
                                    @elseif ($item->garansi != null)
                                        <div class="font-medium">{{ $item->garansi }} hari / -</div>
                                    @elseif ($item->garansi_imei != null)
                                        <div class="font-medium">- / {{ $item->garansi_imei }} hari</div>
                                    @else
                                        <div class="font-medium">Tidak ada</div>
                                    @endif
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                                    <div class="space-x-1 flex">
                                        @if ($item->categories_id === 1)
                                            <a href="{{ route('handphone.edit', $item->id) }}">
                                                <button class="text-slate-400 hover:text-slate-500 rounded-full">
                                                    <span class="sr-only">Edit</span>
                                                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                                        <path d="M19.7 8.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM12.6 22H10v-2.6l6-6 2.6 2.6-6 6zm7.4-7.4L17.4 12l1.6-1.6 2.6 2.6-1.6 1.6z" />
                                                    </svg>
                                                </button>
                                            </a>
                                        @elseif ($item->categories_id === 2)
                                            <a href="{{ route('sparepart.edit', $item->id) }}">
                                                <button class="text-slate-400 hover:text-slate-500 rounded-full">
                                                    <span class="sr-only">Edit</span>
                                                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                                        <path d="M19.7 8.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM12.6 22H10v-2.6l6-6 2.6 2.6-6 6zm7.4-7.4L17.4 12l1.6-1.6 2.6 2.6-1.6 1.6z" />
                                                    </svg>
                                                </button>
                                            </a>
                                        @elseif ($item->categories_id === 3)
                                            <a href="{{ route('aksesoris.edit', $item->id) }}">
                                                <button class="text-slate-400 hover:text-slate-500 rounded-full">
                                                    <span class="sr-only">Edit</span>
                                                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                                        <path d="M19.7 8.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM12.6 22H10v-2.6l6-6 2.6 2.6-6 6zm7.4-7.4L17.4 12l1.6-1.6 2.6 2.6-1.6 1.6z" />
                                                    </svg>
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ route('tool.edit', $item->id) }}">
                                                <button class="text-slate-400 hover:text-slate-500 rounded-full">
                                                    <span class="sr-only">Edit</span>
                                                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                                        <path d="M19.7 8.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM12.6 22H10v-2.6l6-6 2.6 2.6-6 6zm7.4-7.4L17.4 12l1.6-1.6 2.6 2.6-1.6 1.6z" />
                                                    </svg>
                                                </button>
                                            </a>
                                        @endif
                                        <!-- Start -->
                                        <div x-data="{ modalOpen: false }">
                                            <button class="text-rose-500 hover:text-rose-600 rounded-full" @click.prevent="modalOpen = true" aria-controls="danger-modal">
                                                <span class="sr-only">Delete</span>
                                                <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                                    <path d="M13 15h2v6h-2zM17 15h2v6h-2z" />
                                                    <path d="M20 9c0-.6-.4-1-1-1h-6c-.6 0-1 .4-1 1v2H8v2h1v10c0 .6.4 1 1 1h12c.6 0 1-.4 1-1V13h1v-2h-4V9zm-6 1h4v1h-4v-1zm7 3v9H11v-9h10z" />
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
                                                                <form action="{{ route('item.destroy', $item->id) }}" method="post">
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
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('handleSelect', () => ({
                selectall: false,
                selectAction() {
                    countEl = document.querySelector('.table-items-action');
                    if (!countEl) return;
                    checkboxes = document.querySelectorAll('input.table-item:checked');
                    document.querySelector('.table-items-count').innerHTML = checkboxes.length;
                    if (checkboxes.length > 0) {
                        countEl.classList.remove('hidden');
                    } else {
                        countEl.classList.add('hidden');
                    }
                },
                toggleAll() {
                    this.selectall = !this.selectall;
                    checkboxes = document.querySelectorAll('input.table-item');
                    [...checkboxes].map((el) => {
                        el.checked = this.selectall;
                    });
                    this.selectAction();
                },
                uncheckParent() {
                    this.selectall = false;
                    document.getElementById('parent-checkbox').checked = false;
                    this.selectAction();
                },
                deleteSelected() {
                    const checkboxes = document.querySelectorAll('input.table-item:checked');
                    const selectedIds = [...checkboxes].map((checkbox) => checkbox.value);

                    // Kirim permintaan penghapusan ke server
                    fetch('/products/delete', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ selectedIds }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        // Refresh halaman atau lakukan tindakan lain setelah penghapusan
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Gagal menghapus data:', error);
                    });
                },
            }))
        })    
    </script>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>