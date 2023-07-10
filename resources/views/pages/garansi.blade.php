@section('title')
    Pengecekan Status Garansi
@endsection

<x-authentication-layout>
    <h1 class="text-3xl text-slate-800 font-bold mb-6">{{ __('Pengecekan Status Garansi') }} ✨</h1>
    
    <!-- Form -->
    <form method="GET" action="{{ route('garansi-data') }}">
        @csrf
        <div class="space-y-6">
            <div>
                <x-jet-label for="invoice_no" value="{{ __('Nomor Invoice') }}" />
                <x-jet-input id="invoice_no" type="number" name="invoice_no" value="invoice_no" required autofocus />                
            </div>
            <x-jet-button class="w-full">
                {{ __('Cek Status Garansi') }}
            </x-jet-button>
        </div>
    </form>
</x-authentication-layout>