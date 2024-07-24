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
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar list Rak Barang Furrion GYM</h6>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        Tambah
                    </button>
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="barangDataTables">
                        <thead class="thead-light">
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
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Barang -->
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
                        <form action="{{ route('barang.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_barang" class="col-form-label">Nama Barang:</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                    value="{{ old('nama_barang') }}">
                                @error('nama_barang')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="qty" class="col-form-label">Jumlah Barang:</label>
                                <input type="number" class="form-control" id="qty" name="qty"
                                    value="{{ old('qty') }}">
                                @error('qty')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal_mulai" class="col-form-label">Tanggal Masuk:</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                    value="{{ old('tanggal_mulai', date('Y-m-d')) }}">
                                @error('tanggal_mulai')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="harga" class="col-form-label">Harga:</label>
                                <input type="text" name="harga" class="form-control" id="harga"
                                    oninput="formatRupiah(this)" value="{{ old('harga', 0) }}" required>
                                <input type="hidden" name="harga_numeric" id="harga_numeric"
                                    value="{{ old('harga_numeric', 0) }}">
                                @error('harga')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
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

        let numericValue = value.replace(/,/g, ".");
        input.id === "edit_harga" ?
            document.getElementById("edit_harga_numeric").value = numericValue :
            document.getElementById("harga_numeric").value = numericValue;
    }

    $(document).ready(function() {
        $('#barangDataTables').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('barang.data') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'qty',
                    name: 'qty'
                },
                {
                    data: 'harga',
                    name: 'harga'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            order: [
                [1, 'asc']
            ]
        });
    });
</script>
