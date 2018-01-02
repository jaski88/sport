<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Password recovery';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php if (Yii::$app->session->hasFlash('formSubmitted')): ?>

    <div class="alert alert-success">
        Check mail to continue password change.
    </div>

<?php endif; ?>

<div class="row">
    <div class="col-lg-4 col-sm-offset-4  text-center">

        <?php if (!Yii::$app->session->hasFlash('formSubmitted')): ?>

            <div class="panel panel-default">
                <div class="panel-heading"><?= $this->title; ?></div>
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

                    <?= $form->field($model, 'input')->textInput(['placeholder' => "Your username or email"]) ?>
                    <?= Html::submitButton('Recover password', ['class' => 'btn btn-success btn-lg', 'name' => 'login-button', 'style' => 'width:100%']) ?>
                    <?php ActiveForm::end(); ?>

                </div> <!-- panel body -->

                <div class="panel-footer text-right"><?= Html::a('Powrót do logowania', ['site/login']) ?></div>

            </div>

        <?php endif; ?>

    </div>
</div>




