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

$(document).ready(function () {
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

    // Event handler for Edit button
    $("#dataTableHover").on("click", ".btn-warning", function () {
        var id = $(this).data("id");
        $.get("/paket/" + id + "/edit", function (data) {
            $("#edit_id").val(data.id);
            $("#edit_nama_paket").val(data.nama_paket);
            $("#edit_durasi").val(data.durasi);
            $("#edit_harga").val(data.harga);
            $("#edit_status").val(data.status);
            $("#editModal").modal("show");
        });
    });

    // Save changes button click event
    $("#saveChangesBtn").click(function () {
        var formData = $("#editPaketForm").serialize();
        var id = $("#edit_id").val();
        $.ajax({
            url: "/paket/" + id,
            type: "PUT",
            data: formData,
            success: function (response) {
                $("#editModal").modal("hide");
                table.ajax.reload();
                alert("Paket member berhasil diperbarui!");
            },
            error: function (xhr) {
                alert(
                    "Terjadi kesalahan saat memperbarui data: " +
                        xhr.responseText
                );
            },
        });
    });
});
