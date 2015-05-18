<?php

/**
 * Class NodeCollection
 */
class NodeCollection extends CComponent implements INodeCollection
{
    /**
   	 * Called when an application is instantiated only
   	 */
   	public function init()
   	{

   	}

	/**
	 * @var array|INode[]
	 */
	private $nodes = [];

	/**
	 * @param INode[] $nodes
	 */
	public function setNodes(array $nodes)
	{
		$this->nodes = $nodes;
	}

	/**
	 * @return array|INode[]
	 */
	public function getNodes()
	{
		return $this->nodes;
	}

    /**
     * @param INode $filterNode
     * @return INode[]
     */
    public function getNodesByFilter(INode $filterNode = null)
    {
        $nodes = [];
        foreach ($this->getNodes() as $node) {
            if ($node->getId() != $filterNode->getId()) {
                $nodes[] = $node;
            }
        }

        return $nodes;
    }
}
