<?php

/**
 * Interface IBreadcrumbs
 */
interface IBreadcrumbs
{
    /**
     * @return array
     */
    public function getBreadcrumbs();

    /**
     * @param array $breadcrumbs
     * @return void
     */
    public function setBreadcrumbs(array $breadcrumbs);
}
