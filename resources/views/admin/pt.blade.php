@include('admin.layouts.header')

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Member Personal Trainer</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Member Personal Trainer</li>
        </ol>
    </div>

    <div class="row mb-3">
        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar List Member Personal Trainer</h6>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        Tambah
                    </button>
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="trainerDataTables">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Member</th>
                                <th>Sesi</th>
                                <th>Personal Trainer</th>
                                <th>Tanggal Mulai</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Muhammad Hazron Redian</td>
                                <td>10 SESI Tersisa</td>
                                <td>Sana</td>
                                <td>15 Juli 2024</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Tambah Sesi</a>
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Trainer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="nama_member" class="col-form-label">Nama Member:</label>
                                <select class="form-control" id="nama_member">
                                    <option value="">--Pilih--</option>
                                    <option value="1">John Doe</option>
                                    <option value="2">Jane Doe</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_trainer" class="col-form-label">Nama Trainer:</label>
                                <select class="form-control" id="nama_trainer">
                                    <option value="">--Pilih--</option>
                                    <option value="1">John Doe</option>
                                    <option value="2">Jane Doe</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sesi" class="col-form-label">Sesi:</label>
                                <select class="form-control" id="sesi">
                                    <option value="">--Pilih--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_mulai" class="col-form-label">Tanggal Mulai:</label>
                                <input type="date" class="form-control" id="tanggal_mulai">
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
