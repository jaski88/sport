<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$regions = ArrayHelper::map(\app\models\Region::find()->all(), 'id', 'name');

?>



<?php $form = ActiveForm::begin(); ?>


<div class="row">
    <div class="col-lg-12">
        <div id="map"></div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <?= $form->field($model, 'coords')->textInput() ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model, 'address')->textInput() ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model, 'region_id')->dropDownList($regions) ?>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    
    <?= Html::a('Back', [ 'site/my-account', 'id' => $model->id],['class' => 'btn btn-primary']) ?>


</div>

<?php ActiveForm::end(); ?>