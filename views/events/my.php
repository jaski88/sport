<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\widgets\Panel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My';
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <?= Panel::begin(); ?>
    <?php echo $this->render('_search_user', ['model' => $searchModel, 'id' => $user->id]); ?>
    <?= Panel::end(); ?>


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'day_start',
            'time_start',
            'duration',
            'eventType.name',
            'people_min',
            'people_max',
            'town',
            'region.name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

    <table class="table table-bordered" >
        <?php foreach ($userEvents as $event): ?>
            <tr><td><?= $event->id; ?></td><td><?= $event->day_start . ' ' . $event->time_start; ?></td><td><?= $event->town; ?></td><td><?= $event->eventType->name; ?></td></tr>
        <?php endforeach; ?>
    </table>

</div>