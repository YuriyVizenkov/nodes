<?php

/**
 * Base class for all view classes
 * Class View
 */
abstract class View extends CComponent implements IBreadcrumbs
{
	/**
	 * @var array
	 */
	protected $breadcrumbs = array();

	/**
	 *
	 */
	public function __construct()
	{
		$this->breadcrumbs = ['/' => 'Главная'];
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
	 */
	public function setBreadcrumbs(array $breadcrumbs)
	{
		$this->breadcrumbs = CMap::mergeArray($this->breadcrumbs, $breadcrumbs);
	}
}