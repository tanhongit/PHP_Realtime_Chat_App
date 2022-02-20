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
            header("location: chat");
        }

        $this->renderView('frontend.user.login');
    }

    public function signup()
    {
        if (isset($_SESSION['current_user'])) {
            header("location: chat");
        }

        $this->renderView('frontend.user.signup');
    }

    public function list()
    {
        if (!isset($_SESSION['current_user'])) {
            header("location: user/login");
        }

        $this->renderView('frontend.user.list', array('test' => 1));
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
                            $status = "active";
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
                                'status' => 'active'
                            );

                            $result = (int)$this->userModel->updateData($option);

                            if ($result > 0) {
                                $_SESSION['current_user'] = $user;
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
}