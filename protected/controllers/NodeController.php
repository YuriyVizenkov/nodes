<?php
Yii::import('application.models.views.*');

/**
 * Class NodeController
 */
class NodeController extends FrontController
{
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('index', 'create', 'update', 'net'),
                'users' => array('*'),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        try {

            $nodesCollection = new NodeCollection();
            $nodesCollection->setNodes(NodeModel::model()->findAll());

            $this->render('index', ['view' => $this->getViewModel()->setNodesCollection($nodesCollection)]);
        }
        catch (Exception $e) {
            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
            if (YII_DEBUG) {
                throw $e;
            }
        }
    }

    public function actionCreate()
    {
        $nodeModel = new NodeModel('create');
        $data = Yii::app()->request->getPost('NodeModel');

        try {

            if (isset($data['create'])) {
                $this->saveNodeModel($nodeModel, $data);
            }

            $this->renderManagePage($nodeModel);
        }
        catch (Exception $e) {
            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
            if (YII_DEBUG) {
                throw $e;
            }
        }
    }

    /**
     * @param int|null $id
     * @throws Exception
     */
    public function actionUpdate($id)
    {
        try {
            $nodeModel = NodeModel::model()->findByPk($id);
            if (!$nodeModel === null) {
                throw new ErrorException('Node model for ID `' . $id . '` not found');
            }

            $data = Yii::app()->request->getPost('NodeModel');

            $this->saveNodeModel($nodeModel, $data);

            $this->renderManagePage($nodeModel);
        }
        catch (Exception $e) {
            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
            if (YII_DEBUG) {
                throw $e;
            }
        }
    }

    public function actionNet()
    {
        try {

        }
        catch (Exception $e) {
            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
            if (YII_DEBUG) {
                throw $e;
            }
        }
    }

    /**
     * @return NodeView
     */
    private function getViewModel()
    {
        return new NodeView();
    }

    /**
     * @param INode $nodeModel
     */
    private function renderManagePage(INode $nodeModel)
    {
        $nodesCollection = new NodeCollection();
        $nodesCollection->setNodes(NodeModel::model()->findAll());

        $this->render(
            'manage_node',
            [
                'view' => $this->getViewModel()->setNodesCollection($nodesCollection),
                'filterNode' => $nodeModel
            ]
        );
    }

    /**
     * @param INode|CActiveRecord $nodeModel
     * @param $data
     * @throws ErrorException
     */
    private function saveNodeModel(INode $nodeModel, $data)
    {
        $nodeModel->attributes = $data;
        if ($nodeModel->validate()) {
            if ($nodeModel->save()) {
                if (!isset($data['assign']) && !is_array($data['assign'])) {
                    throw new ErrorException ('Assign array must by defined');
                }
                $nodeModel->saveNodeWithRelations($data['assign']);
            }
        }
    }
}
