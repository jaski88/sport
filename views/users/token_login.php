<?php

use yii\helpers\Html;
?>

<?php if (!$success) : ?>

    <div class="alert alert-error">
        Podany token jest nieważny.
    </div>

<?php else: ?>

    <div class="alert alert-success">
        Nowe hasło zostało wysłane na email. 
    </div>

<?php endif; ?>





