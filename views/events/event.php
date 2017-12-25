<?php

use yii\helpers\Html;
?>

<a onClick="return showOnMap(<?= $event->id ?>)" href="<?php // Html::a($event->id, ['view', 'id' => $event->id]) ?>" class="list-group-item">
    <h4 class="list-group-item-heading"><?= $event->time_start; ?> <?= $event->duration; ?> <?= $event->eventType->name ?></h4>
    <p class="list-group-item-text"><?= $event->town; ?> <?= $event->region->name; ?> <br />
    <i class="glyphicon glyphicon-user" > </i> <?= $event->getEventUsers()->count( ); ?> 
    <?php if ( $event->people_min != 0 || $event->people_max != 0 ): ?>
        (<?= $event->people_min; ?> - <?= $event->people_max; ?>) 
    <?php endif; ?>
        <?php if( $event->freeSlots( ) != 0): ?>Pozostało <?= $event->freeSlots( ); ?> wolnych miejsc <?php endif; ?>
    </p>
</a>
