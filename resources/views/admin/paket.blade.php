@include('admin.layouts.header')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Paket Member GYM</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Paket Member</li>
        </ol>
    </div>

    <div class="row mb-3">
        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar List Paket Member</h6>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        Tambah
                    </button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama Paket</th>
                                <th>Durasi</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Paket Member</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('paket.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_paket" class="col-form-label">Nama Paket:</label>
                                <input type="text" class="form-control" id="nama_paket" name="nama_paket" required>
                            </div>
                            <div class="form-group">
                                <label for="durasi" class="col-form-label">Durasi:</label>
                                <select class="form-control" id="durasi" name="durasi" required>
                                    <option value="1">1 Bulan</option>
                                    <option value="2">2 Bulan</option>
                                    <option value="3">3 Bulan</option>
                                    <option value="6">6 Bulan</option>
                                    <option value="12">12 Bulan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga" class="col-form-label">Harga:</label>
                                <input type="text" name="harga" class="form-control" id="harga"
                                    oninput="formatRupiah(this)" required>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-form-label">Status:</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option>Aktif</option>
                                    <option>Tidak Aktif</option>
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!--Row-->


</div>
<!---Container Fluid-->
</div>
<script>
    function formatRupiah(input) {
        let value = input.value.replace(/[^,\d]/g, '');
        let split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        input.value = 'Rp ' + rupiah;
    }
</script>


@include('admin.layouts.footer')
