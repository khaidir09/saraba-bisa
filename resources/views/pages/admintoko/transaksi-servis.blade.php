@section('title')
    Transaksi Servis
@endsection

<x-admin-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
     
        <!-- Table -->
        <livewire:admin-proses-data></livewire:admin-proses-data>

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
                $('.selectjs2').select2();
                $('#selectjs3').select2();
                $('.selectjs4').select2();
                $('#selectjs5').select2();
                $('#selectjs6').select2();
            });
        </script>
        <script type="text/javascript">
            $(function(){
                $(document).on('change','#brands_id',function(){
                    var brands_id = $(this).val();
                    $.ajax({
                        url:"{{ route('get-modelserie') }}",
                        type: "GET",
                        data:{brands_id:brands_id},
                        success:function(data){
                            var html = '<option value="">Pilih Model Seri</option>';
                            $.each(data,function(key,v){
                                html += '<option value=" '+v.id+' "> '+v.name+'</option>';
                            });
                            $('#model_series_id').html(html);
                        }
                    })
                });
            });
        </script>
        <script type="text/javascript">
            $(function(){
                $(document).on('change','#merek',function(){
                    var brands_id = $(this).val();
                    $.ajax({
                        url:"{{ route('get-modelserie') }}",
                        type: "GET",
                        data:{brands_id:brands_id},
                        success:function(data){
                            var html = '<option value="">Pilih Model Seri</option>';
                            $.each(data,function(key,v){
                                html += '<option value=" '+v.id+' "> '+v.name+'</option>';
                            });
                            $('#model').html(html);
                        }
                    })
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#selectjs5').on('change', function () {
                    var serviceActionId = $(this).val();
                    if (serviceActionId) {
                        $.ajax({
                            type: 'GET',
                            url: '/get-action/' + serviceActionId,
                            dataType: 'json',
                            success: function (data) {
                                $('#biaya').val(data.biaya);
                                $('#modal_sparepart').val(data.modal_sparepart);
                            }
                        });
                    } else {
                        $('#biaya').val('');
                        $('#modal_sparepart').val('');
                    }
                });
            });
        </script>
    @endpush
</x-admin-layout>
