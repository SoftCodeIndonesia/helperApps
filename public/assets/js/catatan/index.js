var table = dataTablesCreated();


function dataTablesCreated() {
    return $('#table-catatan').DataTable({
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
            "url": base_url + "catatanbantuan/allCatatan",
            "type": "POST"
        },
    });
}

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