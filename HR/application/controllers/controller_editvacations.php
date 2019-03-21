<?php
class Vacation
{
    public $idEmployee;
    public $StartDate;
    public $EndDate;

}
class Controller_Editvacations extends Controller
{
    public function action_index()
    {
        require_once "config.php";
        print_r (array_chunk($_POST, 3, true));
        $dataArray = (array_chunk($_POST, 3, true));

        $idEmployee = $_POST['Id'];

        $sqlDelete = "DELETE FROM `Vacations` WHERE idEmployee = $idEmployee";
        if ($queryVacation = $pdo->prepare($sqlDelete)) {
            $queryVacation->execute();
        }

        for ($i = 0; $i < sizeof($dataArray); $i++) {
            //print_r($dataArray[$i]);
            $vacArray = $dataArray[$i];

            if (isset($vacArray['Start' . ($i + 2)])) {

                $StartDate = $vacArray['Start' . ($i + 2)];
                $EndDate = $vacArray['End' . ($i + 2)];

                $sqlInsert = "INSERT INTO `Vacations` (`idVacations`, `idEmployee`, `StartDate`, `EndDate`) VALUES (NULL, :idEmployee, :StartDate, :EndDate);";

                $queryInsert = $pdo->prepare($sqlInsert);

                $queryInsert->bindParam(":idEmployee", $idEmployee, PDO::PARAM_STR);
                $queryInsert->bindParam(":StartDate", $StartDate, PDO::PARAM_STR);
                $queryInsert->bindParam(":EndDate", $EndDate, PDO::PARAM_STR);

                if($queryInsert->execute()){
                  //echo("<br>Inserted".$idEmployee);
                }
            }
        }

        header('location: /HR/vacations');
    }
}
