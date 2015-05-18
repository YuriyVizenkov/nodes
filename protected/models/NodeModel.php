<?php

/**
 * This is the model class for table "{{nodes}}".
 *
 * The followings are the available columns in table '{{nodes}}':
 * @property integer $id
 * @property integer $root_node_id
 * @property integer $node_id
 * @property string $name
 * @property integer $weight
 * @property string $created_at - format TIMESTAMP
 * @property string $updated_at - format TIMESTAMP
 *
 * @method NodeModel   find()                find($condition = '', $params = array())
 * @method NodeModel   findByPk()            findByPk($pk, $condition = '', $params = array())
 * @method NodeModel[] findAllByPk()         findAllByPk($pk, $condition = '', $params = array())
 * @method NodeModel[] findAll()             findAll($condition = '', $params = array())
 * @method NodeModel   findBySql()           findBySql($sql, $params = array())
 * @method NodeModel[] findAllBySql()        findAllBySql($sql, $params = array())
 * @method NodeModel   findByAttributes()    findByAttributes($attributes, $condition = '', $params = array())
 * @method NodeModel[] findAllByAttributes() findAllByAttributes($attributes, $condition = '', $params = array())
 *
 * @method NodeModel   with()                with()
 * @method NodeModel   together()            together()
 */
class NodeModel extends CActiveRecord implements INode
{
	/**
	 * @param string $className
	 * @return self
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_nodes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('weight, name', 'required'),
			array('name', 'unique', 'message' => 'Такой узел уже существует'),
			array('root_node_id, node_id', 'default', 'value' => null),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}

	/**
	 * @return array
	 */
	public function scopes()
	{
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'      => 'ID',
			'name'      => 'Название узла',
			'node_id' => 'Связь с узлом №',
			'weight' => 'Вес связи',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}

	/**
	 * @param INode $node
	 * @return bool
	 */
	public function isOneSameRootNode(INode $node)
	{
		return ($this->getRootNodeId() !== null
                 && $node->getRootNodeId() !== null && $this->getRootNodeId() == $node->getRootNodeId());
	}

    /**
     * @param array $nodesId
     * @return INode
     */
    public function saveNodeWithRelations(array $nodesId = [])
    {
        $nodeStrategy = $this->getWayNodeStrategy();
        $transaction = $this->getDbConnection()->beginTransaction();

        try {
            // выборка дерева (пути), в котором был node
            $treeWayNodes = $this->getTreeWayByNode($nodesId);

            // Перестройка дерева (пути) узлов по новой конфигурации через делегирование pattern Strategy (WayNodesStrategy)
            $refactoringTreeWayNodes = $nodeStrategy->refactoringTreeWayNodes($treeWayNodes);

            // Проверка корректности сформированного дерева (пути) через делегирование pattern Strategy (WayNodesStrategy)
            $isCorrect = $nodeStrategy->detectCorrectionRelationsNodesInWay($refactoringTreeWayNodes);

            // Если корректно сохраняем все обновленные узлы с зависимостями в БД
            if ($isCorrect === true) {
                $this->saveNodes($treeWayNodes, $refactoringTreeWayNodes);
            }
            else {
                $this->addErrors($nodeStrategy->getErrors());
            }
        }
        catch (CDbException $e) {
            $transaction->rollback();
            $this->addErrors(['base' => $e->getMessage()]);
        }

        return $this;
    }

    /**
     * @param array $nodeId
     * @return INode[]
     */
    public function getTreeWayByNode(array $nodeId)
    {
        $nodes = [];
        // @TODO implements getTreeWayByNode
        return $nodes;
    }

    /**
     * @param INode[] $treeWayNodes
     * @param INode[] $refactoringTreeWayNodes
     */
    protected function saveNodes(array $treeWayNodes, array $refactoringTreeWayNodes)
    {
        // @TODO implements saveNodes
    }

    /**
     * @return INodeStrategy
     */
    public function getWayNodeStrategy()
    {
        return new WayNodeStrategy();
    }

	/**
	 * @return int
	 */
	public function getRootNodeId()
	{
		return $this->root_node_id;
	}

	/**
	 * @return int
	 */
	public function getNodeId()
	{
		return $this->node_id;
	}

	/**
	 * @return int
	 */
	public function getWeight()
	{
		return $this->weight;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
