<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 400px;
            }

        </style>
        <script>
            var route = {controller: '<?= Yii::$app->controller->id ?>',
                action: '<?= Yii::$app->controller->action->id ?>',
                full: '<?= Yii::$app->controller->id ?>/<?= Yii::$app->controller->action->id ?>'};
        </script>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Dołącz', 'url' => ['/events/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    ['label' => 'Search', 'url' => ['/users/search']],
                    Yii::$app->user->isGuest ? ( ['label' => 'Login', 'url' => ['/site/login']] ) // : ([]),
                            : (
                            ['label' => Yii::$app->user->identity->username, 'items' => [
                                    ['label' => 'My account', 'url' => ['/users/my-account']],
                                    ['label' => 'My events', 'url' => ['events/user']],
                                    ['label' => 'Logout', 'url' => ['/site/logout']],
                                ],
                            ] )
                ],
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>

        <script src="/sport/web/scripts.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARPEUMKytC0BP1VEQjtxGgn7UdIT5CykM&callback=initMap"></script>

    </body>
</html>
<?php $this->endPage() ?>
