<?php
/**
 * Copyright (c) 2018.
 * @author Antony [leantony] Chacha
 */

namespace Leantony\Grid\Listeners;

use Illuminate\Http\Request;
use Leantony\Grid\GridInterface;
use Leantony\Grid\GridResources;

class SearchDataHandler
{
    use GridResources;

    /**
     * Columns to be used during row processing, to find
     * the search form placeholder
     *
     * @var array
     */
    protected $searchColumns = [];

    /**
     * SearchDataHandler constructor.
     * @param GridInterface $grid
     * @param Request $request
     * @param $builder
     * @param $validTableColumns
     * @param $data
     */
    public function __construct(GridInterface $grid, Request $request, $builder, $validTableColumns, $data)
    {
        $this->grid = $grid;
        $this->request = $request;
        $this->query = $builder;
        $this->validGridColumns = $validTableColumns;
        $this->args = $data;
    }

    /**
     * Search the rows
     *
     * @return void
     */
    public function searchRows()
    {
        if (!empty($this->getRequest()->query())) {
            $columns = $this->getGrid()->getColumns();

            $user_input = $this->getRequest()->get($this->getGrid()->getGridSearchParam());
            $user_input_array = explode(" ", $user_input);

            foreach ($user_input_array as $separated_search_term) {
                //Additional replacement to ensure &nbsp; is replaced too. Surfaced as an issue when copying strings from online Excel.
                $separated_search_term = preg_replace ( "!\s++!u", '', $separated_search_term );

                $this->getQuery()->where(function($query) use ($columns, $separated_search_term){

                foreach ($columns as $columnName => $columnData) {
                    // check searchable
                    if (!$this->canSearchColumn($columnName, $columnData)) {
                        continue;
                    }
                    // check user input
                    if (!$this->canUseProvidedUserInput($separated_search_term)) {
                        continue;
                    }
                    // operator
                    $operator = $this->fetchSearchOperator($columnName, $columnData)['operator'];

                    $this->doSearch($query, $columnName, $columnData, $operator, $separated_search_term);
                }
                });
            }
        }
    }

    /**
     * Check if a column can be searched
     *
     * @param string $columnName
     * @param array $columnData
     * @return bool
     */
    public function canSearchColumn(string $columnName, array $columnData)
    {
        return isset($columnData['search']) && $columnData['search']['enabled'] ?? false;
    }

    /**
     * Check if provided user input can be used
     *
     * @param string|null $userInput
     * @return bool
     */
    public function canUseProvidedUserInput($userInput)
    {
        // skip empty requests
        if ($userInput === null || strlen(trim($userInput)) < 1) {
            return false;
        }
        return true;
    }

    /**
     * Get the search operator
     *
     * @param string $columnName
     * @param array $columnData
     * @return array
     */
    public function fetchSearchOperator(string $columnName, array $columnData)
    {
        $operator = $columnData['search']['operator'] ?? 'like';
        return compact('operator');
    }

    /**
     * Search the columns
     *
     * @param string $columnName
     * @param array $columnData
     * @param string $operator
     * @param string $userInput
     * @return void
     */
    public function doSearch($query, string $columnName, array $columnData, string $operator, string $userInput)
    {
        $search = $columnData['search'] ?? [];
        $filter = $columnData['filter'] ?? [];
        // try to use the filter query, if allowed to
        if ($search['useFilterQuery'] ?? false) {
            if (isset($filter['query']) && is_callable($filter['query'])) {
                // otherwise, use the filter, if defined
                call_user_func($filter['query'], $query, $columnName, $userInput);
            }
        } else {
            if (isset($search['query']) && is_callable($search['query'])) {
                // use the search filter
                call_user_func($search['query'], $query, $columnName, $userInput);

            } else {
                if ($operator === strtolower('like')) {
                    // default like scenario
                    $value = '%' . $userInput . '%';
                } else {
                    $value = $userInput;
                }

                $query->where($columnName, $operator, $value, $this->getGrid()->getGridSearchQueryType());
            }
        }
    }
}
