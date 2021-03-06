var table = dataTablesCreated();


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
                $.ajax({
                    type: "POST",
                    url: base_url + "datapenduduk/delete",
                    data: {
                        id_keluarga: id_kaluarga
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




