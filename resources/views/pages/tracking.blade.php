@section('title')
    Pelacakan Status Servis
@endsection

<x-authentication-layout>
    <h1 class="text-3xl text-slate-800 font-bold mb-6">{{ __('Pelacakan Status Servis') }} ✨</h1>
    
    <!-- Form -->
    <form method="GET" action="{{ route('tracking-data') }}">
        @csrf
        <div class="space-y-6">
            <div>
                <x-jet-label for="nomor_hp" value="{{ __('Nomor HP') }}" />
                <x-jet-input id="nomor_hp" type="number" name="nomor_hp" value="nomor_hp" required autofocus />                
            </div>
            <x-jet-button class="w-full">
                {{ __('Lacak Status Servis') }}
            </x-jet-button>
        </div>
    </form>
</x-authentication-layout>