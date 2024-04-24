<?php
/**
 * Copyright (c) 2018.
 * @author Bruno Michalski, Antony Chacha
 */

namespace RandomWhiteTrash\Grid\Routing;

interface GridRoutesInterface
{
    /**
     * Set the links to be used on the grid for the buttons and forms (filter and search)
     * Use route names for simplicity
     *
     * @return void
     */
    public function setRoutes();

}