<div class="grow">
    <!-- Panel body -->
    <form action="{{ route('informasi-toko-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="p-6 space-y-6">
            <!-- Picture -->
            <section>
                <h3 class="text-xl leading-snug text-slate-800 font-bold mb-2">Logo Toko</h3>
                <div class="flex items-center">
                    <div class="mr-4">
                        @if (Auth::user()->profile_photo_path != null)
                            <img class="w-20 h-20 rounded-full" src="{{ Storage::url(Auth::user()->profile_photo_path) }}" width="80" height="80" alt="Logo Toko" />
                        @else
                            <img class="w-20 h-20 rounded-full" src="{{ Auth::user()->profile_photo_url }}" width="80" height="80" alt="{{ Auth::user()->name }}" />
                        @endif
                    </div>
                    <input type="file" name="profile_photo_path" id="profile_photo_path" class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white">
                </div>
            </section>

            <!-- Business Profile -->
            <section>
                <h3 class="text-xl leading-snug text-slate-800 font-bold mb-1">Profil Toko</h3>
                <div class="text-sm">Informasi ini akan terlihat pada halaman web dan nota transaksi.</div>
                <div class="sm:flex sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 mt-5">
                    <div class="sm:w-1/2">
                        <label class="block text-sm font-medium mb-1" for="owner">Pemilik Toko/Usaha</label>
                        <input name="owner" id="owner" class="form-input w-full" type="text" value="{{ Auth::user()->owner }}" />
                    </div>
                    <div class="sm:w-1/2">
                        <label class="block text-sm font-medium mb-1" for="nama_toko">Nama Toko/Usaha</label>
                        <input name="nama_toko" id="nama_toko" class="form-input w-full" type="text" value="{{ Auth::user()->nama_toko }}" />
                    </div>
                    <div class="sm:w-1/2">
                        <label class="block text-sm font-medium mb-1" for="nomor_hp_toko">Nomor HP/WA Toko</label>
                        <input name="nomor_hp_toko" id="nomor_hp_toko" class="form-input w-full" type="number" placeholder="6200000000000" value="{{ Auth::user()->nomor_hp_toko }}" />
                    </div>
                    <div class="sm:w-1/2">
                        <label class="block text-sm font-medium mb-1" for="kota">Kota/Kabupaten</label>
                        <input name="kota" id="kota" class="form-input w-full" type="text" value="{{ Auth::user()->kota }}" />
                    </div>
                </div>
                <div class="sm:flex sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 mt-5">
                    <div class="sm:w-1/2">
                        <label class="block text-sm font-medium mb-1" for="bank">Nama BANK</label>
                        <input name="bank" id="bank" class="form-input w-full" type="text" value="{{ Auth::user()->bank }}" />
                    </div>
                    <div class="sm:w-1/2">
                        <label class="block text-sm font-medium mb-1" for="rekening">Nomor Rekening</label>
                        <input name="rekening" id="rekening" class="form-input w-full" type="number" value="{{ Auth::user()->rekening }}" />
                    </div>
                    <div class="sm:w-1/2">
                        <label class="block text-sm font-medium mb-1" for="pemilik_rekening">Nama Pemilik Rekening</label>
                        <input name="pemilik_rekening" id="pemilik_rekening" class="form-input w-full" type="text" value="{{ Auth::user()->pemilik_rekening }}" />
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1" for="deskripsi_toko">Deskripsi Toko/Usaha</label>
                    <textarea name="deskripsi_toko" id="deskripsi_toko" rows="2" class="w-full">
                        {{ Auth::user()->deskripsi_toko }}
                    </textarea>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1" for="deskripsi_toko">Alamat Toko</label>
                    <textarea name="alamat_toko" id="alamat_toko" rows="2" class="w-full">
                        {{ Auth::user()->alamat_toko }}
                    </textarea>
                </div>
            </section>
            <!-- Smart Sync -->
            <section>
                <h3 class="text-xl leading-snug text-slate-800 font-bold mb-1">Smart Sync update for Mac</h3>
                <div class="flex items-center mt-5" x-data="{ checked: true }">
                    <div class="form-switch">
                        <input type="checkbox" id="toggle" class="sr-only" x-model="checked" />
                        <label class="bg-slate-400" for="toggle">
                            <span class="bg-white shadow-sm" aria-hidden="true"></span>
                            <span class="sr-only">Enable smart sync</span>
                        </label>
                    </div>
                    <div class="text-sm text-slate-400 italic ml-2" x-text="checked ? 'On' : 'Off'"></div>
                </div>
            </section>
        </div>

        <!-- Panel footer -->
        <footer>
            <div class="flex flex-col px-6 py-5 border-t border-slate-200">
                <div class="flex self-end">
                    <button class="btn border-slate-200 hover:border-slate-300 text-slate-600">Batal</button>
                    <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white ml-3">Simpan Perubahan</button>
                </div>
            </div>
        </footer>
    </form>
</div>