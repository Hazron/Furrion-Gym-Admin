@include('admin.layouts.header')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>

    <div class="row mb-3">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pendapatan
                                (Perbulan)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. 7.000.000</div>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Visitasi Member
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">20</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span>Perhari</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New User Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Member
                                Aktif</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">210</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Form untuk membaca QR Code -->
        <!-- Scanning QR Code Card -->
        <div class="col-xl-6 col-lg-5">
            <div class="card mb-4 shadow-sm">
                <div class="card-header py-3 bg-primary text-white d-flex align-items-center">
                    <i class="fas fa-qrcode fa-lg mr-2"></i>
                    <h6 class="m-0 font-weight-bold">Scanning QR Code</h6>
                </div>
                <div class="card-body">
                    {{-- <form action="{{ route('admin.dashboard.scan') }}" method="POST">
                @csrf --}}
                    <div class="form-group">
                        <label for="qrcode">Scan QR Code:</label>
                        <input type="text" class="form-control" id="qrcode" name="qrcode">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle mr-2"></i> Scan
                    </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Welcome Card -->
        <div class="col-xl-6 col-lg-5">
            <div class="card mb-4 shadow-sm">
                <div class="card-header py-3 bg-primary text-white d-flex align-items-center justify-content-center">
                    <i class="fas fa-user-check fa-lg mr-2"></i>
                    <h6 class="m-0 font-weight-bold text-center">Selamat Datang</h6>
                </div>
                <div class="card-body text-center">
                    <h4>Rafli Andimi</h4>
                    <h4>Paket 2 Bulan</h4>
                    <h4>Visit Jam 17.23</h4>
                </div>
            </div>
        </div>

        <!-- Load Font Awesome for Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <!-- Invoice Example -->

    </div>
    <!--Row-->

    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!---Container Fluid-->
</div>
@include('admin.layouts.footer')
