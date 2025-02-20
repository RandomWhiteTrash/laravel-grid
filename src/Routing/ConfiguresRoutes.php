<?php
/**
 * Copyright (c) 2018.
 * @author Bruno Michalski, Antony Chacha
 */

namespace RandomWhiteTrash\Grid\Routing;

trait ConfiguresRoutes
{
    /**
     * Route name for the index route. Will also be used for export, search and filtering
     *
     * @var string
     */
    protected $indexRouteName;

    /**
     * @var array
     */
    protected $indexRouteParams = [];
    protected $createRouteParams = [];
    protected $updateRouteParams = [];
    protected $deleteRouteParams = [];

    /**
     * Route name for the create route
     *
     * @var string
     */
    protected $createRouteName;

    /**
     * Route name for viewing an item
     *
     * @var string
     */
    protected $viewRouteName;

    /**
     * Route name for updating an item
     *
     * @var string
     */
    protected $updateRouteName;

    /**
     * Route name for deleting an item
     *
     * @var string
     */
    protected $deleteRouteName;

    /**
     * Sort url
     *
     * @var string
     */
    protected $sortUrl;

    /**
     * The route parameter to be used for view and delete routes
     *
     * @var string
     */
    protected $defaultRouteParameter = 'id';

    /**
     * @return string
     */
    public function getIndexRouteName(): string
    {
        return $this->indexRouteName;
    }

    /**
     * @param array $params
     * @return string
     */
    public function getIndexUrl(array $params = []): string
    {
        return route($this->getIndexRouteName(), $this->getIndexRouteParams());
    }

    /**
     * @return array
     */
    public function getIndexRouteParams(): array
    {
        return $this->indexRouteParams;
    }

    /**
     * @param array $indexRouteParams
     */
    public function setIndexRouteParams(array $indexRouteParams): void
    {
        $this->indexRouteParams = $indexRouteParams;
    }

    public function getCreateRouteParams(): array
    {
        return $this->createRouteParams;
    }

    public function setCreateRouteParams(array $createRouteParams): void
    {
        $this->createRouteParams = $createRouteParams;
    }

    /**
     * @return string
     */
    public function getRefreshUrl(array $params = []): string
    {
        return $this->getIndexUrl();
    }

    /**
     * @return string
     */
    public function getFilterUrl(): string
    {
        return $this->getIndexUrl();
    }

    /**
     * @param string $indexRouteName
     */
    public function setIndexRouteName(string $indexRouteName): void
    {
        $this->indexRouteName = $indexRouteName;
    }

    /**
     * @param string $key
     * @param string $direction
     * @return string
     */
    public function getSortUrl(string $key, string $direction): string
    {
        $this->setSortUrl($key, $direction);
        return $this->sortUrl;
    }

    /**
     * @param string $key
     * @param string $direction
     */
    protected function setSortUrl(string $key, string $direction): void
    {
        $this->sortUrl = route($this->getIndexRouteName(), add_query_param(array_merge($this->getIndexRouteParams(), [
            $this->getGridSortParam() => $key,
            $this->getGridSortDirParam() => $direction
        ])));
    }

    /**
     * @return string
     */
    public function getCreateRouteName(): string
    {
        return $this->createRouteName;
    }

    /**
     * @param array $params
     * @return string
     */
    public function getCreateUrl(array $params = []): string
    {
         return route($this->getCreateRouteName(), add_query_param($params));
    }

    /**
     * @param array $params
     * @return string
     */
    public function getSearchUrl(array $params = []): string
    {
        return $this->getIndexUrl();
    }

    /**
     * @param string $createRouteName
     */
    public function setCreateRouteName(string $createRouteName): void
    {
        $this->createRouteName = $createRouteName;
    }

    /**
     * @return string
     */
    public function getViewRouteName(): string
    {
        return $this->viewRouteName;
    }

    /**
     * @param string $viewRouteName
     */
    public function setViewRouteName(string $viewRouteName): void
    {
        $this->viewRouteName = $viewRouteName;
    }

    public function getViewUrl(array $params = []): string
    {
        return route($this->getViewRouteName(), add_query_param($params));
    }

    public function setViewRouteParams(array $viewRouteParams): void
    {
        $this->viewRouteParams = $viewRouteParams;
    }

    /**
     * @return string
     */
    public function getUpdateRouteName(): string
    {
        return $this->updateRouteName;
    }

    /**
     * @param string $updateRouteName
     */
    public function setUpdateRouteName(string $updateRouteName): void
    {
        $this->updateRouteName = $updateRouteName;
    }

    public function setUpdateRouteParams(array $updateRouteParams): void
    {
        $this->updateRouteParams = $updateRouteParams;
    }

    /**
     * @param array $params
     * @return string
     */
    public function getUpdateUrl(array $params = []): string
    {
        return route($this->getUpdateRouteName(), add_query_param($params));
    }

    /**
     * @return string
     */
    public function getDeleteRouteName(): string
    {
        return $this->deleteRouteName;
    }

    /**
     * @param array $params
     * @return string
     */
    public function getDeleteUrl(array $params = []): string
    {
        return route($this->getDeleteRouteName(), add_query_param($params));
    }

    /**
     * @param string $deleteRouteName
     */
    public function setDeleteRouteName(string $deleteRouteName): void
    {
        $this->deleteRouteName = $deleteRouteName;
    }

    public function setDeleteRouteParams(array $deleteRouteParams): void
    {
        $this->deleteRouteParams = $deleteRouteParams;
    }

    /**
     * Get the default route parameter
     *
     * @return string
     */
    public function getDefaultRouteParameter(): string
    {
        return $this->defaultRouteParameter;
    }

    /**
     * Set the default route parameter
     *
     * @param string $defaultRouteParameter
     */
    public function setDefaultRouteParameter(string $defaultRouteParameter): void
    {
        $this->defaultRouteParameter = $defaultRouteParameter;
    }
}
