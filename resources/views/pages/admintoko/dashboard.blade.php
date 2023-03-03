@section('title')
    Dashboard Admin Toko
@endsection

<x-admin-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        
        <!-- Welcome banner -->
        <x-dashboard.welcome-banner />
        
        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">

            <!-- Line chart (Acme Plus) -->
            <x-admintoko.dashboard-card-01 :servismasuk="$servismasuk" />

            <!-- Line chart (Acme Advanced) -->
            <x-admintoko.dashboard-card-02 :servisselesai="$servisselesai" />

            <!-- Line chart (Acme Professional) -->
            <x-admintoko.dashboard-card-03 :servisdiambil="$servisdiambil"/>

        </div>

    </div>
</x-admin-layout>
