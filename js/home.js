/*------map-----*/

function initMap() {
    var posisi = {
        lat: -6.8867959,
        lng: 107.6151704
    }
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: posisi,
        disableDefaultUI: true,
    });
    var marker = new google.maps.Marker({
        position: posisi,
        map: map
    });
}