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
                    var markers = [
                    <?php foreach ($events as $event): ?>
                            <?= $event->toMarkerJson( ); ?>,
                    <?php endforeach; ?>
                    ];
                </script>


            </div>

        </div>
    </div>
</div>
