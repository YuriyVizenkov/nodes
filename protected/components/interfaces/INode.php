<?php

/**
 * Interface INode
 */
interface INode
{
	/**
	 * @param INode $node
	 * @return bool
	 */
	public function isOneSameRootNode(INode $node);

	/**
	 * @return int
	 */
	public function getRootNodeId();

	/**
	 * @return int
	 */
	public function getNodeId();

	/**
	 * @return int
	 */
	public function getWeight();

	/**
	 * @return int
	 */
	public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @param array $nodesId
     * @return INode
     * @throws CDbException
     * @throws Exception
     */
    public function saveNodeWithRelations(array $nodesId = []);
}
