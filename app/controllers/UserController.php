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
                    $user = $this->userModel->findByAttribute(array('email' => $email));
                    if (count($user) > 0) {
                        echo "$email - This email already exist!";
                    } else {
                        if (isset($_FILES['image'])) {
                            $img_name = $_FILES['image']['name'];
                            $img_type = $_FILES['image']['type'];
                            $tmp_name = $_FILES['image']['tmp_name'];

                            $img_explode = explode('.', $img_name);
                            $img_ext = end($img_explode);

                            $extensions = ["jpeg", "png", "jpg"];
                            if (in_array($img_ext, $extensions)) {
                                $types = ["image/jpeg", "image/jpg", "image/png"];
                                if (in_array($img_type, $types)) {
                                    $time = time();
                                    $new_img_name = $time . $img_name;
                                    if (move_uploaded_file($tmp_name, "frontend/images/" . $new_img_name)) {
                                        $ran_id = rand(time(), 100000000);
                                        $status = "Active now";
                                        $encrypt_pass = md5($password);

                                        $model = array(
                                            'unique_id' => $ran_id,
                                            'full_name' => $fname,
                                            'last_name' => $lname,
                                            'email' => $email,
                                            'password' => $encrypt_pass,
                                            'img' => $new_img_name,
                                            'status' => $status,
                                        );

                                        $result = $this->userModel->store($model);

                                        if (count($result) > 0) {
                                            $_SESSION['current_user'] = $result;
                                            echo "success";
                                        } else {
                                            echo "This email address not Exist!";
                                        }
                                    }
                                } else {
                                    echo "Please upload an image file - jpeg, png, jpg";
                                }
                            } else {
                                echo "Please upload an image file - jpeg, png, jpg";
                            }
                        }
                    }
                } else {
                    echo "$email is not a valid email!";
                }
            } else {
                echo "All input fields are required!";
            }
        }
    }
}