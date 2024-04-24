<?php
/**
 * Copyright (c) 2018.
 * @author Bruno Michalski, Antony Chacha
 */

namespace RandomWhiteTrash\Grid\Export;

use Illuminate\Support\Collection;

class HtmlExport implements GridExportInterface
{
    /**
     * Export data from the grid
     *
     * @param Collection $data
     * @param array $args
     * @return mixed
     */
    public function export($data, array $args)
    {
        $exportableColumns = $args['exportableColumns'];
        $fileName = $args['fileName'];
        $exportView = $args['exportView'];
        $title = $args['title'];

        return response()->streamDownload(function () use ($data, $exportableColumns, $exportView, $title) {
            echo view($exportView, [
                'title' => $title,
                'columns' => $exportableColumns,
                'data' => $data->toArray()
            ])->render();
        }, $fileName . '.html');
    }
}