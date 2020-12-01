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

function initMap() {
    const myLatlng = { lat: -6.9727882, lng: 109.6259318 };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: myLatlng,
    });
    // Create the initial InfoWindow.
    let infoWindow = new google.maps.InfoWindow({
        content: "Klik untuk mendapatkan garis latitude dan longitude",
        position: myLatlng,
    });
    infoWindow.open(map);
    // Configure the click listener.
    map.addListener("click", (mapsMouseEvent) => {
        // Close the current InfoWindow.
        infoWindow.close();
        // Create a new InfoWindow.
        infoWindow = new google.maps.InfoWindow({
            position: mapsMouseEvent.latLng,
        });
        infoWindow.setContent(
            JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
        );

        infoWindow.open(map);

        var jsonLatLang = mapsMouseEvent.latLng.toJSON();
        console.log(mapsMouseEvent.latLng.toJSON().lat);
        $('#lat').val(jsonLatLang.lat)
        $('#lng').val(jsonLatLang.lng)

    });
}
