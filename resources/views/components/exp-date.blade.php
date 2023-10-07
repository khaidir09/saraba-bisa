@props([
    'align' => 'right'
])

<div class="relative inline-flex" x-data="{ open: false }">
    @if (Auth::user()->exp_date != null)
        <div class="hidden xs:block text-xs font-medium rounded-full text-center px-2.5 py-0.5 bg-emerald-100 text-emerald-600">Aktif hingga {{ \Carbon\Carbon::parse(Auth::user()->exp_date)->format('d/m/Y') }}</div>
    @endif
</div>