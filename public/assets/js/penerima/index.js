var table = dataTablesCreated();

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
    // $.ajax({
    //     type: "post",
    //     url: base_url + 'penerimabantuan/filterByRtrW',
    //     data: {
    //         rt: rt,
    //         rw: rw
    //     },
    //     dataType: "json",
    //     success: function (response) {
    //         console.log(response);

    //     }
    // });
    table.destroy();
    if (rt == '' && rw == '') {
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
                    rw: rw
                },
                "url": base_url + "/penerimabantuan/filterByRtrW",
                "type": "POST"
            },
        });
    }

});