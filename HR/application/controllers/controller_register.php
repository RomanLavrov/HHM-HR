<?php

class Controller_Register extends Controller
{
    public function action_index()
    {
        $this->view->generate('register_view.php', 'auth_view.php');
	}
	
    public function check_user()
    {
        $user_name = $_POST['user_name'];
        $email_id = $_POST['email_id'];
        $count = $this->model->check_user($user_name, $email_id);
        if ($count > 0) {
            echo 'This User Already Exists';
        } else {
            $data = array(
                'id' => null,
                'user_name' => $_POST['user_name'],
                'email_id' => $_POST['email_id'],
                'password' => $_POST['password'],
            );
            $this->model->insert_user($data);
        }
        header('location:register');
    }
}
