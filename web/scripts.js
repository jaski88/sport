//function initMap() {
//
//    var myLatLng = {lat: 53.379, lng: 14.600};
//
//    var geocoder = new google.maps.Geocoder;
//
//    var map = new google.maps.Map(document.getElementById('map'), {
//        zoom: 6,
//        center: myLatLng
//    });
//
//    var marker = new google.maps.Marker({
//        position: myLatLng,
//        map: map,
//        title: '',
//        draggable: true
//    });
//
//    google.maps.event.addListener(marker, "dragend", function (event) {
//        var lat = event.latLng.lat();
//        var lng = event.latLng.lng();
//
//        var loc = document.getElementById('event-location');
//        loc.value = lat + ";" + lng;
//
//
//        geocoder.geocode({'location': event.latLng}, function (results, status) {
//            if (status === 'OK') {
//                if (results[0]) {
//                    var address = document.getElementById('event-town');
//                    address.value = results[0].formatted_address;
//                }
//            }
//        });
//    });
//
//}
//
//
//google.maps.event.addDomListener(window, 'load', initMap);
//
//if (navigator.geolocation) {
//    navigator.geolocation.getCurrentPosition(setMapCenter);
//}
//
//function setMapCenter(position) {
//    var center = {lat: position.coords.latitude, lng: position.coords.longitude};
//    console.log("map center:" + position.coords.latitude + ", " + position.coords.longitude);
//    map.panTo(center);
//    marker.setPosition( center );
//}