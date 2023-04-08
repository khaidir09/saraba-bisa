<div>
    <!-- Page header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-3">

        <!-- Left: Title -->
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Perakitan & Pengecekan ✨</h1>
        </div>

        <!-- Right: Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

            <!-- Search form -->
            <x-search-form placeholder="Cari berdasarkan IMEI" />                      
            <!-- Create invoice button -->
            <div x-data="{ modalOpen: false }">
                <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" @click.prevent="modalOpen = true" aria-controls="tambah-modal">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">Tambah Perakitan & Pengecekan</span>
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
                                <div class="font-semibold text-slate-800">Tambah Perakitan & Pengecekan</div>
                                <button class="text-slate-400 hover:text-slate-500" @click="modalOpen = false">
                                    <div class="sr-only">Close</div>
                                    <svg class="w-4 h-4 fill-current">
                                        <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <!-- Modal content -->
                        <form action="{{ route('admin-assembly.store') }}" method="post">
                            @csrf
                            <div class="px-5 py-4">
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="users_id">Nama Teknisi <span class="text-rose-500">*</span></label>
                                        <select id="users_id" name="users_id" class="form-select text-sm py-1 w-full" required>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="item">Barang <span class="text-rose-500">*</span></label>
                                        <input id="item" name="item" class="form-input w-full px-2 py-1" type="text" required />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="imei">IMEI <span class="text-rose-500">*</span></label>
                                        <input id="imei" name="imei" class="form-input w-full px-2 py-1" type="number" required />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="warna">Warna <span class="text-rose-500">*</span></label>
                                        <input id="warna" name="warna" class="form-input w-full px-2 py-1" type="text" required />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="kapasitas">Kapasitas <span class="text-rose-500">*</span></label>
                                        <select id="kapasitas" name="kapasitas" class="form-select text-sm py-1 w-full" required>
                                            @foreach ($capacities as $capacity)
                                                <option value="{{ $capacity->name }}">{{ $capacity->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="biaya">Biaya <span class="text-rose-500">*</span></label>
                                        <div class="relative">
                                            <input id="biaya" name="biaya" class="form-input w-full pl-10 px-2 py-1" type="number" required/>
                                            <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                                <span class="text-sm text-slate-400 font-medium px-3">Rp.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="px-5 py-4 border-t border-slate-200">
                                <div class="flex flex-wrap justify-end space-x-2">
                                    <a href="{{ route('admin-assembly.index') }}" class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600">
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

    <!-- More actions -->
    <div class="sm:flex sm:justify-between sm:items-center mb-5">
        <!-- Left side -->
        <div class="mb-0">
            <select wire:model="paginate" id="" class="form-select">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
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
        <header class="px-5 py-4">
            <h2 class="font-semibold text-slate-800">Semua Perakitan & Pengecekan <span class="text-slate-400 font-medium">{{ $assemblies_count }}</span></h2>
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
                            <div class="font-semibold text-left">Tanggal</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Nama Teknisi</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Barang</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">IMEI</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Warna</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Kapasitas</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Biaya</div>
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
                    @foreach($assemblies as $item)                  
                        <tr>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-medium">{{ $i++ }}</div>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</div>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-medium">{{ $item->user->name }}</div>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-medium">{{ $item->item }}</div>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-medium">{{ $item->imei }}</div>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-medium">{{ $item->warna }}</div>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-medium">{{ $item->kapasitas }}</div>
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <div class="font-medium">Rp. {{ number_format($item->biaya) }}</div>
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
                                    <a href="{{ route('admin-assembly.edit', $item->id) }}">
                                        <button class="text-slate-400 hover:text-slate-500 rounded-full">
                                            <span class="sr-only">Edit</span>
                                            <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                                <path d="M19.7 8.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM12.6 22H10v-2.6l6-6 2.6 2.6-6 6zm7.4-7.4L17.4 12l1.6-1.6 2.6 2.6-1.6 1.6z" />
                                            </svg>
                                        </button>
                                    </a>
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
                                                            <form action="{{ route('admin-assembly.destroy', $item->id) }}" method="post">
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
        {{ $assemblies->links() }}
    </div>
</div>
