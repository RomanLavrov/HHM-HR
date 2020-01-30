<?php
session_start();
class Controller_UploadPhoto extends Controller
{
    public function action_index()
    {
        $user_photo = "image/user.png";
        $target_dir = "employeePhoto/";
        $upload_err = "";
        if (isset($_POST["id"])){
            $idEmployee = $_POST["id"];
            echo ($idEmployee);
        }

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["photo"]) && strlen($_FILES["fileToUpload"]["name"]) > 0) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $upload_err = "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $user_photo = "employeePhoto/" . ($_FILES["fileToUpload"]["name"]);
            $upload_err = "Foto already exists.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $upload_err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            //$upload_err = "Photo already exists.";

            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                //header("location: /create");

                $user_photo = "employeePhoto/" . ($_FILES["fileToUpload"]["name"]);
            } else {
                $upload_err = "Sorry, there was an error uploading your file.";
                $user_photo = "images/user.png";
            }
        }

        if (isset($idEmployee)) {

            $_SESSION['employeePhoto'] = $idEmployee;
            $_SESSION['employeePhotoSrc'] = "employeePhoto/" . ($_FILES["fileToUpload"]["name"]);
            echo( $_SESSION['employeePhotoSrc']);
            header("location: /edit");
        } else {
            $this->view->user_photo_name = $_FILES["fileToUpload"]["name"];
            $this->view->user_photo = $user_photo;
            $this->view->upload_err = $upload_err;

            $this->view->generate('create_view.php', 'template_view.php');
        }
    }
}
