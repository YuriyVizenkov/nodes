<?php

/**
 * Class FrontController
 */
class FrontController extends Controller implements IBreadcrumbs
{
    /**
   	 * @return array action filters
   	 */
   	public function filters()
   	{
   		return array(
   			'accessControl', // perform access control for CRUD operations
   		);
   	}

	/**
	 * @return array
	 */
	public function getBreadcrumbs()
	{
		return $this->breadcrumbs;
	}

	/**
	 * @param array $breadcrumbs
	 * @return void
	 */
	public function setBreadcrumbs(array $breadcrumbs)
	{
		$this->breadcrumbs = CMap::mergeArray($this->breadcrumbs, $breadcrumbs);
	}
}
