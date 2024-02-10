<?php

/** @var yii\web\View $this */
$this->title = 'Junghanns';
 
?>
<div class="site-index">
<?= 
        $this->render('@app/views/todo/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    ?>
</div>
