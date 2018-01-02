<?php

use yii\helpers\Html;

$this->title = 'User address';
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['site/my-account']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create">

    <?=
    $this->render('_location', [
        'model' => $model,
    ])
    ?>

</div>

<script>
    var show_marker = true;
    var marker_info = <?= $model->toMarkerJson() ?>;
</script>