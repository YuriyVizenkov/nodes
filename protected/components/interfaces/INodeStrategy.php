<?php

/**
 * Interface INodeStrategy
 */
interface INodeStrategy {

    /**
     * @param INode[] $nodes
     * @return INode[]
     */
    public function refactoringTreeWayNodes(array $nodes);

    /**
     * @param INode[] $nodes
     * @return bool
     */
    public function detectCorrectionRelationsNodesInWay(array $nodes);

    /**
     * @return array
     */
    public function getErrors();
}
