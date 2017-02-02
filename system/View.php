<?php

namespace System;

class View
{
    private $view;
    public $data = [];

    public function __construct($view, array $data = [])
    {
        $this->view = VIEWS_PATH . '/' . $view . '.php';
        $this->data = $data;
    }

    public static function factory($view, array $data = [])
    {
        return new View($view, $data);
    }

    public function set(array $data)
    {
        $this->data = $data + $this->data;
        return $this;
    }

    public function render()
    {
        if (!empty($this->data)) {
            extract($this->data);
        }

        ob_start();

        include $this->view;

        return ob_get_clean();
    }

    public function __toString()
    {
        return $this->render();
    }
}