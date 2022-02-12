<?php

class ChatController extends Controller
{
    public function index()
    {
        self::renderView('frontend.chat.index');
    }
}