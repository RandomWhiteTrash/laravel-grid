<?php
/**
 * Copyright (c) 2018.
 * @author Bruno Michalski, Antony Chacha
 */
namespace RandomWhiteTrash\Grid\Events;
use Illuminate\Http\Request;
use RandomWhiteTrash\Grid\Grid;
use RandomWhiteTrash\Grid\GridInterface;
use Illuminate\Support\Arr;
class UserActionRequested
{
    /**
     * @var Request
     */
    public $request;
    /**
     * @var
     */
    public $builder;
    /**
     * @var Grid|GridInterface
     */
    public $grid;
    /**
     * @var array
     */
    public $validTableColumns;
    /**
     * @var array
     */
    public $args;
    /**
     * UserActionRequested constructor.
     * @param GridInterface $grid
     * @param Request $request
     * @param $builder
     * @param $validTableColumns
     * @param mixed ...$args
     */
    public function __construct(GridInterface $grid, Request $request, $builder, $validTableColumns, ...$args)
    {
        $this->grid = $grid;
        $this->request = $request;
        $this->builder = $builder;
        $this->validTableColumns = $validTableColumns;
        $this->args = Arr::collapse($args);
    }
}
