@section('title')
    Pengecekan Status Garansi HP
@endsection

<x-authentication-layout>
    <h1 class="text-3xl text-slate-800 font-bold mb-6">{{ __('Pengecekan Status Garansi HP') }} ✨</h1>
    
    <!-- Form -->
    <form method="GET" action="{{ route('garansi-data') }}">
        @csrf
        <div class="space-y-6">
            <div>
                <x-jet-label for="imei" value="{{ __('Nomor IMEI') }}" />
                <x-jet-input id="imei" type="number" name="imei" value="imei" required autofocus />                
            </div>
            <x-jet-button class="w-full">
                {{ __('Cek Status Garansi') }}
            </x-jet-button>
        </div>
    </form>
</x-authentication-layout>