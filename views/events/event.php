<?php
use yii\helpers\Html;
?>

<div class="panel panel-default">
    <div class="panel-heading"> 
        <h3 class="panel-title"> #<?= Html::a($event->id, ['view', 'id' => $event->id]) ?>

            <?= $event->time_start; ?> <?= $event->duration; ?> <?= $event->eventType->name ?></h3> 
    </div>
    <div class="panel-body">
        <?= $event->town; ?> <?= $event->region->name; ?> <a onclick="return showOnMap(<?= $event->id ?>)" href="#">Pokaż</a>
    </div>
    <!--                        <div class="panel-footer">
    <?= $event->user->username; ?>
                            </div>-->
</div>