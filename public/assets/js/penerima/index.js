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