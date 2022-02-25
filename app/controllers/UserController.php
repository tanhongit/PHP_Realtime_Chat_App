<?php

class UserController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->userModel = new UserModel;
    }

    public function login()
    {
        if (isset($_SESSION['current_user'])) {
            header("location: /chat");
        }

        $this->renderView('frontend.user.login');
    }

    public function signup()
    {
        if (isset($_SESSION['current_user'])) {
            header("location: /chat");
        }

        $this->renderView('frontend.user.signup');
    }

    public function list()
    {
        if (!isset($_SESSION['current_user'])) {
            header("location: /user/login");
        }

        $currentUser = $_SESSION['current_user'][0];

        $this->renderView('frontend.user.list', array(
            'currentUser' => $currentUser,
        ));
    }

    public function logout()
    {
        if (isset($_SESSION['current_user'])) {
            $model = array(
                'id' => $_SESSION['current_user'][0]['id'],
                'status' => UserModel::USER_OFF,
            );
            if ($this->userModel->updateData($model)) {
                session_unset();
                session_destroy();
                header("location: /user/login");
            }
        } else {
            header("location: /user/login");
        }
    }

    public function actionSignup()
    {
        if ($_POST) {
            $fname = $this->userModel->escape($_POST['fname']);
            $lname = $this->userModel->escape($_POST['lname']);
            $email = $this->userModel->escape($_POST['email']);
            $password = $_POST['password'];

            if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $user = $this->userModel->findByAttribute(array(
                            'where' => 'email = "' . $email . '"'
                        )
                    );
                    if (count($user) > 0) {
                        echo "$email - This email already exist!";
                    } else {
                        if (isset($_FILES['image'])) {
                            $img_name = $_FILES['image']['name'];

                            $time = time();
                            $new_img_name = $time . '_' . $img_name;

                            $ran_id = rand(time(), 100000000);
                            $status = UserModel::USER_ACTIVE;
                            $encrypt_pass = md5($password);

                            $model = array(
                                'unique_id' => $ran_id,
                                'full_name' => $fname,
                                'last_name' => $lname,
                                'email' => $email,
                                'password' => $encrypt_pass,
                                'status' => $status,
                            );

                            $result = $this->userModel->store($model);

                            $config = array(
                                'name' => $new_img_name,
                                'upload_path' => 'public/frontend/images/',
                                'allowed_exts' => 'jpg|jpeg|png|gif',
                            );

                            $image = $this->userModel->upload('image', $config);

                            if ($image) {
                                $upModel = array(
                                    'id' => (int)$result,
                                    'img' => $new_img_name
                                );
                                $this->userModel->updateData($upModel);
                            }

                            if ((int)$result > 0) {
                                $_SESSION['current_user'] = $this->userModel->findByID($result);
                                echo "success";
                            } else {
                                echo "This email address not Exist!";
                            }
                        }
                    }
                } else {
                    echo "$email is not a valid email!";
                }
            } else {
                echo "All input fields are required!";
            }
        } else {
            echo "Something is wrong!";
        }
    }

    public function actionLogin()
    {
        if ($_POST) {
            $email = $this->userModel->escape($_POST['email']);
            $password = $_POST['password'];
            $result = 0;
            if (!empty($email) && !empty($password)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $user = $this->userModel->findByAttribute(array(
                        'where' => 'email = "' . $email . '"'
                    ));
                    if (count($user) > 0) {
                        if (md5($password) == $user[0]['password']) {
                            $option = array(
                                'id' => $user[0]['id'],
                                'status' => UserModel::USER_ACTIVE,
                            );

                            $result = (int)$this->userModel->updateData($option);

                            if ($result > 0) {
                                $_SESSION['current_user'] = $user;
                                $_SESSION['current_user'][0]['status'] = UserModel::USER_ACTIVE;
                                echo "success";
                            } else {
                                echo "Something is wrong!";
                            }
                        } else {
                            echo "Email or Password is Incorrect!";
                        }
                    } else {
                        //echo "$email - This email not exist!";
                        echo 'Email or Password is Incorrect!';
                    }
                } else {
                    echo "$email is not a valid email!";
                }
            } else {
                echo "All input fields are required!";
            }
        } else {
            echo "Something is wrong!";
        }
    }

    public function actionGetList()
    {
        $output = '';

        if (isset($_SESSION['current_user'])) {
            $currentUser = $_SESSION['current_user'][0];

            $users = $this->userModel->findByAttribute(array(
                    'where' => 'NOT unique_id = "' . $currentUser['unique_id'] . '"'
                )
            );

            if (count($users) > 0) {
                $output .= $this->renderUserItem($users, $currentUser);
            } else {
                $output = 'No users are available to chat';
            }
        } else {
            $output = 'Something is wrong!';
        }

        echo $output;
    }

    public function actionSearch()
    {
        if (isset($_SESSION['current_user'])) {
            $currentUser = $_SESSION['current_user'][0];

            if ($_POST) {
                $keyword = $this->userModel->escape($_POST['keyword']);

                $options = array(
                    'where' => 'NOT unique_id = ' . $currentUser['unique_id'] . ' 
                                AND (full_name LIKE "%' . $keyword . '%" 
                                    OR last_name LIKE "%' . $keyword . '%")',
                    'order_by' => 'id DESC'
                );

                $users = $this->userModel->findByAttribute($options);

                $output = "";

                if (count($users) > 0) {
                    $output .= $this->renderUserItem($users, $currentUser);
                } else {
                    $output .= 'No user found related to your search keyword';
                }
            } else {
                $output = 'Something is wrong!';
            }
        } else {
            $output = 'Something is wrong!';
        }
        echo $output;
    }

    /**
     * Render user item element
     * @param $users
     * @param $currentUser
     * @return string
     */
    public function renderUserItem($users, $currentUser)
    {
        $chatModel = new ChatController();
        $output = '';

        foreach ($users as $user) {
            $chat = $chatModel->getChat(
                array(
                    'order_by' => 'id DESC',
                    'limit' => 1,
                    'where' => '(incoming_msg_id = ' . $user['unique_id'] . ' 
                                OR outgoing_msg_id = ' . $user['unique_id'] . ') 
                                AND (outgoing_msg_id = ' . $currentUser['unique_id'] . ' 
                                    OR incoming_msg_id = ' . $currentUser['unique_id'] . ')',
                )
            );

            $result = count($chat) > 0 ? $chat[0]['message'] : 'No message available';
            $message = strlen($result) > 28 ? substr($result, 0, 28) . '...' : $result;

            $yourTag = '';
            if (isset($chat[0]['outgoing_msg_id'])) {
                $yourTag = $currentUser['unique_id'] == $chat[0]['outgoing_msg_id'] ? "You: " : "";
            }

            //set class html
            $status = $user['status'] == UserModel::USER_OFF ? 'offline' : '';

            $output .= $this->renderPartial('frontend.user.partial.user_item', array(
                'user' => $user,
                'message' => $message,
                'yourTag' => $yourTag,
                'status' => $status
            ));
        }
        return $output;
    }

    /**
     * @param $user_id
     * @return array|void
     */
    public function getUserByUID($user_id)
    {
        return $this->userModel->findByAttribute(array(
            'where' => 'unique_id=' . $user_id,
        ));
    }
}