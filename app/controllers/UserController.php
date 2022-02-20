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

    public function actionSignup()
    {
        if ($_POST) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
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
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!empty($email) && !empty($password)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $user = $this->userModel->findByAttribute(array('email' => $email));
                    if (count($user) > 0) {
                        echo $user['password'];
                    } else {
                        echo "$email - This email not exist!";
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