<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Todos $model */

$this->title = 'Update Task: ' . $model->name;
?>
<div class="todos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
