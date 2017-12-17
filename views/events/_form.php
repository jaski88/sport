<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$types = ArrayHelper::map(\app\models\EventType::find()->all(), 'id', 'name');

$regions = ArrayHelper::map(\app\models\Region::find()->all(), 'id', 'name');


/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

<?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'time_start')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'duration')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'event_type')->dropDownList($types) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
                <div id="map"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
                <?= $form->field($model, 'location')->textInput() ?>
        </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'town')->textInput() ?>
            </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'region_id')->dropDownList($regions) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'public')->checkbox() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'active')->checkbox() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'people_min')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'people_max')->textInput() ?>
        </div>
    </div>
    <div class="row">
         <div class="col-lg-12">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Zapisz' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        
    </div>
            

<?php ActiveForm::end(); ?>

</div>
