<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-4 col-lg-offset-4  text-center">

        <div class="panel panel-default">
            <div class="panel-heading">Register or <?= Html::a('Login', ['site/login']) ?></div>
            <div class="panel-body">


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
                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>
                <?= $form->field($model, 'password_confirm')->passwordInput(['placeholder' => 'Confirm password']) ?>
                <?= Html::submitButton('Register', ['class' => 'btn btn-success btn-lg', 'name' => 'register-button', 'style' => 'width:100%']) ?>

                <div class="login-or">
                    <hr class="hr-or">
                    <span class="span-or">or</span>
                </div>

                <a class="btn btn-primary btn-lg" href="/sport/web/site/auth?authclient=facebook" style="background-color: #29487d; width:100%;">Register with facebook</a>


                <?php ActiveForm::end(); ?>

            </div>
            <div class="panel-footer text-right"><?= Html::a('Forgot password?', ['site/password']) ?></div>

        </div>

    </div>
</div>
<!-- row -->

