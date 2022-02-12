<?php

class AppController extends Controller
{
    public function index()
    {
        echo __METHOD__;
    }

    public function run()
    {
        echo __METHOD__;
    }

    public function header()
    {
        $this->renderView('frontend.partial.header');
    }

    public function footer()
    {
        $this->renderView('frontend.partial.footer');
    }
}
