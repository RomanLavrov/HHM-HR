<?php

class Controller_Register extends Controller
{
    public function action_index()
    {
        require_once "config.php";

        if (!empty($_POST['username']) && !empty($_POST['password'])) {

            $user_name = $_POST['username'];
            $user_password = $_POST['password'];
            $user_password_confirm  = $_POST['password-confirm'];

            if ($user_password !== $user_password_confirm){
                echo("False");
                $this->view->generate('register_view.php', 'auth_view.php');
            }
            else{
                $password= password_hash($user_password, PASSWORD_DEFAULT);
            }

            if (!empty($password)){
                $sql = "INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, :userName, :userPassword)";

                if ($query = $pdo->prepare($sql)) {
                    $query->bindParam(":userName", $user_name, PDO::PARAM_STR);
                    $query->bindParam(":userPassword", $password, PDO::PARAM_STR);
                    $query->execute();
                    header('location: /HR/login');
                }
            }           
        }

        $this->view->generate('register_view.php', 'auth_view.php');
    }

    public function check_user()
    {
        $user_name = $_POST['user_name'];
        $email_id  = $_POST['email_id'];
        $count     = $this->model->check_user($user_name, $email_id);
        if ($count > 0) {
            echo 'This User Already Exists';
        } else {
            $data = array(
                'id'        => null,
                'user_name' => $_POST['user_name'],
                'email_id'  => $_POST['email_id'],
                'password'  => $_POST['password'],
            );
            $this->model->insert_user($data);
        }
        //header('location: /HR/register');
    }
}
