<?php
/**
 * Copyright (c) 2018.
 * @author Bruno Michalski, Antony Chacha
 */

namespace RandomWhiteTrash\Grid\Filters;

interface GridFilterInterface
{
    /**
     * Add a filter to the row
     *
     * @param $rowValue
     * @param $rowKey
     * @return GenericFilter
     */
    public function pushFilter($rowValue, $rowKey): GenericFilter;
}