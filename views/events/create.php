<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = 'Create Event';
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>

<script>
    var myLatLng = {lat: 52.231769, lng: 21.006536};

    function geocode(location)
    {
        var geocoder = new google.maps.Geocoder;
        geocoder.geocode({'location': location}, function (results, status) {
            if (status === 'OK') {
                console.log(results);
                
                var town = document.getElementById('event-town');

                //break down the three dimensional array into simpler arrays
                for (i = 0; i < results.length; ++i)
                {
                    var super_var1 = results[i].address_components;
                    for (j = 0; j < super_var1.length; ++j)
                    {
                        var super_var2 = super_var1[j].types;
                        for (k = 0; k < super_var2.length; ++k)
                        {
                            //find city
                            if (super_var2[k] == "locality")
                            {
                                //put the city name in the form
                                town.value = super_var1[j].long_name;
                            }
                            //find county
                            if (super_var2[k] == "administrative_area_level_2")
                            {
                                //put the county name in the form
                                main_form.county.value = super_var1[j].long_name;
                            }
                            //find State
                            if (super_var2[k] == "administrative_area_level_1")
                            {
                                //put the state abbreviation in the form
                                main_form.state.value = super_var1[j].short_name;
                            }
                        }
                    }
                }


                if (results[0]) {
//                    var address = document.getElementById('event-town');
//                    address.value = results[0].formatted_address;
                }
            }
        });
    }



    function showLocation(location)
    {
        var loc = document.getElementById('event-location');
        loc.value = location.lat + ";" + location.lng;
    }

    showLocation(myLatLng);


    function initMap() {



        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: myLatLng
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: '',
            draggable: true
        });

        google.maps.event.addListener(marker, "dragend", function (event) {
            var lat = event.latLng.lat();
            var lng = event.latLng.lng();

            var loc = document.getElementById('event-location');
            loc.value = lat + ";" + lng;
            geocode(event.latLng);
        });

        geocode(myLatLng)


    }


//    google.maps.event.addDomListener(window, 'load', initMap);
//
//    if (navigator.geolocation) {
//        navigator.geolocation.getCurrentPosition(setMapCenter);
//        
//    }
//
//    function setMapCenter(position) {
//        var center = {lat: position.coords.latitude, lng: position.coords.longitude};
//        console.log("map center:" + position.coords.latitude + ", " + position.coords.longitude);
//        map.panTo(center);
//        marker.setPosition(center);
//        alert( center );
//    }


</script>

