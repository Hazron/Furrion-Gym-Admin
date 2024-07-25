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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <tr>
                                <th>No</th>
                                <th>Nama Member</th>
                                <th>Personal Trainer</th>
                                <th>Paket PT</th>
                                <th>Visit</th>
                                <th>Tanggal Mulai</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($personalTrainers as $index => $trainer)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $trainer->nama }}</td>
                                    <td>{{ $trainer->personal_trainer }}</td>
                                    <td>{{ $trainer->sesi }}</td>
                                    <td>{{ $trainer->visit }}x</td>
                                    <td>{{ \Carbon\Carbon::parse($trainer->tanggal_mulai)->format('d M Y') }}</td>
                                    <td>{{ $trainer->status }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButton">
                                                @if ($trainer->status == 'Aktif')
                                                    <a class="dropdown-item disabled" href="#">Tambah Sesi</a>
                                                @else
                                                    <a class="dropdown-item" href="#">Tambah Sesi</a>
                                                @endif
                                                <a class="dropdown-item" href="#">Hadir</a>

                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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
                        <form action="{{ route('personal_trainers.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_member" class="col-form-label">Nama Member:</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>

                            <div class="form-group">
                                <label for="nama_trainer" class="col-form-label">Nama Trainer:</label>
                                <select class="form-control" id="nama_trainer" name="nama_trainer">
                                    <option value="">--Pilih--</option>
                                    <option value="Emo">Emo</option>
                                    <option value="Heri">Heri</option>
                                    <option value="Edo">Edo</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sesi" class="col-form-label">Sesi:</label>
                                <select class="form-control" id="sesi" name="sesi">
                                    <option value="">--Pilih--</option>
                                    <option value="1">Single Session 10x</option>
                                    <option value="2">Single Session 20x</option>
                                    <option value="3">Single Session 50x</option>
                                    <hr>
                                    <option value="4">Couple Session 10x</option>
                                    <option value="5">Couple Session 20x</option>
                                    <option value="6">Couple Session 50x</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nominal" class="col-form-label">Harga :</label>
                                <input type="text" class="form-control" id="nominal" name="nominal" disabled>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_mulai" class="col-form-label">Tanggal Mulai:</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label for="bukti_pembayaran">Bukti Pembayaran (Opsional)</label>
                                <input type="file" class="form-control" id="bukti_pembayaran"
                                    name="bukti_pembayaran">
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
    document.addEventListener('DOMContentLoaded', function() {
        const sesiSelect = document.getElementById('sesi');
        const nominalInput = document.getElementById('nominal');

        const hargaSesi = {
            '1': 'Rp 1.200.000',
            '2': 'Rp 2.000.000',
            '3': 'Rp 4.000.000',
            '4': 'Rp 2.000.000',
            '5': 'Rp 3.800.000',
            '6': 'Rp 7.000.000'
        };

        const sesi = {
            '1': 'Single Session 10x',
            '2': 'Single Session 20x',
            '3': 'Single Session 50x',
            '4': 'Couple Session 10x',
            '5': 'Couple Session 20x',
            '6': 'Couple Session 50x',
        }

        const maksimal_visit = {
            '1': '10',
            '2': '20',
            '3': '50',
            '4': '10',
            '5': '20',
            '6': '50',
        }

        sesiSelect.addEventListener('change', function() {
            const selectedValue = sesiSelect.value;
            nominalInput.value = hargaSesi[selectedValue] || 'Pilih sesi terlebih dahulu';
        });
    });
</script>

@include('admin.layouts.footer')
