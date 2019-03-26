<?php
class SickLeave
{
    public $idEmployee;
    public $StartDate;
    public $EndDate;
}

class Employee{
      public $Id;
      public $Name;
      public $LastName;
      public $Photo;
}

class SickList_Model extends Model
{
    public $PDO;

    public function get_SickLeaves()
    {
        require_once "config.php";

        $sqlSickList = "SELECT * FROM SickList";
        $sickArray   = array();
        $this->PDO = $pdo;

        if ($querySickLeaves = $pdo->prepare($sqlSickList)) {
            if ($querySickLeaves->execute()) {
                while ($row = $querySickLeaves->fetch()) {
                    $sickLeaves             = new SickLeave;
                    $sickLeaves->idEmployee = $row["idEmployee"];
                    $sickLeaves->StartDate  = $row["StartDate"];
                    $sickLeaves->EndDate    = $row["EndDate"];                    
                    $sickArray[]            = $sickLeaves;
                }
            }
        }
        return $sickArray;
    }

    public function get_Employees()
    {
        $sqlEmployee   = "SELECT * FROM Employee";
        $employeeArray = array();

        if ($queryEmployee = $this->PDO->prepare($sqlEmployee)) {
            if ($queryEmployee->execute()) {
                while ($row = $queryEmployee->fetch()) {
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

      public function get_EmployeeSickLeaves($id){
            $sqlSickList = "SELECT * FROM SickList WHERE `idEmployee` == $id";
            $sickArray   = array();
            $this->PDO = $pdo;
    
            if ($querySickLeaves = $pdo->prepare($sqlSickList)) {
                if ($querySickLeaves->execute()) {
                    while ($row = $querySickLeaves->fetch()) {
                        $sickLeaves             = new SickLeave;
                        $sickLeaves->idEmployee = $row["idEmployee"];
                        $sickLeaves->StartDate  = $row["StartDate"];
                        $sickLeaves->EndDate    = $row["EndDate"];                    
                        $sickArray[]            = $sickLeaves;
                    }
                }
            }
            return $sickArray;
      }

      public function model_test(){
          echo("Model connected");
      }
}
