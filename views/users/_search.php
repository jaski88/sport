<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\Panel;

?>

<?= Panel::begin(['title' => 'Find user']); ?> 

<?php

$form = ActiveForm::begin(['action' => ['search'],
            'method' => 'get',
//            'enableAjaxValidation' => false,
            'options' => ['class' => 'form-inline']
        ]);
?>

<?= $form->field($model, 'username') ?>

<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>

<?= Panel::end(); ?> 
