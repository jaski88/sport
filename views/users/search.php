<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Search';
$this->params['breadcrumbs'][] = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php echo $this->render('_search', ['model' => $searchModel]); ?> 


<?php $users = $dataProvider->getModels(); ?>

<?php if ($searchModel->validate() && count($users) == 0): ?>

    <div class="alert alert-danger">
        Nie znaleziono żadego użytkownika.
    </div>

<?php else: ?>

    <table class="table table-bordered">
        <tr><th>Nazwa użytkownika</th></tr>
        <?php foreach ($users as $user): ?>
            <tr><td><?= Html::a($user->username, ['users/view', 'id' => $user->id]); ?></td></tr>
        <?php endforeach; ?>
    </table>

<?php endif; ?>
