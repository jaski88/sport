<?php
/* @var $this yii\web\View */
use yii\helpers\Html;


$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p>                
            <?= Html::a('Utwórz wydarzenie', ['events/create'], ['class' => 'btn btn-lg btn-success']) ?>
            
            <?= Html::a('Dołącz', ['events/index'], ['class' => 'btn btn-lg btn-primary']) ?>
        </p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">

                <div id="map"></div>
                <?php $events = app\models\Event::findAll(['active' => app\models\Event::STATUS_ACTIVE]); ?>

                <script>

                    function initMap() {

                        var myLatLng = {lat:  51.95333546345512, lng: 19.521875000000023};

                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 6,
                            center: myLatLng
                        });

                        <?php foreach ($events as $event): ?>
                            var marker = new google.maps.Marker({
                                position: {lat: <?php echo $event->getLat() ?>, lng: <?php echo $event->getLng() ?>},
                                map: map,
                                title: '<?php echo $event->description; ?>'
                            });
                        <?php endforeach; ?>
                        
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(setMapCenter);
                        }
                        
                        function setMapCenter(position) {
                            var center = { lat: position.coords.latitude,  lng: position.coords.longitude};
                            console.log( "map center:"+ position.coords.latitude + ", " + position.coords.longitude );
                            map.panTo( center );
                            map.setZoomLevel( 10 );
                        }
                        
                        
                    }
                    google.maps.event.addDomListener(window, 'load', initMap);

                </script>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARPEUMKytC0BP1VEQjtxGgn7UdIT5CykM&callback=initMap"></script>




            </div>

        </div>
    </div>
</div>
