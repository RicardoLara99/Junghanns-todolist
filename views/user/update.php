<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Users $model */

$this->title = 'Update information';
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
