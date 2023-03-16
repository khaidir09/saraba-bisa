<div>
    <form wire:submit.prevent="store">
        @csrf
        <div class="px-5 py-4">
            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium mb-1" for="nama">Nama Pelanggan <span class="text-rose-500">*</span></label>
                    <input wire:model="nama" id="nama" name="nama"
                    class="form-input w-full px-2 py-1 @error('nama') is-invalid @enderror"
                    type="text"/>
                    @error('nama')
                        <div class="text-xs mt-1 text-rose-500">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1" for="kategori">Kategori Pelanggan <span class="text-rose-500">*</span></label>
                    <select id="kategori" name="kategori" wire:model.defer="kategori" class="form-select text-sm py-1 w-full @error('kategori') is-invalid @enderror" required>
                        <option value="null" disabled>{{ __('Pilih kategori') }}</option>
                        <option value="User">User</option>
                        <option value="Toko">Toko</option>
                    </select>
                    @error('kategori')
                        <div class="text-xs mt-1 text-rose-500">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1" for="nomor_hp">HP <span class="text-rose-500">*</span></label>
                    <input wire:model="nomor_hp" id="nomor_hp" name="nomor_hp" class="form-input w-full px-2 py-1 @error('nomor_hp') is-invalid @enderror" type="number" placeholder="Contoh 081900001111" required />
                    <div class="text-xs mt-2 text-slate-600">
                        Pastikan untuk menuliskan sesuai dengan contoh format
                    </div>
                    @error('nomor_hp')
                        <div class="text-xs mt-1 text-rose-500">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1" for="alamat">Alamat <span class="text-rose-500">*</span></label>
                    <textarea wire:model="alamat" id="alamat" name="alamat" class="form-textarea w-full px-2 py-1 @error('alamat') is-invalid @enderror" rows="2" required></textarea>
                    @error('alamat')
                        <div class="text-xs mt-1 text-rose-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <!-- Modal footer -->
        <div class="px-5 py-4 border-t border-slate-200">
            <div class="flex flex-wrap justify-end space-x-2">
                <button class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600" @click="modalOpen = false">Batal</button>
                <button wire:click="store" class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white">Simpan</button>
            </div>
        </div>
    </form>
</div>
