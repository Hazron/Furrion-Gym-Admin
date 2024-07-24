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
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pendapatan (Perbulan)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                {{ number_format($totalAmount, 0, ',', '.') }}</div>
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
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Visitasi Member</div>
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
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Member Aktif</div>
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
        <div class="col-xl-6 col-lg-5">
            <div class="card mb-4 shadow-sm">
                <div class="card-header py-3 bg-primary text-white d-flex align-items-center">
                    <i class="fas fa-qrcode fa-lg mr-2"></i>
                    <h6 class="m-0 font-weight-bold">Nama Member</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="qrcode">Cari Nama Member:</label>
                        <input type="text" class="form-control" id="qrcode" name="qrcode">
                    </div>

                    <button type="button" class="btn btn-primary" onclick="cekMember()">
                        <i class="fas fa-check-circle mr-2"></i> Scan
                    </button>
                </div>
            </div>
        </div>

        <!-- HASIL CEK MEMBER -->
        <div class="col-xl-6 col-lg-5">
            <div class="card mb-4 shadow-sm">
                <div class="card-header py-3 bg-primary text-white d-flex align-items-center justify-content-center">
                    <i class="fas fa-user-check fa-lg mr-2"></i>
                    <h6 class="m-0 font-weight-bold text-center">Selamat Datang</h6>
                </div>
                <div class="form-group text-center">
                    <div id="hasil-cek-container">
                        <div id="hasil-cek" class="card result-card"></div>
                    </div>
                    <div class="loading" id="loading-animation"></div> <!-- Loading animation element -->
                </div>
            </div>
        </div>
    </div>
    <!-- Load Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Invoice Example -->
</div>
<!--Row-->

<script src="{{ asset('js/dashboard.js') }}"></script>

</div>
<!---Container Fluid-->
@include('admin.layouts.footer')
