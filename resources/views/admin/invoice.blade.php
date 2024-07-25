@include('admin.layouts.header')

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Invoice Furrion GYM</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Invoice</li>
        </ol>
    </div>

    <div class="row mb-3">
        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Seluruh Invoice</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="invoiceDataTables">
                        <thead class="thead-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Tipe Invoice</th>
                                <th>Nama Member</th>
                                <th>Paket Member</th>
                                <th>Nominal</th>
                                <th>Butki Pembayaran</th>
                                <th>Cetak</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->


</div>
<!---Container Fluid-->
</div>

@include('admin.layouts.footer')
<script>
    $(document).ready(function() {
        $('#invoiceDataTables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('data-invoice') }}",
            type: "GET",
            columns: [{
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'tipe_invoice',
                    name: 'tipe_invoice'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nama_paket',
                    name: 'nama_paket'
                },
                {
                    data: 'nominal',
                    name: 'nominal'
                },
                {
                    data: 'bukti_pembayaran',
                    name: 'bukti_pembayaran'
                },
                {
                    data: 'cetak',
                    name: 'cetak',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
