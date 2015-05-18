<?php

/**
 * Class NodeView
 */
class NodeView extends View
{
	/**
	 * @var array|INodeCollection
	 */
	private $nodeCollection = [];

	/**
	 * @param INodeCollection $nodeCollection
	 * @return $this
	 */
	public function setNodesCollection(INodeCollection $nodeCollection)
	{
		$this->nodeCollection = $nodeCollection;

		return $this;
	}

	/**
	 * @return CActiveDataProvider
	 */
	public function getNodesViaActiveDataProvider()
	{
		$activeDataProvider = new CActiveDataProvider(new NodeModel());
		$activeDataProvider->setData($this->nodeCollection->getNodes());

		return $activeDataProvider;
	}

    /**
     * @param null|INode $filterNode
     * @return CActiveDataProvider
     */
   	public function getNodesViaActiveDataProviderByFilter(INode $filterNode = null)
   	{
   		$activeDataProvider = new CActiveDataProvider(new NodeModel());
   		$activeDataProvider->setData($this->nodeCollection->getNodesByFilter($filterNode));

   		return $activeDataProvider;
   	}

	/**
	 * Delegation node collection
	 * @return INode[]
	 */
	public function getNodes()
	{
		return $this->nodeCollection->getNodes();
	}
}
