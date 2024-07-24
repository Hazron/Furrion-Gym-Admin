@include('admin.layouts.header')

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Member Furrion Gym</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Paket Member</li>
        </ol>
    </div>
    <div class="row mb-3">
        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar List Member</h6>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                            Tambah
                        </button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableMember">
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
                                    <th>Tanggal Daftar</th>
                                    <th>Nama Member</th>
                                    <th>Paket Member</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th>Nomor Telepon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pesan Flash -->


            <!-- Modal Regis Member-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Member</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="nama" class="col-form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_telpon" class="col-form-label">Nomor Telepon</label>
                                    <input type="number" class="form-control" id="no_telpon" name="no_telpon" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">--Pilih--</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="paket_member" class="col-form-label">Paket Member</label>
                                    <select class="form-control" id="paket_member" name="paket_member" required>
                                        <option value="">--Pilih--</option>
                                        @foreach ($paket as $item)
                                            <option value="{{ $item->id_pakets }}">{{ $item->nama_paket }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bukti_pembayaran" class="col-form-label">Bukti Pembayaran
                                        (Opsional)</label>
                                    <input type="file" class="form-control" id="bukti_pembayaran"
                                        name="bukti_pembayaran">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"
                                onclick="this.disabled=true;this.form.submit();">Simpan</button>
                            <button type="button" class="btn btn-secondary">Close</button>
                        </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Modal Tambah Sesi -->
            <div class="modal fade" id="tambahSesiModal" tabindex="-1" role="dialog"
                aria-labelledby="tambahSesiModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahSesiModalLabel">Tambah Sesi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('member.update-sesi') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_members" id="id_members" value="">
                                <div class="form-group">
                                    <label for="paket_id" class="col-form-label">Pilih Paket Member</label>
                                    <select class="form-control" id="paket_id" name="paket_id" required>
                                        <option value="">--Pilih--</option>
                                        @foreach ($paket as $item)
                                            <option value="{{ $item->id_pakets }}">{{ $item->nama_paket }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bukti_pembayaran">Bukti Pembayaran (Opsional)</label>
                                    <input type="file" class="form-control" id="bukti_pembayaran"
                                        name="bukti_pembayaran">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary"
                                        onclick="this.disabled=true;this.form.submit();">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!---Container Fluid-->
    </div>

    <script>
        function setMemberId(id) {
            $('#id_members').val(id);
        }
    </script>
    @include('admin.layouts.footer')

    <script>
        $(document).ready(function() {
            $('#dataTableMember').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('data.members') }}",
                columns: [{
                        data: 'tanggal_daftar',
                        name: 'tanggal_daftar'
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
                        data: 'tanggal_selesai',
                        name: 'tanggal_selesai'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'nomor_telepon',
                        name: 'nomor_telepon'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });

        $('#tambahSesiModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var memberId = button.data('id');
            var modal = $(this);
            modal.find('.modal-body #id_member').val(memberId);
        });

        $('form').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        location.reload();
                    }
                },
                error: function(xhr) {
                    var errorResponse = JSON.parse(xhr.responseText);
                    alert(errorResponse.message);
                }
            });
        });
    </script>
