<?php

class EmployeeVacation
{
    public $ID;
    public $Name;
    public $LastName;
    public $Photo;
    public $Vacations = array();   
    public $Total;
    public $Used;
    public $NotUsed;
}

class Vacation
{
    public $idEmployee;
    public $StartDate;
    public $EndDate;
}

class Controller_Vacations extends Controller
{
    public function action_index()
    {
        session_start();
        require_once "config.php";
        if (isset($_POST['idEmployee'])){
            $id = $_POST['idEmployee'];                    
        }

        $empArray = array();
        $vacArray = array();

        $sqlVacations = "SELECT * FROM Vacations";

        if ($queryVacation = $pdo->prepare($sqlVacations)) {
            if ($queryVacation->execute()) {
                while ($rowVacation = $queryVacation->fetch()) {
                    $vacation = new Vacation;
                    $vacation->idEmployee = $rowVacation['idEmployee'];
                    $vacation->StartDate = $rowVacation['StartDate'];
                    $vacation->EndDate = $rowVacation['EndDate'];
                    $vacArray[] = $vacation;
                }
            }
        }

        $sql = "SELECT * FROM `hhmeweme_HR`.`Employee`";
        if ($query = $pdo->prepare($sql)) {
            if ($query->execute()) {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $empVacation = new EmployeeVacation;
                    $empVacation->ID = $row['id'];
                    $empVacation->Name = $row['Name'];
                    $empVacation->LastName = $row['LastName'];
                    $empVacation->Photo = $row['Photo'];

                    foreach ($vacArray as $vacation) {
                        if ($row['id'] == $vacation->idEmployee) {
                            $empVacation->Vacations[] = $vacation;
                        }                        
                    }                    
                  
                    $empVacation->Duration = $this->getDuration($empVacation->Vacations);
                    $empVacation->Total = 30;
                    $empVacation->Used =  $this->getSumDuration($empVacation->Vacations);
                    $empVacation->NotUsed = 30 - $this->getSumDuration($empVacation->Vacations);
                    $empArray[] = $empVacation;
                }
            }

            $this->view->list = $empArray;
            $this->view->generate('vacations_view.php', 'template_view.php');
        }
    }

    public function getSumDuration($vacArray)
    {
        $period = array();
        foreach ($vacArray as $vacation) {
            $dateStart = date_create($vacation->StartDate);
            $dateEnd = date_create($vacation->EndDate);
            $interval = date_diff($dateStart, $dateEnd, 0);
            $period[] = intval($interval->format('%a')) + 1;
        }

        return array_sum($period);
    }

    public function getDuration($vacArray)
    {
        $period = array();
        $interval = 0;

        for ($month = 0; $month < 12; $month++) {
            $period[$month] = $interval;           
        }    

        foreach ($vacArray as $vacation) {
            //echo date("t", strtotime($vacation->StartDatet));
            $dateStart = date_create($vacation->StartDate);
            $dateEnd = date_create($vacation->EndDate);
            $month = $dateStart->format('m');
            $month = intval($month);

            //-----If vacation is during a month-----
            if ($dateStart->format('m') == $dateEnd->format('m')) {
                $interval = date_diff($dateStart, $dateEnd, 0);
                $period[$month-1] += intval($interval->format('%a')) + 1;               
            } 
            else //-----If vacations is splitted between two months-----
            {                                 
                $lastMonthDay = date("Y-m-t", strtotime($vacation->StartDate));
                $test = date_create($lastMonthDay);
                $difference = intval(date_diff($dateStart, $test, 0)->format('%a')) + 1;
               
                $period[$month-1] = $difference;
                $period[$month] = intval(date_diff($dateStart, $dateEnd, 0)->format('%a')) + 1 -$difference;
            }
        }
        //cho (array_sum($period));
        return ($period);
    }
}
