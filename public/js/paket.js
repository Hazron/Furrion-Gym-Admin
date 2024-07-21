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

    fetch(`${url}?id=${id}`)
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
        columns: [
            { data: "nama_paket", name: "nama_paket" },
            { data: "durasi", name: "durasi" },
            { data: "harga", name: "harga" },
            { data: "status", name: "status" },
            { data: "aksi", name: "aksi", orderable: false, searchable: false },
        ],
    });
});
