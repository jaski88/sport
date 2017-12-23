function mapRegion(name)
{
    switch (name)
    {
        case "Województwo dolnośląskie":
            return 1;
        case "kujawsko-pomorskie":
            return 2;
        case "lubelskie":
            return 3;
        case "lubuskie":
            return 4;
        case "mazowieckie":
            return 5;
        case "małopolskie":
            return 6;
        case "opolskie":
            return 7;
        case "Województwo podkarpackie":
            return 8;
        case "podlaskie":
            return 9;
        case "pomorskie":
            return 10;
        case "śląskie":
            return 11;
        case "świętokrzyskie":
            return 12;
        case "warmińsko-mazurskie":
            return 13;
        case "wielkopolskie":
            return 14;
        case "Województwo zachodniopomorskie":
            return 15;
        case "województwo łódzkie":
            return 16;
        default:
            return 0;
    }

    return 0;
}

function geocode(location)
{
    var geocoder = new google.maps.Geocoder;
    geocoder.geocode({'location': location}, function (results, status) {
        if (status === 'OK') {
            
            if (results[0]) {
                var town = document.getElementById('event-town');
                town.value = results[0].formatted_address;
            }
            
            //break down the three dimensional array into simpler arrays
            for (i = 0; i < results.length; ++i)
            {
                var super_var1 = results[i].address_components;
                for (j = 0; j < super_var1.length; ++j)
                {
                    var super_var2 = super_var1[j].types;
                    for (k = 0; k < super_var2.length; ++k)
                    {
                        //find State
                        if (super_var2[k] == "administrative_area_level_1")
                        {
                            //put the state abbreviation in the form
                            var region = document.getElementById('event-region_id');
                            var region_id = mapRegion(super_var1[j].short_name);
                            if (region_id != 0)
                            {
                                region.selectedIndex = region_id - 1;

                            }
                            console.log(super_var1[j].short_name);
                        }
                    }
                }
            }

        }
    });
}

var map;
var mapCenter = {lat: 51.95333546345512, lng: 19.521875000000023};

var _markers = [];
var _info = [];

function addMarker(data) {

    var marker = new google.maps.Marker({
        position: data.coords,
        label: data.title,
        map: map
    });
    
    _markers[data.id] = marker;
    

    var infowindow = new google.maps.InfoWindow({
        content: data.content
    });
    
    _info[data.id] = infowindow;



    marker.addListener('click', function () {
        map.panTo(marker.getPosition());
        map.setZoom(12);
        infowindow.open(map, marker);
    });
    
    google.maps.event.addListener(marker, "dblclick", function (e) { 
               console.log("Double Click"); 
               console.log(e); 
            });

}

function showLocation(location)
{
    var loc = document.getElementById('event-location');
    loc.value = location.lat + ";" + location.lng;
}

function events_create( )
{
    console.log(marker_info);
    console.log(map);
    var marker = new google.maps.Marker({
        position: marker_info.coords,
        map: map,
        title: marker_info.title,
        draggable: true
    });

    google.maps.event.addListener(marker, "dragend", function (event) {
        var lat = event.latLng.lat();
        var lng = event.latLng.lng();

        var loc = document.getElementById('event-location');
        loc.value = lat + ";" + lng;
        geocode(event.latLng);
    });
}

function showOnMap( id )
{

    for( var iw in _info )
    {
        _info[ iw ].close( );
    }
    
    var marker = _markers[id];
    
    map.setCenter( marker.getPosition( ));
    map.setZoom( 12 );
    _info[ id ].open(map, marker);
    
    return false;
}

function initMap() {

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 6,
        center: mapCenter
    });

    if (typeof (markers) !== 'undefined')
    {
        markers.forEach(function (marker) {
            addMarker(marker)
        });
    }

    if (route.full == 'events/create' || route.full == 'events/update')
    {
        events_create( );
    }



}














