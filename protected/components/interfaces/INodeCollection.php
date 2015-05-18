<?php

/**
 * Interface INodeCollection
 */
interface INodeCollection
{
	/**
	 * @return INode[]
	 */
	public function getNodes();

	/**
	 * @param INode[] $nodes
	 */
	public function setNodes(array $nodes);

    /**
     * @param null|INode $filterNode
     * @return INode[]
     */
    public function getNodesByFilter(INode $filterNode = null);
}
