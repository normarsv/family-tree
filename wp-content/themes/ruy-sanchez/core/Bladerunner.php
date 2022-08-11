<?php

use eftec\bladeone\BladeOne;

class Bladerunner
{
    private $view;
    private $cache;
    private $blade;

    public function __construct()
    {
        $this->view = get_template_directory() . '/views';
        $upload_dir = wp_upload_dir();
        $this->cache = $upload_dir['basedir'] . '/cache';
        $this->blade = new BladeOne($this->view, $this->cache, BladeOne::MODE_DEBUG);
        $this->blade->setBaseUrl(get_template_directory_uri() . '/dist/');
    }

    public function view($view, $variables)
    {
        return $this->blade->run($view, $variables);
    }
}
