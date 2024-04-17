@section('title')
    Target Teknisi
@endsection

<x-toko-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <div class="mb-6">
            <a class="btn-sm px-3 bg-white border-slate-200 hover:border-slate-300 text-slate-600" href="{{ route('laporan-teknisi') }}">
                <svg class="fill-current text-slate-400 mr-2" width="7" height="12" viewBox="0 0 7 12">
                    <path d="M5.4.6 6.8 2l-4 4 4 4-1.4 1.4L0 6z" />
                </svg>
                <span>Kembali Ke Laporan Teknisi</span>
            </a>
        </div>

        <livewire:target-teknisi-data></livewire:target-teknisi-data>

    </div>
</x-toko-layout>
