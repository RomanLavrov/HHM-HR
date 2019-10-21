<?php

class Controller_Delete extends Controller
{

	function action_index()
	{
        require_once "config.php";
        $id = $_POST['idEmployee'];
        echo($id);
      
        $sql="START TRANSACTION;
        
        DELETE FROM Employee WHERE id = :idEmployee;
        DELETE FROM PersonalData WHERE idEmployee = :idEmployee;
        DELETE FROM Career WHERE idEmployee = :idEmployee;
        DELETE FROM ForeignPassport WHERE idEmployee = :idEmployee;
        DELETE FROM G17 WHERE idEmployee = :idEmployee;
        DELETE FROM HHM WHERE idEmployee = :idEmployee;
        DELETE FROM HHM WHERE idEmployee = :idEmployee;
        DELETE FROM SwissVisit WHERE idEmployee =:idEmployee;
        DELETE FROM Vacations WHERE idEmployee=:idEmployee;

        COMMIT";
        
        $query = $pdo->prepare($sql);
        $query->bindParam(":idEmployee", $id, PDO::PARAM_STR);
       
        //$query->execute();
        if ($query->execute()){
            header('location: /HR/main');
        }

	}
}