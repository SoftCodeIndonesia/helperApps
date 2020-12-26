var table = dataTablesCreated();
var flash = $('input[name="flash"]').val();
if (flash) {
    swal("Success!", "Data " + flash + "!", "success");
    $.ajax({
        type: "POST",
        url: base_url + "ConfigSet/destroy_session",
        data: {
            session: "flash"
        },
        dataType: "json",

    });
}

// $('#btn-print').click(function (e) {
//     e.preventDefault();
//     var id_bantuan = $('#id_bantuan').val();
//     var rt = $("#rt").val();
//     var rw = $("#rw").val();

//     $.ajax({
//         type: "POST",
//         url: base_url + "/penerimabantuan/getAllData",
//         data: {
//             rt: rt,
//             rw: rw,
//             id_bantuan: id_bantuan
//         },
//         url: base_url + "penerimabantuan/filterData",
//         dataType: "json",
//         success: function (response) {
//             console.log(response);
//         }
//     });
//     // window.print();

// });


function dataTablesCreated() {
    return $('#table-penerima').DataTable({
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
            "url": base_url + "/penerimabantuan/getAllData",
            "type": "POST"
        },
    });
}


$(document).on('change', '#rt,#rw', function (e) {
    var rt = $('#rt').val();
    var rw = $('#rw').val();
    var id_bantuan = $('#id_bantuan').val();

    onFilter(rt, rw, id_bantuan);
});

$(document).on("click", "#btn-delete", function (e) {
    var id_penerima = $(this).data('id');
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
                    url: base_url + "penerimabantuan/delete",
                    data: {
                        id_penerima: id_penerima
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response > 0) {
                            swal("Data berhasil dihapus!", {
                                icon: "success",
                            });

                            $('#table-penerima').DataTable({
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
                                    "url": base_url + "/penerimabantuan/getAllData",
                                    "type": "POST"
                                },
                            });
                        } else {

                            swal("Data gagal dihapus!", {
                                icon: "warning",
                            });

                            $('#table-penerima').DataTable({
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
                                    "url": base_url + "/penerimabantuan/getAllData",
                                    "type": "POST"
                                },
                            });

                        }
                    }
                });

            }
        });
});

$('#jenis_bantuan,#periode').focus(function (e) {
    $('#bantuan').modal('show');
    e.preventDefault();

});

$('#table-catatan').DataTable({
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
        "url": base_url + "penerimabantuan/allCatatan",
        "type": "POST"
    },
});

$(document).on('click', '#btn-select', function (e) {
    e.preventDefault();
    var id_bantuan = $(this).data('id');
    var name = $(this).data('name');
    var periode = $(this).data('periode');

    $('input[name="id_bantuan"]').val(id_bantuan);
    $('input[name="bantuan"]').val(name);
    $('input[name="periode"]').val(periode);
    var rt = $('#rt').val();
    var rw = $('#rw').val();
    onFilter(rt, rw, id_bantuan);
});

function onFilter(rt = null, rw = null, id_bantuan = null) {
    table.destroy();
    // if (rt == '' && rw == '') {
    //     $('#table-penerima').DataTable({
    //         orderCellsTop: true,
    //         fixedHeader: true,
    //         "ordering": false,
    //         "order": [],
    //         "columnDefs": [{
    //             "targets": 'no-sort',
    //             "orderable": false
    //         }],
    //         "processing": true,
    //         "serverSide": true,
    //         "ajax": {
    //             "url": base_url + "/penerimabantuan/getAllData",
    //             "type": "POST"
    //         },
    //     });

    // } else {
    table = $('#table-penerima').DataTable({
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
            data: {
                rt: rt,
                rw: rw,
                id_bantuan: id_bantuan
            },
            "url": base_url + "penerimabantuan/filterData",
            "type": "POST"
        },
    });
    // }

}