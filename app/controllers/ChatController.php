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
            $userId = $this->chatModel->escape($_GET['user_id']);
            $user = new UserController();
            $userDetail = $user->getUserByUID($userId);

            if (count($userDetail) > 0) {
                self::renderView('frontend.chat.index', array(
                    'currentUser' => $currentUser,
                    'user_detail' => $userDetail[0],
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

    public function actionAddChatItem()
    {
        if (!isset($_SESSION['current_user'])) {
            header("location: user/login");
        }

        if ($_POST) {
            $currentUser = $_SESSION['current_user'][0];
            $incomingId = $this->chatModel->escape($_POST['incoming_id']);
            $message = $this->chatModel->escape($_POST['message']);

            $model = array(
                'outgoing_msg_id' => $currentUser['id'],
                'incoming_msg_id' => $incomingId,
                'message' => $message,
            );

            $result = $this->chatModel->store($model);
        }
    }

    public function getChatItem() {
        
    }
}