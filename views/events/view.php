<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\users\User;
use app\widgets\Panel;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

<!--    <h1><?php // Html::encode($this->title)   ?></h1>-->

    <div class="row">
        <div class="col-lg-12">
            <div id="map" ></div>
            <br />
        </div>

    </div>

    <div class="row">
        <div class="col-lg-8">
            <?= Panel::begin(['title' => 'Szczegóły']); ?>
            <p>
                <?= $model->time_start; ?> <?= $model->duration; ?> <?= $model->eventType->name ?>
            </p>
            <p>
                Ilość użytkowników: <?= $model->people_min; ?> - <?= $model->people_max; ?>
            </p>
            <?= Panel::end(); ?>

            <?= Panel::begin(['title' => 'Lokalizacja']); ?>
            <p>
                <?= $model->town; ?> <?= $model->region->name; ?>
            </p> 
            <?= Panel::end(); ?>


            <?= Panel::begin(['title' => 'Opis']); ?>
            <p>
                <?= $model->description; ?>
            </p> 
            <?= Panel::end(); ?>

        </div>

        <div class="col-lg-4">
            
                <div class="panel panel-default" >
                            <div class="panel-heading">Host</div>
                    <div class="list-group">
                        <a href="<?= Url::toRoute(['users/view', 'id' => $model->user->id]); ?>" class="list-group-item"><?= $model->user->username; ?></a>
                    </div>
                </div>

            <div class="panel panel-default" >
                <div class="panel-heading">
                    Users (  <?= $model->getEventUsers()->count(); ?> )
                    <?php if ($model->people_min != 0 || $model->people_max != 0): ?>
                        <?= $model->people_min; ?> - <?= $model->people_max; ?>
                    <?php endif; ?>

                </div> 

                <div class="list-group">
                    <?php if ($model->getEventUsers()->count()): ?>
                        <?php foreach ($model->eventUsers as $event_user): ?>
                            <a href="<?= Url::toRoute(['users/view', 'id' => $event_user->user->id]); ?>" class="list-group-item"><?= $event_user->user->username; ?></a>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="list-group-item">No users yet.</div>
                    <?php endif; ?>
                    <?php if ($model->needMore() != 0): ?>    
                        <div class="list-group-item">Still missing <?= $model->needMore() ?> people</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Actions</div>
                <div class="panel-body">
                    <?php if (!$model->hasMaxUsers() && !User::hasSigned($model->id)) : ?>
                        <?= Html::a('Sign up', ['sign-up', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?php endif; ?>

                    <?php if (User::hasSigned($model->id)): ?>
                        <?= Html::a('Sign out', ['sign-out', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                    <?php endif; ?>

                    <?php if ($model->isOwner()): ?>
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
                        <?= Html::a($model->active == 0 ? 'Deativate' : 'Activate', ['activate', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>



    </div>
</div>



</div>

<script>
    var markers = [<?= $model->toMarkerJson() ?>];
</script>
