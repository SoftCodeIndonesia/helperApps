var pekerjaan = [];

$.ajax({
    type: "GET",
    url: base_url + "pekerjaan/getAutocomplete",
    dataType: "json",
    success: function (response) {
        pekerjaan = response;
        $('#pekerjaan').autocomplete({
            source: pekerjaan
        });
    }
});

