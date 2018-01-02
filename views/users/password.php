<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\Panel;

$this->title = 'Change password';
$this->params['breadcrumbs'][] = ['label' => 'My account', 'url' => ['users/my-account']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">

    <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin([]); ?>

        <?= $form->field($model, 'password_old')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'password_confirm')->passwordInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    
</div>

