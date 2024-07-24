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
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
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

        <!-- Modal Tambah -->
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
                                <input type="hidden" name="harga_numeric" id="harga_numeric">
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-form-label">Status:</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
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

        <!-- Modal Edit -->
        <!-- Modal Edit -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Paket Member</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editPaketForm" action="{{ route('paket.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="edit_id" name="id">
                            <div class="form-group">
                                <label for="edit_nama_paket" class="col-form-label">Nama Paket:</label>
                                <input type="text" class="form-control" id="edit_nama_paket" name="nama_paket"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="edit_durasi" class="col-form-label">Durasi:</label>
                                <select class="form-control" id="edit_durasi" name="durasi" required>
                                    <option value="1">1 Bulan</option>
                                    <option value="2">2 Bulan</option>
                                    <option value="3">3 Bulan</option>
                                    <option value="6">6 Bulan</option>
                                    <option value="12">12 Bulan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_harga" class="col-form-label">Harga:</label>
                                <input type="text" name="harga" class="form-control" id="edit_harga"
                                    oninput="formatRupiah(this)" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_status" class="col-form-label">Status:</label>
                                <select class="form-control" id="edit_status" name="status" required>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


    </div>
    <!--Row-->
</div>
</div>

@include('admin.layouts.footer')

<script>
    function formatRupiah(input) {
        let value = input.value.replace(/[^,\d]/g, "");
        let split = value.split(",");
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
        input.value = "Rp " + rupiah;

        document.getElementById("harga_numeric").value = value.replace(",", ".");
    }

    function editPaket(button) {
        let id = $(button).data('id');
        let url = "{{ route('paket.edit') }}";

        fetch(url + '?id=' + id)
            .then(response => response.json())
            .then(data => {
                $('#edit_id').val(data.id_pakets);
                $('#edit_nama_paket').val(data.nama_paket);
                $('#edit_durasi').val(data.durasi);
                $('#edit_harga').val(data.harga);
                $('#edit_status').val(data.status);
                $('#editModal').modal('show');
            })
            .catch(error => console.error('Error:', error));
    }

    function hapusPaket(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus secara permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('paket.destroy', ':id') }}'.replace(':id', id),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Terhapus!',
                                response.message,
                                'success'
                            );
                            $('#dataTableHover').DataTable().ajax.reload();
                        } else {
                            Swal.fire(
                                'Gagal!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan pada server.',
                            'error'
                        );
                    }
                });
            }
        });
    }


    $(document).ready(function() {
        var table = $("#dataTableHover").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('paket.data') }}",
            columns: [{
                    data: "nama_paket",
                    name: "nama_paket"
                },
                {
                    data: "durasi",
                    name: "durasi"
                },
                {
                    data: "harga",
                    name: "harga"
                },
                {
                    data: "status",
                    name: "status"
                },
                {
                    data: "aksi",
                    name: "aksi",
                    orderable: false,
                    searchable: false
                },
            ],
        });
    });
</script>
