<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php $events = $dataProvider->getModels(); ?>

    <div class="row" >
        
        <div class="col-lg-12">
            
            <?= $this->render('paginator',[ 'dataProvider' => $dataProvider ]); ?>
            
        </div>
        
<?php if (count($events)): ?>
        <div class="col-lg-4">
                <?php foreach ($events as $event): ?>
                    <?= $this->render('event', ['event' => $event]); ?>
                <?php endforeach; ?>
        </div>
        <div class="col-lg-8">
            <div id="map"></div>
        </div>
<?php endif; ?>

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
