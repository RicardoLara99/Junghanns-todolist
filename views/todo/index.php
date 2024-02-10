<?php

use app\models\Todos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TodoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'All To-do´s task´s';
$this->registerCssFile("https://use.fontawesome.com/releases/v5.15.4/css/all.css");
?>
<div class="todos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Create new task', ['todo/create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'description:ntext',
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
]); ?>


</div>
