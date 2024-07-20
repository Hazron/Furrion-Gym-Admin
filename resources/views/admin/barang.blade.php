@include('admin.layouts.header')

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rak Barang Furrion GYM</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Rak Barang</li>
        </ol>
    </div>

    <div class="row mb-3">
        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar list Rak Barang Furrion GYM</h6>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        Tambah
                    </button>
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="trainerDataTables">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>ID Barang</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>BRG001</td>
                                <td>Suplemen Protein Whey</td>
                                <td>100</td>
                                <td>Rp 150.000</td>
                                <td><button>Edit</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>BRG002</td>
                                <td>Suplemen Vitamin D</td>
                                <td>50</td>
                                <td>Rp 80.000</td>
                                <td><button>Edit</button></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>BRG003</td>
                                <td>Suplemen Omega 3</td>
                                <td>200</td>
                                <td>Rp 200.000</td>
                                <td><button>Edit</button></td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Trainer -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="nama_barng" class="col-form-label">Nama Barang:</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_barang" class="col-form-label">Jumlah Barang:</label>
                                <input type="text" class="form-control" id="jumlah_barang" name="jumlah_barang">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_mulai" class="col-form-label">Tanggal Masuk:</label>
                                <input type="date" class="form-control" id="tanggal_mulai"
                                    value="{{ date('Y-m-d') }}">
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
