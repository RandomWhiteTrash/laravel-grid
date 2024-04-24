<?php
/**
 * Copyright (c) 2018.
 * @author Bruno Michalski, Antony Chacha
 */

namespace RandomWhiteTrash\Grid\Events;

use RandomWhiteTrash\Grid\Columns\Column;

class ColumnProcessed
{
    /**
     * @var Column
     */
    public $column;

    /**
     * @var string
     */
    public $columnName;

    /**
     * @var array
     */
    public $columnData;

    /**
     * ColumnProcessed constructor.
     * @param string $columnName
     * @param array $columnData
     * @param Column $column
     */
    public function __construct(string $columnName, array $columnData, Column $column)
    {
        $this->column = $column;
        $this->columnName = $columnName;
        $this->columnData = $columnData;
    }
}