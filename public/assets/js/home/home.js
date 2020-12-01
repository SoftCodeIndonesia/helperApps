function initMap() {
    const myLatlng = { lat: -6.9727882, lng: 109.6259318 };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: myLatlng,
    });
    // Create the initial InfoWindow.
    let infoWindow = new google.maps.InfoWindow({
        content: "Click the map to get Lat/Lng!",
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
    });
}
// function initMap() {
//     // The location of Uluru
//     const uluru = { lat: -6.9727882, lng: 109.6259318 };
//     // The map, centered at Uluru
//     const map = new google.maps.Map(document.getElementById("map"), {
//         zoom: 15,
//         center: uluru,
//     });
//     // The marker, positioned at Uluru
//     const marker = new google.maps.Marker({
//         position: uluru,
//         map: map,
//     });
// }
// window.addEventListener('load', function () {
//     if (document.getElementById('map')) {
//         google.load("maps", "3", {
//             callback: function () {
//                 new google.maps.Map(document.getElementById('map'), {
//                     center: new google.maps.LatLng(0, 0),
//                     zoom: 3
//                 });
//             }
//         });
//     }
// }, false);
// var directionsDisplay,
//     directionsService,
//     map;

// function initialize() {
//     var directionsService = new google.maps.DirectionsService();
//     directionsDisplay = new google.maps.DirectionsRenderer();
//     var chicago = new google.maps.LatLng(109.6259318, -6.9727882);
//     var mapOptions = { zoom: 7, mapTypeId: google.maps.MapTypeId.ROADMAP, center: chicago }
//     map = new google.maps.Map(document.getElementById("map"), mapOptions);
//     directionsDisplay.setMap(map);
// }
// initialize();