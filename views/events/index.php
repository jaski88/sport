<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ListView;
use yii\widgets\Pjax;
use app\models\EventSearch;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
     <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    

    <p>
        <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
     <?php Pjax::begin(); ?>  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'user.username',
//            'public',
            'time_start',
            'duration',
            'town',
            'eventType.name',
            'region.name',

            // 'cyclic',
            // 'active',
            // 'description:ntext',
//             'location:ntext',
            // 'event_type',
            // 'people_min',
            // 'people_max',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> 
    <?php Pjax::end(); ?>
</div>
