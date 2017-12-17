<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$types = ArrayHelper::map(\app\models\EventType::find()->all(), 'id', 'name');

$regions = ArrayHelper::map(\app\models\Region::find()->all(), 'id', 'name');

/* @var $this yii\web\View */
/* @var $model app\models\EventSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'town')->textInput() ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'region_id')->dropDownList($regions) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'event_type')->checkboxList($types) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
