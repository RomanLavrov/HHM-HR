<?php
class SickLeave
{
    public $idEmployee;
    public $StartDate;
    public $EndDate;
    public $Duration;
}

class Employee
{
    public $Id;
    public $Name;
    public $LastName;
    public $Photo;
}

class SickList_Model extends Model
{
    public $PDO;

    public function __construct()
    {
        require_once "config.php";
        $this->PDO = $pdo;
    }

    public function get_SickLeaves($id = -1)
    {
        if ($id == -1) {
            $sqlSickList = "SELECT * FROM SickList";
        } else {
            $sqlSickList = "SELECT * FROM SickList WHERE `idEmployee` = $id";
        }
        $sickArray = array();

        if ($querySickLeaves = $this->PDO->prepare($sqlSickList)) {
            if ($querySickLeaves->execute()) {
                while ($row = $querySickLeaves->fetch()) {
                    $sickLeaves             = new SickLeave;
                    $sickLeaves->idEmployee = $row["idEmployee"];
                    $sickLeaves->StartDate  = $row["StartDate"];
                    $sickLeaves->EndDate    = $row["EndDate"];
                    $sickLeaves->Duration   = $row["Duration"];
                    $sickArray[]            = $sickLeaves;
                }
            }
        }
        return $sickArray;
    }

    public function get_Employees($id = -1)
    {
        if ($id == -1) {
            $sqlEmployees = "SELECT * FROM Employee";
        } else {
            $sqlEmployees = "SELECT * FROM Employee WHERE `id`= $id";
        }

        $employeeArray = array();

        if ($queryEmployees = $this->PDO->prepare($sqlEmployees)) {
            if ($queryEmployees->execute()) {
                while ($row = $queryEmployees->fetch()) {
                    $employee           = new Employee;
                    $employee->Id       = $row["id"];
                    $employee->Name     = $row["Name"];
                    $employee->LastName = $row["LastName"];
                    $employee->Photo    = $row["Photo"];

                    $employeeArray[] = $employee;
                }
            }
        }

        return $employeeArray;
    }

    public function Delete($idEmployee, $TableName)
    {
        $sqlDelete = "DELETE FROM $TableName WHERE idEmployee = $idEmployee";

        if ($query = $this->PDO->prepare($sqlDelete)) {
            $query->execute();
        }
    }

    public function Insert($idEmployee, $StartDate, $EndDate, $Duration, $TableName)
    {
        if ($TableName == "`SickList`") {
            $sqlInsert = "INSERT INTO `SickList` (`idSickList`, `idEmployee`, `StartDate`, `EndDate`) VALUES(NULL, :idEmployee, :StartDate, :EndDate);";
        }
        if ($TableName == "`Vacations`") {
            
            $sqlInsert = "INSERT INTO `Vacations` (`idVacations`, `idEmployee`, `StartDate`, `EndDate`) VALUES (NULL, :idEmployee, :StartDate, :EndDate)";
            $sqlUpdate = "UPDATE `Career` SET `VacationDuration` = :Duration WHERE idEmployee=$idEmployee";
            

        }
        $queryInsert = $this->PDO->prepare($sqlInsert);

        $queryInsert->bindParam(":idEmployee", $idEmployee, PDO::PARAM_STR);
        $queryInsert->bindParam(":StartDate", $StartDate, PDO::PARAM_STR);
        $queryInsert->bindParam(":EndDate", $EndDate, PDO::PARAM_STR);
        
        if (isset($StartDate) && isset($EndDate)){
            if ($queryInsert->execute()) {
                // echo( "inserted ".$StartDate);
            }
        }
       

        $queryUpdate = $this->PDO->prepare($sqlUpdate);
        $queryUpdate->bindParam(":Duration", $Duration, PDO::PARAM_STR);

        if ($queryUpdate->execute()) {
            // echo( "inserted ".$StartDate);
        }
    }
}
