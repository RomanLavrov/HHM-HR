<?php
session_start();

class EmployeeSick
{
    public $ID;
    public $Name;
    public $LastName;
    public $Photo;
    public $Sick = array();
    public $Duration;
    public $Total;
}

class Controller_SickList extends Controller
{
    public function action_index()
    {
        $this->model = new SickList_Model;

        $sick      = $this->model->get_SickLeaves();
        $employees = $this->model->get_Employees();
        $empArray  = array();

        foreach ($employees as $employee) {
            $emp           = new EmployeeSick;
            $emp->ID       = "$employee->Id";
            $emp->Name     = $employee->Name;
            $emp->LastName = $employee->LastName;
            $emp->Photo    = $employee->Photo;

            foreach ($sick as $sickLeave) {
                if ($sickLeave->idEmployee == $employee->Id) {
                    $emp->Sick[] = $sickLeave;
                }
            }

            $emp->Duration = $this->getDuration($emp->Sick);
            $emp->Total    = $this->getSumDuration($emp->Sick);
            $empArray[]    = $emp;
        }

        $this->view->list = $empArray;
        $this->view->generate('sicklist_view.php', 'template_view.php');
    }

    public function getSumDuration($vacArray)
    {
        $period = array();
        foreach ($vacArray as $vacation) {
            $dateStart = date_create($vacation->StartDate);
            $dateEnd   = date_create($vacation->EndDate);
            $interval  = date_diff($dateStart, $dateEnd, 0);
            $period[]  = intval($interval->format('%a')) + 1;
        }

        return array_sum($period);
    }

    public function getDuration($vacArray)
    {
        $period   = array();
        $interval = 0;

        for ($month = 0; $month < 12; $month++) {
            $period[$month] = $interval;
        }

        foreach ($vacArray as $vacation) {
            //echo date("t", strtotime($vacation->StartDatet));
            $dateStart = date_create($vacation->StartDate);
            $dateEnd   = date_create($vacation->EndDate);
            $month     = $dateStart->format('m');
            $month     = intval($month);

            //-----If vacation is during a month-----
            if ($dateStart->format('m') == $dateEnd->format('m')) {
                $interval           = date_diff($dateStart, $dateEnd, 0);
                $period[$month - 1] += intval($interval->format('%a')) + 1  ;
            } else //-----If vacations is splitted between two months-----
            {
                $lastMonthDay = date("Y-m-t", strtotime($vacation->StartDate));
                $test         = date_create($lastMonthDay);
                $difference   = intval(date_diff($dateStart, $test, 0)->format('%a')) + 1;

                $period[$month - 1] = $difference;
                $period[$month]     = intval(date_diff($dateStart, $dateEnd, 0)->format('%a')) + 1 - $difference;
            }
        }

        //echo (array_sum($period));
        return ($period);
    }
}
