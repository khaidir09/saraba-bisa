@section('title')
    Transaksi Servis Bisa Diambil
@endsection

<x-admin-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
     
        <!-- Table -->
        <livewire:admin-bisa-diambil-data></livewire:admin-bisa-diambil-data>

    </div>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#selectjs1').select2();
                $('#selectjs2').select2();
                $('#selectjs3').select2();
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#selectjs3').on('change', function () {
                    var serviceActionId = $(this).val();
                    if (serviceActionId) {
                        $.ajax({
                            type: 'GET',
                            url: '/get-tindakan/' + serviceActionId,
                            dataType: 'json',
                            success: function (data) {
                                $('#estimasi_biaya').val(data.estimasi_biaya);
                            }
                        });
                    } else {
                        $('#estimasi_biaya').val('');
                    }
                });
            });
        </script>
    @endpush
</x-admin-layout>
