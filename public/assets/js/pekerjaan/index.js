var table = dataTablesCreated();

function dataTablesCreated() {
    return $('#table-pekerjaan').DataTable({
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
            "url": base_url + "/pekerjaan/allDataPekerjaan",
            "type": "POST"
        },
    });
}

var flash = $('input[name="flash"]').val();
if (flash) {
    swal("Success!", "Data berhasil " + flash + "!", "success");
    $.ajax({
        type: "POST",
        url: base_url + "ConfigSet/destroy_session",
        data: {
            session: "flash"
        },
        dataType: "json",

    });
}


$(document).on("click", "#btn-delete", function (e) {
    var id_pekerjaan = $(this).data('id');
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
                $.ajax({
                    type: "POST",
                    url: base_url + "pekerjaan/delete",
                    data: {
                        id_pekerjaan: id_pekerjaan
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response > 0) {
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

            }
        });
});
