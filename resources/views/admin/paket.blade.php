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
                        <tbody>
                            <tr>
                                <td>Paket PreSale 1 Bulan</td>
                                <td>1 Bulan</td>
                                <td>Rp 79.000</td>
                                <td>Aktif</td>
                                <td><button>Edit</button></td>
                            </tr>
                        </tbody>
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
                        <form>
                            <div class="form-group">
                                <label for="nama_paket" class="col-form-label">Nama Paket:</label>
                                <input type="text" class="form-control" id="nama_paket">
                            </div>
                            <div class="form-group">
                                <label for="durasi" class="col-form-label">Durasi:</label>
                                <select class="form-control" id="durasi">
                                    <option value="1 Bulan">1 Bulan</option>
                                    <option value="2 Bulan">2 Bulan</option>
                                    <option value="3 Bulan">3 Bulan</option>
                                    <option value="6 Bulan">6 Bulan</option>
                                    <option value="12 Bulan">12 Bulan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga" class="col-form-label">Harga:</label>
                                <input type="text" class="form-control" id="harga">
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-form-label">Status:</label>
                                <select class="form-control" id="status">
                                    <option>Aktif</option>
                                    <option>Tidak Aktif</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->


</div>
<!---Container Fluid-->
</div>
@include('admin.layouts.footer')
