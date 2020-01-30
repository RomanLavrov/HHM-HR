<?php
session_start();

class Calendar
{
    public $Year  = array();
    public $Month = array();
}

class Month
{
    public $MonthHeader;
    public $WeekDayHeader = array();
    public $MonthDays     = array();
}
class Day
{
    public $Date;
    public $Today;
    public $WeekDay;
    public $Vacation;
    public $SickLeave;
    public $Holiday;
}

class Holiday
{
    public $Name;
    public $Date;
    public $Observed;
    public $Public;
}

class EmployeeCalendar
{
    public $Id;
    public $Photo;
    public $Name;
    public $LastName;
    public $Vacations;
    public $Duration;
}

class Vacation
{
    public $idVacation;
    public $idEmployee;
    public $StartDate;
    public $EndDate;
}

class Controller_Calendar extends Controller
{
    public $IdEmployee;
    public $currentYear = "2019";

    public function action_index()
    {
        $employee = new EmployeeCalendar;
        require_once "config.php";
        $employeeId;      

        if (isset($_POST['idEmployee'])) {
            $employee->Id = $_POST['idEmployee'];
            $employeeId   = $_POST['idEmployee'];
        }
        $sqlVacations = "SELECT * FROM Vacations WHERE idEmployee = $employee->Id";

        $vacArray     = array();
        if ($queryVacation = $pdo->prepare($sqlVacations)) {
            if ($queryVacation->execute()) {
                while ($rowVacation = $queryVacation->fetch()) {

                    $vacation             = new Vacation;
                    $vacation->idVacation = $rowVacation['idVacations'];
                    $vacation->idEmployee = $rowVacation['idEmployee'];
                    $vacation->StartDate  = $rowVacation['StartDate'];
                    $vacation->EndDate    = $rowVacation['EndDate'];    
                    $vacArray[]           = $vacation;
                }
            }
        }

        $sqlEmployee = "SELECT Employee.*, Career.VacationDuration FROM Employee INNER JOIN Career ON Employee.id=Career.idEmployee WHERE Employee.id = $employee->Id";
        if ($queryEmployee = $pdo->prepare($sqlEmployee)) {
            if ($queryEmployee->execute()) {
                while ($rowEmployee = $queryEmployee->fetch()) {
                    $employee->Name     = $rowEmployee["Name"];
                    $employee->LastName = $rowEmployee["LastName"];
                    $employee->Photo    = $rowEmployee["Photo"];
                    $employee->Duration = $rowEmployee["VacationDuration"];
                }
            }
        }

        $employee->Vacations  = $vacArray;
        $calendar             = new Calendar;
        $calendar->Year       = $this->getYear($this->currentYear, $employee);
        $this->view->employee = $employee;
        $this->view->calendar = $calendar;
        $this->view->generate('calendar_view.php', 'template_view.php');
    }

    public function getYear($year, $employee)
    {
        $Month   = array("Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
        $WeekDay = array("MO", "DI", "MI", "DO", "FR", "SA", "SO");

        $caledarYear  = array();
        $monthsLength = array();
        $month        = array();
        for ($i = 1; $i <= 12; $i++) {
            $monthView = new Month();

            $monthLength    = cal_days_in_month(CAL_GREGORIAN, $i, $year);
            $monthsLength[] = $monthLength;
            $firstMonthDay  = date('w', strtotime("01." . $i . "." . $year));

            $month = $this->getMonth($firstMonthDay, $monthLength, $i, $employee);

            $monthView->MonthHeader   = $Month[$i - 1];
            $monthView->WeekDayHeader = $WeekDay;
            $monthView->MonthDays     = $month;

            $calendarYear[] = $monthView;
        }

        return $calendarYear;
    }

    public function SortDays($week)
    {
        usort($week, array('Controller_Calendar', 'compare'));
        return $week;
    }

    private static function compare($d1, $d2)
    {
        if ($d1->Date == $d2->Date) {
            return 0;
        }
        return ($d1->Date < $d2->Date) ? -1 : 1;
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

    public function checkHoliday($date)
    {
        $d_date = DateTime::createFromFormat('d-F-Y', $date);

        foreach ($this->get_Holidays() as $holiday) {
            if ($holiday->Date == $d_date->format("Y-m-d") && $holiday->Public == true) {
                return $holiday->Name;
            }    
        }
        return "false";
    }

    public function getMonth($firstDay, $monthLength, $currentMonth, $employee)
    {
        $month = array();

        if ($firstDay == 0) {
            $firstDay = 7;
        }
        $startWeek = 0;
        $endWeek   = 0;

        for ($i = 1; $i <= $monthLength; $i++) {

            if (($i + $firstDay - 1) % 7 == 0 || $i == $monthLength) {
                $startWeek = $endWeek + 1;
                $endWeek   = $i;

                $week      = array();
                $dayOfWeek = 0;
                for ($day = intval($startWeek); $day <= intval($endWeek); $day++) {
                    $dayOfWeek++;
                    $dayData            = new Day;
                    $dayData->Date      = intval($day);
                    $dayData->Today     = date("d-F-Y", strtotime((string) $day . "-" . (string) $currentMonth . "-" . (string) $this->currentYear));
                    $dayData->WeekDay   = $dayOfWeek;
                    $dayData->SickLeave = "false";
                    $dayData->Holiday   = $this->checkHoliday($dayData->Today);
                    $dayData->Vacation  = "false";

                    $dayToCompare = strtotime((string) $day . "-" . (string) $currentMonth . "-" . (string) $this->currentYear);
                    $dayToday     = strtotime("today");

                    foreach ($employee->Vacations as $vacation) {
                        if (strtotime($dayData->Today) >= strtotime($vacation->StartDate) && strtotime($dayData->Today) <= strtotime($vacation->EndDate)) {
                            $dayData->Vacation = "true";
                        }
                    }
                    $dayData->SickLeave = "false";

                    //$week[] = $day;
                    $week[] = $dayData;
                }
                if (count($week) < 7) {
                    while (count($week) < 7) {
                        $emptyDay            = new Day;
                        $emptyDay->Date      = 0;
                        $emptyDay->Today     = "";
                        $emptyDay->Vacation  = "false";
                        $emptyDay->SickLeave = "false";
                        $week[]              = $emptyDay;
                    }
                    if ($endWeek < 7) {
                        $week = $this->SortDays($week);
                        for ($i = 0; $i < sizeof($week); $i++) {
                            $week[$i]->WeekDay = $i + 1;
                        }
                    }
                }
                $month[] = $week;
            }
        }
        return $month;
    }

    

}
