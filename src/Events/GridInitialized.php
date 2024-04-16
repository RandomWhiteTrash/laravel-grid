<?php
/**
 * Copyright (c) 2018.
 * @author Antony [leantony] Chacha
 */

namespace RandomWhiteTrash\Grid\Events;

use RandomWhiteTrash\Grid\GridInterface;

class GridInitialized
{
    /**
     * @var GridInterface
     */
    public $grid;

    /**
     * @var array
     */
    public $params;

    /**
     * GridInitialized constructor.
     * @param GridInterface $grid
     * @param array $params
     */
    public function __construct(GridInterface $grid, array $params)
    {
        $this->grid = $grid;
        $this->params = $params;
    }

}