<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>
    <div class="row">
        <div class="col-lg-12">
            <div id="map" ></div>
        </div>
    </div>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'public',
            'time_start',
            'time_end',
            'cyclic',
            'active',
            'description:ntext',
            'location:ntext',
            'event_type',
            'people_min',
            'people_max',
            'town'
        ],
    ])
    ?>

</div>

<script>

    function initMap( )
    {

        var myLatLng = {lat: <?= $model->getLat() ?>, lng: <?= $model->getLng() ?>};

        var geocoder = new google.maps.Geocoder;

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: myLatLng
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: ''
        });
    }

    google.maps.event.addDomListener(window, 'load', initMap);

</script>
