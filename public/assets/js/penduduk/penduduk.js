var table = dataTablesCreated();

function dataTablesCreated() {
    return $('#table-penduduk').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        "ordering": false,
        "order": [],
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false
        }],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": base_url + "/datapenduduk/getData",
            "type": "POST"
        },
    });
}

$(document).on("click", "#btn-delete", function (e) {
    var id_keluarga = $(this).data('id');
    e.preventDefault();
    swal({
        title: "Apakah anda yakin?",
        text: "data akan dihapus secara permanen",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                table.destroy();
                if (hapus(id_keluarga) > 0) {
                    swal("Data berhasil dihapus!", {
                        icon: "success",
                    });

                    table = dataTablesCreated();
                } else {

                    swal("Data gagal dihapus!", {
                        icon: "warning",
                    });

                    table = dataTablesCreated();

                }
            }
        });
});


function hapus(id_kaluarga) {
    $.ajax({
        type: "POST",
        url: base_url + "datapenduduk/delete",
        data: {
            id_keluarga: id_kaluarga
        },
        dataType: "json",
        success: function (response) {
            return response;
        }
    });
}