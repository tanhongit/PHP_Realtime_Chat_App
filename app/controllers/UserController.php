<?php

class UserController extends Controller
{
    public function login()
    {
        $this->renderView('frontend.user.login');
    }

    public function signup()
    {
        $this->renderView('frontend.user.signup');
    }

    public function list()
    {
        $this->renderView('frontend.user.list', array('test' => 1));
    }
}