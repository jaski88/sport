<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\widgets\Panel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wydarzenia użytkownika '.$user->username;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= Panel::begin() ;?>
    <?php echo $this->render('_search_user', ['model' => $searchModel,'id' => $user->id]); ?>
    <?= Panel::end() ;?>


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
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>