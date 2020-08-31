<?php
/**
 * Copyright (c) 2018.
 * @author Antony [leantony] Chacha
 */

namespace Leantony\Grid;

class ModalRenderer
{

    private $defaults = ['footer-render' => true, 'footer-content' => ''];
    /**
     * Render the modal opening section
     *
     * @param $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function start($data)
    {
        $merged = array_merge($this->defaults, $data);
        return view('leantony::modal.modal-partial-start', ['modal' => $merged]);
    }

    /**
     * Render the modal closing section
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function end($data = null)
    {
        $merged = array_merge($this->defaults, $data);
        return view('leantony::modal.modal-partial-end', ['modal' => $merged]);
    }
}