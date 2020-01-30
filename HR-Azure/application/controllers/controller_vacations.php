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

class Holiday
{
    public $Name;
    public $Date;
    public $Observed;
    public $Public;
}

class Controller_Vacations extends Controller
{
    public function action_index()
    {
        session_start();
        require_once "config.php";
        if (isset($_POST['idEmployee'])) {
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

        $sql = "
        SELECT  Employee.id, Employee.Name, Employee.LastName, Employee.Photo, Career.VacationDuration 
        FROM Employee INNER JOIN Career ON Employee.id = Career.idEmployee";

        if ($query = $pdo->prepare($sql)) {
            if ($query->execute()) {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $empVacation = new EmployeeVacation;
                    $empVacation->ID = $row['id'];
                    $empVacation->Name = $row['Name'];
                    $empVacation->LastName = $row['LastName'];
                    $empVacation->Photo = $row['Photo'];
                    $empVacation->Total = $row['VacationDuration'];

                    foreach ($vacArray as $vacation) {
                        if ($row['id'] == $vacation->idEmployee) {
                            $empVacation->Vacations[] = $vacation;
                        }
                    }

                    $empVacation->Duration = $this->getDuration($empVacation->Vacations);
                    $empVacation->Used =  $this->getSumDuration($empVacation->Vacations);
                    $empVacation->NotUsed = $empVacation->Total - $this->getSumDuration($empVacation->Vacations);
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

            //$period[] = intval($interval->format('%a')) + 1;
            $period[] = $this->workDayDuration($dateStart, $dateEnd);
        }
        //print_r($period);
        return array_sum($period);
    }

    public function workDayDuration($dateStart, $dateEnd)
    {
        //echo($dateStart->format("d-m-Y")." ".$dateEnd->format("d-m-Y")."<br>" );
        $interval = date_diff($dateStart, $dateEnd, 0);
        $workDayCounter = 0;
        $currentDay = $dateStart;
        $vacationDuration = intval($interval->format('%a') + 1);

        for ($i = 0; $i < $vacationDuration; $i++) {
            //echo($dateStart->format('d-m-Y')."<br>");
            if ($currentDay->format('w') !== '6' && $currentDay->format('w') !== '0') {
                $workDayCounter = $workDayCounter + 1;
            }
            $currentDay->modify('+1 day');
        }

        $holidaysArray = $this->get_Holidays();
        $dateStart->modify('-' . intval($interval->format('%a') + 1) . ' day');
        //echo ($dateStart->format('Y-m-d'));
        $tempDay = $dateStart;

        for ($i = 0; $i < $vacationDuration; $i++) {
            //echo ($tempDay->format('Y-m-d') . "<br>");
            foreach ($holidaysArray as $holiday) {
                if ($holiday->Public == 1) {
                    if (($tempDay->format('Y-m-d')) == $holiday->Date) {
                        //echo ($holiday->Name . "<br>");
                        //echo ($workDayCounter . "<br>");
                        
                        $workDayCounter = $workDayCounter - 1;
                    }                    
                }
            }
            $tempDay->modify('+1 day');
        }

        return $workDayCounter;
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
                //$interval = date_diff($dateStart, $dateEnd, 0);
                //$period[$month-1] += intval($interval->format('%a')) + 1;  

                $period[$month - 1] += $this->workDayDuration($dateStart, $dateEnd);
            } else //-----If vacations is splitted between two months-----
            {
                $lastMonthDay = date("Y-m-t", strtotime($vacation->StartDate));
                $test = date_create($lastMonthDay);
                //$difference = intval(date_diff($dateStart, $test, 0)->format('%a')) + 1;
                $difference = $this->workDayDuration($dateStart, $test);

                $period[$month - 1] += $difference;

                //$period[$month] = intval(date_diff($dateStart, $dateEnd, 0)->format('%a')) + 1 -$difference;
                $period[$month] += $this->workDayDuration($dateStart, $dateEnd);
            }
        }
        //echo (array_sum($period));
        return ($period);
    }

    public function get_Holidays()
    {
        $jsonHolidays = file_get_contents("application/json/holidays.json", "r");
        $holidays     = json_decode($jsonHolidays, true);
        $holidayArray = array();

        foreach ($holidays as $holiday) {
            for ($i = 0; $i < sizeof($holiday); $i++) {
                $h              = $holiday[$i];
                $day            = new Holiday;
                $day->Name      = $h['name'];
                $day->Date      = $h['date'];
                $day->Observed  = $h['observed'];
                $day->Public    = $h['public'];
                $holidayArray[] = $day;
            }
        }

        return $holidayArray;
    }
}
