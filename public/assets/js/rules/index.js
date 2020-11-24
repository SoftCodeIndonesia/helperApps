var table = dataTablesCreated();

function dataTablesCreated() {
    return $('#table-pengurus').DataTable({
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
            "url": base_url + "/rules/getAllRules",
            "type": "POST"
        },
    });
}

$(document).on("click", "#btn-delete", function (e) {
    var id_keluarga = $(this).data('id');
    e.preventDefault();
    swal({
        title: "Apakah anda yakin?",
        text: "Anda akan merubah status pengurus",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                table.destroy();
                $.ajax({
                    type: "POST",
                    url: base_url + "rules/setRulesForIndexPage",
                    data: {
                        id_keluarga: id_keluarga
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