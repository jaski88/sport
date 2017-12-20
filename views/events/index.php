<?php

use yii\helpers\Html;
use app\models\EventSearch;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="row" >
        <div class="col-lg-4">


            <?php $events = $dataProvider->getModels(); ?>

            <?php if (count($events)): ?>

                <?php foreach ($events as $event): ?>

                    <div class="panel <?= $event->toClassName(); ?>">
                        <div class="panel-heading"> 
                            <h3 class="panel-title"> #<?= Html::a( $event->id, ['view', 'id' => $event->id]) ?>
                            
                            <?= $event->time_start; ?> <?= $event->duration; ?> <?= $event->eventType->name ?></h3> 
                        </div>
                        <div class="panel-body">
                            <?= $event->town; ?> <?= $event->region->name; ?>
                        </div>
                        <div class="panel-footer">
                            <?= $event->user->username; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="panel panel-default">
                    <div class="panel-heading"> 
                        <h3 class="panel-title"></h3> 
                    </div>
                    <div class="panel-body">
                        No results found.
                    </div>
                </div>

            <?php endif; ?>


        </div>
        <div class="col-lg-8">
            <div id="map"></div>
        </div>

    </div>

    <p>
        <?php Html::a('Create Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>

<script>
    var markers = [
<?php foreach ($events as $event): ?>
    <?= $event->toMarkerJson(); ?>,
<?php endforeach; ?>
    ];
</script>
