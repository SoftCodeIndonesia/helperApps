var table = dataTablesCreated();
var tablePenduduk = dataTablesPenduduk();
$('.input-modal').click(function () {
    var target = $(this).data('modal');
    target = '#' + target;
    $(target).modal('show');
});

$('#btn-simpan').click(function (e) {

    if ($('input[name="bantuan"]').val() == '') {
        $('#alert-jenis-bantuan').append("jenis bantuan harus diisi!");
        e.preventDefault();
    } else if ($('input[name="periode"]').val() == '') {
        $('#alert-periode').append('periode harus diisi!');
        e.preventDefault();
    } else if ($('input[name="no_kk"').val() == '') {
        $('#alert-nokk').append('pilih nomor KK!');
        e.preventDefault();
    } else if ($('input[name="keluarga"').val() == '') {
        $('#alert-keluarga').append('pilih keluarga!');
        e.preventDefault();
    }

});


$('#bukti_terima').change(function () {
    console.log("sdh");
    readURL(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}


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
            "url": base_url + "penerimabantuan/allCatatan",
            "type": "POST"
        },
    });
}
$(document).on('click', '#btn-select', function (e) {
    e.preventDefault();
    var id_bantuan = $(this).data('id');
    var name = $(this).data('name');
    var periode = $(this).data('periode');

    $('input[name="id_bantuan"]').val(id_bantuan);
    $('input[name="bantuan"]').val(name);
    $('input[name="periode"]').val(periode);
});

$(document).on('click', '#btn-select-penduduk', function (e) {
    e.preventDefault();
    var id_keluarga = $(this).data('id');
    var no_kk = $(this).data('kk');
    var nama = $(this).data('nama');

    $('input[name="id_keluarga"]').val(id_keluarga);
    $('input[name="no_kk"]').val(no_kk);
    $('input[name="keluarga"]').val(nama);
})

function dataTablesPenduduk() {
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
            "url": base_url + "/penerimabantuan/getData",
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


