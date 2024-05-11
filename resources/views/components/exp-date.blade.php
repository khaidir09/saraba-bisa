@props([
    'align' => 'right'
])

<div class="relative inline-flex" x-data="{ open: false }">
    @if (Auth::user()->exp_date != null)
        <div class="text-xs font-medium text-center text-indigo-600">Aktif hingga {{ \Carbon\Carbon::parse(Auth::user()->exp_date)->format('d/m/Y') }}</div>
    @endif
</div>