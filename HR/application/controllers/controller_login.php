<?php
session_start();

class Controller_Login extends Controller
{
    public function action_index()
    {
        require_once "config.php";
        $name = "";
        $password = "";
        $name_err = "";
        $password_err = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Check if username is empty
            if (empty(trim($_POST["username"]))) {
                $name_err = "Please enter username.";

            } else {
                $username = trim($_POST["username"]);
                $name = $_POST["username"];
                $name_err = "";
            }

            if (empty(trim($_POST["password"]))) {
                $password_err = "Please enter password";
            } else {
                $password = trim($_POST["password"]);
                $password_err = "";
            }

            if (empty($name_err) && empty($password_err)) {
                $sql = "SELECT id, username, password FROM users WHERE username = :username";

                if ($stmt = $pdo->prepare($sql)) {
                    $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

                    //Set parameters
                    $param_username = trim($_POST["username"]);

                    //Attemt to execute statement
                    if ($stmt->execute()) {
                        //Check if user exists, if yes verify password
                        if ($stmt->rowCount() == 1) {
                            if ($row = $stmt->fetch()) {
                                $id = $row["id"];
                                $username = $row["username"];
                                $hashed_password = $row["password"];

                                if (password_verify($password, $hashed_password)) {
                                    session_start();

                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $username;

                                    header("location: /HR/main");
                                } else {
                                    $password_err = "Password incorrect";
                                }
                            }
                        }
                        else {
                            $name_err = "User not found";
                        }
                    }
                }
            }
        }

        $this->view->username = $name;
        $this->view->username_err = $name_err;
        $this->view->password_err = $password_err;
        $this->view->generate('login_view.php', 'auth_view.php');
    }
}
