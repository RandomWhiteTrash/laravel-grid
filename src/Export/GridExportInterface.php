<?php
/**
 * Copyright (c) 2018.
 * @author Bruno Michalski, Antony Chacha
 */

namespace RandomWhiteTrash\Grid\Export;

use Illuminate\Support\Collection;

interface GridExportInterface
{
    /**
     * Export data from the grid
     *
     * @param Collection $data
     * @param array $args
     * @return mixed
     */
    public function export($data, array $args);
}