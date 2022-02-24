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

        $currentUser = $_SESSION['current_user'][0];

        if (!empty($_GET['user_id'])) {
            $user_id = $this->chatModel->escape($_GET['user_id']);
            $user = new UserController();
            $user_detail = $user->getUserByUID($user_id);

            if (count($user_detail) > 0) {
                self::renderView('frontend.chat.index', array(
                    'currentUser' => $currentUser,
                    'user_detail' => $user_detail[0],
                ));
            } else {
                header("location: user/list");
            }
        } else {
            header("location: user/list");
        }
    }

    /**
     * @param $option
     * @return array|void
     */
    public function getChat($option)
    {
        return $this->chatModel->findByAttribute($option);
    }
}