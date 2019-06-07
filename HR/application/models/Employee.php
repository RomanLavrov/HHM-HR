<?php
class Employee
{
    public $Id;
    public $Name;
    public $LastName;
    public $Photo;

    public $BirthDate;
    public $CivilState;
    public $Address;
	public $PLZ;
	public $Place;
    public $Phone;
   
    public $Position;
    public $StartDate;
    public $Comment;
    public $Salary;
    public $Status;

    public $Pass_Name;
    public $Pass_LastName;
    public $Pass_Number;
    public $Pass_Expired;

    public $Children = array();

    public $G17_email;
    public $G17_initials;

    public $HHM_email;
    public $HHM_initials;

    public $SwissVisit = array();
}