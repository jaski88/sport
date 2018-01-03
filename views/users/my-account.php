<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\widgets\Panel;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'My account'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="row">
        <div class="col-lg-8">
            <h2>My events</h2>
        </div>

        <div class="col-lg-4">

            <?= Panel::begin(['title' => 'Actions']); ?>

            <?php if( !$model->isFbUser() ) : ?>
            <p>
                <?= Html::a('Change password', ['users/password'], ['class' => 'btn btn-primary']) ?>
            </p>
            <?php endif; ?>

            <p>
                <?= Html::a('Events', ['events/user', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            </p>

            <?= Panel::end(); ?>

            <?php /* Panel::begin(['title' => 'Default address']); ?>
              <div id="map"></div>
              <p>
              <?= Html::a('Change', ['users/location', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
              </p>
              <?= Panel::end( ); */ ?>


        </div>
    </div>




</div>
