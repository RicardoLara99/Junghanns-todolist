<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Users $users */

$this->title = $model->username;
$this->registerCssFile("https://use.fontawesome.com/releases/v5.15.4/css/all.css");
?>
<div class="todos-view">
   
    <h1>Hi <?= Html::encode($this->title) ?>!</h1>
    <p>Would you like update your information?</p>
    <p>
     <?= Html::a('update', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
        GridView::widget([
        'dataProvider' => $todosDataProvider,
        'columns' => [
            'name',
            'description',
            [
                'attribute' => 'isComplete',
                'value' => function ($model) {
                    return $model->isComplete == 1 ? 'Complete' : 'Incomplete';
                },
                'filter' => [1 => 'Complete', 0 => 'Incomplete'],
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete} {toggle-complete}',
                'buttons' => [
                    'toggle-complete' => function ($url, $model, $key) {
                        $icon = $model->isComplete == 0 ? 'fas fa-check' : 'fas fa-times';
                        $title = $model->isComplete == 0 ? 'Mark as complete' : 'Mark as incomplete';
                        $url = Url::to(['todo/toggle-complete', 'id' => $model->id]);
                        return Html::a('<span class="' . $icon . '"></span>', $url, [
                            'title' => Yii::t('app', $title),
                            'data-confirm' => Yii::t('app', 'Are you sure you want to toggle this item?'),
                            'data-method' => 'post',
                        ]);
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::to(['todo/' . $action, 'id' => $model->id]);
                },
                'visibleButtons' => [
                    'view' => function ($model, $key, $index) {
                        return $model->id_user == Yii::$app->user->id;
                    },
                    'update' => function ($model, $key, $index) {
                        return $model->id_user == Yii::$app->user->id;
                    },
                    'delete' => function ($model, $key, $index) {
                        return $model->id_user == Yii::$app->user->id;
                    },
                    'toggle-complete' => function ($model, $key, $index) {
                        return $model->id_user == Yii::$app->user->id;
                    },
                ],
            ],
        ],
        'rowOptions' => function($model, $key, $index, $grid) {
            return ['class' => $model->isComplete == 1 ? 'is-complete' : ''];
        },
        ]);
    ?>
</div>
