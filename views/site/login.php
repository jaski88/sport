<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-4 col-sm-offset-4  text-center">


        <div class="panel panel-default">
            <div class="panel-heading">Login or <?= Html::a('Register', ['users/register']) ?></div>
            <div class="panel-body">

                <?php
                $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'layout' => 'horizontal',
                            'fieldConfig' => [
                                'template' => "<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-2 control-label'],
                            ],
                ]);
                ?>

                <?= $form->field($model, 'username')->textInput(['placeholder' => "Username"]) ?>

                <?= $form->field($model, 'password')->passwordInput([ 'placeholder' => "Password"]) ?>


                <?= Html::submitButton('Login', ['class' => 'btn btn-success btn-lg', 'name' => 'login-button', 'style' => 'width:100%']) ?>

                <div class="login-or">
                    <hr class="hr-or">
                    <span class="span-or">or</span>
                </div>

                <a class="btn btn-primary btn-lg" href="/sport/web/users/auth?authclient=facebook" style="background-color: #29487d; width:100%;">Login with facebook</a>


                <?php // yii\authclient\widgets\AuthChoice::widget(['baseAuthUrl' => ['site/auth']]) ?>


                <?php ActiveForm::end(); ?>

            </div> <!-- panel body -->

            <div class="panel-footer text-right"><?= Html::a('Forgot password?', ['users/password-recover']) ?></div>

        </div>
    </div>
</div>




