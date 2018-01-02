<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */

$this->title = 'Register with facebook';
$this->params['breadcrumbs'][] = $this->title;

use app\widgets\Panel;
?>

<div class="row">
    <div class="col-lg-4 col-lg-offset-4  text-center">

                <?= Panel::begin(['title' =>  'Register with facebook' ]); ?>

                <?php
                $form = ActiveForm::begin([
                            'id' => 'register-form',
                            'options' => [
                                'class' => 'form-horizontal'
                            ],
                            'fieldConfig' => [
                                'template' => "<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-2 control-label'],
                            ],
                ]);
                ?>

                <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username']) ?>
                <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email']) ?>
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary btn-lg', 'name' => 'register-button', 'style' => 'width:100%']) ?>


                <?php ActiveForm::end(); ?>

            <?= Panel::end(); ?>


    </div>
</div>
<!-- row -->

