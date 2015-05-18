<?php
/**
 * @var $view NodeView
 * @var $filterNode NodeModel
 */
$isCreateScenario = !$filterNode->getId();
?>

<?php echo CHtml::errorSummary($filterNode); ?>

<?= CHtml::form(Yii::app()->createUrl($isCreateScenario ? '/node/create' : '/node/update/' . $filterNode->getId())); ?>

<?php if ($isCreateScenario) : ?>
    <span>Название нового узла</span>
<?php else : ?>
    <span>Обновить название узла</span>
<?php endif; ?>
<?= CHtml::activeTextField($filterNode, 'name'); ?>
<br />
<br />

<span>Вес узла</span>
<?= CHtml::activeTextField($filterNode, 'weight'); ?>

<?php
$this->widget(
    'zii.widgets.grid.CGridView',
    array(
        'dataProvider' => $view->getNodesViaActiveDataProviderByFilter($filterNode),
        'columns' => [
            [
                'name' => 'name',
                'value' => '$data->getName()',
            ],
            [
                'name' => 'weight',
                'type'=>'raw',
                'value' => function($data,$row) {
                    return CHtml::textField(
                        "NodeModel[weight_nodes][" . $data->id . "]",
                        $data->getWeight()
                    );
                }
            ],
            [
                'name' => 'Привязан',
                'type'=>'raw',
                'value' => function($data,$row) use ($filterNode){
                    return CHtml::checkBox(
                        "NodeModel[assign][]",
                        $data->isOneSameRootNode($filterNode),
                        array("value" => $data->id)
                    );
                }
            ]
        ]
    )
);
?>

<?= CHtml::submitButton(
    $isCreateScenario ? 'Создать' : 'Обновить',
    ['name' =>  $isCreateScenario ? 'NodeModel[create]' : 'NodeModel[update]']
); ?>

<?php CHtml::endForm(); ?>