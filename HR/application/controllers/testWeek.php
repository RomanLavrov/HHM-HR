<?php

class VacationTest
{
    public $idVacation;
    public $idEmployee;
    public $StartDate;
    public $EndDate;
}

require_once "HR/config.php";

$sqlVacations = "SELECT * FROM `hhmeweme_HR`.`Vacations` ";
$vacArray = array();
if ($queryVacation = $pdo->prepare($sqlVacations)) {
    if ($queryVacation->execute()) {
        while ($rowVacation = $queryVacation->fetch()) {
            
            $vacation = new VacationTest;
            $vacation->idVacation = $rowVacation['idVacations'];
            $vacation->idEmployee = $rowVacation['idEmployee'];
            $vacation->StartDate = $rowVacation['StartDate'];
            $vacation->EndDate = $rowVacation['EndDate'];
            $vacArray[] = $vacation;
        }
    }
}

for ($i=0; $i<sizeof($vacArray); $i++){
    echo "Employee ID: ".$vacArray[$i]->idEmployee;
    echo PHP_EOL;
    echo "Vacation ID: ".$vacArray[$i]->idVacation;
    echo PHP_EOL;
    echo $vacArray[$i]->StartDate;
    echo " - ";
    echo $vacArray[$i]->EndDate;
    echo PHP_EOL.PHP_EOL;
    echo ((new DateTime(($vacArray[$i]->StartDate)))->diff(new DateTime(($vacArray[$i]->EndDate))))->format('%d days');
}
