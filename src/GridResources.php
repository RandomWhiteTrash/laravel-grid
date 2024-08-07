<?php
/**
 * Copyright (c) 2018.
 * @author Bruno Michalski, Antony Chacha
 */

namespace RandomWhiteTrash\Grid;

use Illuminate\Http\Request;

trait GridResources
{
    use HasGridConfigurations;

    /**
     * A query builder instance
     *
     * @var \Illuminate\Database\Query\Builder | \Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    /**
     * The request instance
     *
     * @var Request
     */
    protected $request;

    /**
     * The grid instance
     *
     * @var Grid|GridInterface
     */
    protected $grid;

    /**
     * @var array
     */
    protected $validGridColumns = [];

    /**
     * @var array
     */
    protected array $args;

    /**
     * @var array
     */
    protected array $pagination;

    /**
     * Get the query builder
     *
     * @return \Illuminate\Database\Query\Builder | \Illuminate\Database\Eloquent\Builder
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @return array
     */
    public function getArgs(): array
    {
        return $this->args;
    }

    /**
     * The grid instance
     *
     * @return Grid
     */
    public function getGrid(): Grid
    {
        return $this->grid;
    }

    /**
     * Get the http request instance
     *
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @return array
     */
    public function getValidGridColumns(): array
    {
        return $this->validGridColumns;
    }
}