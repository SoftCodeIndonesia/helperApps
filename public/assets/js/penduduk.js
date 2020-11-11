var table = $('#table-penduduk').DataTable({
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