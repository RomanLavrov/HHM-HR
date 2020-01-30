<?php

class Holiday
{
    public $Name;
    public $Date;
    public $Observed;
    public $Public;
}

checkHoliday();

function get_Holidays()
{
    $jsonHolidays = file_get_contents("HR\application\json\holidays.json", "r");
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

function checkHoliday($date = '01-January-2019')
{
    $d_date = DateTime::createFromFormat('d-F-Y', $date);

    foreach (get_Holidays() as $holiday) {
        if ($holiday->Date == $d_date->format("Y-m-d")) {
            echo ($holiday->Date);
        }

    }
}
