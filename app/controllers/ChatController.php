<?php

class ChatController extends Controller
{
    private $chatModel;

    public function __construct()
    {
        $this->loadModel('ChatModel');
        $this->chatModel = new ChatModel;
    }

    public function index()
    {
        if (!isset($_SESSION['current_user'])) {
            header("location: user/login");
        }

        $currentUser = $_SESSION['current_user'];

        self::renderView('frontend.chat.index', array(
            'currentUser' => $currentUser,
        ));
    }
}