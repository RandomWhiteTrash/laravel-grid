<?php

/**
 * Copyright (c) 2018.
 * @author Bruno Michalski, Antony Chacha
 */

namespace RandomWhiteTrash\Grid;

class ModalRenderer
{

    /**
     * @var array default modal parameters
     */
    private $defaults = [
        'footer-render'  => true,
        'footer-content' => '',
        'method'         => 'POST',
        'action'         => '',
        'size'           => 'lg',
        'backdrop'       => 'static',
        'title'          => ''
    ];

    /**
     * Render the modal opening section
     *
     * @param array $data modal parameters
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function start(array $data)
    {
        $merged = array_merge($this->defaults, $data);
        return view('randomwhitetrash::modal.modal-partial-start', ['modal' => $merged]);
    }

    /**
     * Render the modal closing section
     *
     * @param array $data modal parameters
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function end($data = [])
    {
        $merged = array_merge($this->defaults, $data);
        return view('randomwhitetrash::modal.modal-partial-end', ['modal' => $merged]);
    }
}
