<?php

/**
 * Class WayNodeStrategy
 */
class WayNodeStrategy implements INodeStrategy
{

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @param INode[] $nodes
     * @return INode[]
     */
    public function refactoringTreeWayNodes(array $nodes)
    {
        $refactoringNodes = [];
        // @TODO implements refactoring tree way nodes
        return $refactoringNodes;
    }

    /**
     * @param INode[] $nodes
     * @return bool
     */
    public function detectCorrectionRelationsNodesInWay(array $nodes)
    {
        $isCorrect = true;
        // @TODO implements detect correction relations nodes
        return $isCorrect;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
