<?php

class Controller_Delete extends Controller
{

	function action_index()
	{
        require_once "config.php";
        $id = $_POST['idEmployee'];
        echo($id);
      
        $sql="DELETE FROM Employee WHERE id = :idEmployee;";        
        
        $query = $pdo->prepare($sql);
        $query->bindParam(":idEmployee", $id, PDO::PARAM_STR);
       
        //$query->execute();
        if ($query->execute()){
            header('location: /HR/main');
        }

	}
}