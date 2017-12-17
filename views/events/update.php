<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = 'Update Event: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<script>

    var myLatLng = {lat: <?= $model->getLat() ?>, lng: <?= $model->getLng() ?>};

    function geocode( location )
    {
        var geocoder = new google.maps.Geocoder;
        geocoder.geocode({'location': location}, function (results, status) {
            if (status === 'OK') {
                
                if (results[0]) {
                    var address = document.getElementById('event-town');
                    address.value = results[0].formatted_address;
                }
            }
        });
    }
    
    
    
    function showLocation( location )
    {
             var loc = document.getElementById('event-location');
            loc.value = location.lat + ";" + location.lng;
    }
    
    //showLocation( myLatLng );


    function initMap() {



        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
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
            geocode( event.latLng );
        });
        
        //geocode( myLatLng )


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