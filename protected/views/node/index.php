<?php
/**
 * @var $view NodeView
 */
?>

<?php
$this->widget(
    'zii.widgets.grid.CGridView',
    array(
        'dataProvider' => $view->getNodesViaActiveDataProvider(),
        'columns' => [
            [
                'name' => 'name',
                'value' => '$data->getName()',
            ],
            [
                'class' => 'CButtonColumn',
                'template' => '{update},{delete}',
            ]
        ]
    )
);
?>

<div style="width: 30%;">
    <span style="float: left;">
        <a href="<?= Yii::app()->createUrl('/node/create'); ?>">Добавить узел</a>
    </span>
    <span style="float: right;">
        <a href="<?= Yii::app()->createUrl('/node/net'); ?>">Построить таблицу сети</a>
    </span>
</div>