<?php

class Employee
{
    public $Id;
    public $Name;
    public $LastName;

    public $BirthDate;
    public $CivilState;
    public $Address;
	public $PLZ;
	public $Place;
    public $Phone;

    public $CareerStart;
    public $Position;
    public $Salary;

    public $Pass_Name;
    public $Pass_LastName;
    public $Pass_Number;
    public $Pass_Expired;

    public $ChildName;
    public $ChildLastName;
    public $ChildBirthday;

    public $G17_email;
    public $G17_initials;

    public $HHM_email;
    public $HHM_initials;
}

require_once "config.php";
$sql = "SELECT Employe* FROM Employee          
            LEFT JOIN PersonalData ON Employee.idEmployee = PersonalData.idEmployee;      
			Left JOIN Career ON Employee.idEmployee = Career.idEmployee
			LEFT JOIN ForeignPassport ON Employee.idEmployee = ForeignPassport.idEmployee
			LEFT JOIN Children ON Employee.idEmployee = Children.idEmployee
			LEFT JOIN G17 ON Employee.idEmployee = G17.idEmployee
			LEFT JOIN HHM ON Employee.idEmployee = HHM.idEmployee" ;

            if ($query = $pdo->prepare($sql)) {

                if ($query->execute()) {
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo json_encode($row);
                        /*
                        $employee = new Employee;
                        $employee->Id = $row['idEmployee'] == NULL ? "null" : $row['idEmployee'];
                        $employee->Name = $row['Name'];
                        $employee->LastName = $row['LastName'];

                        //-----Personal Data
                        $employee->BirthDate = $row['BirthDate'];
                        $employee->CivilState = $row['CivilState'];
                        $employee->Address = $row['Address'];
						$employee->PLZ = $row['PLZ'];
						$employee->Place = $row['Place'];
                        $employee->Phone = $row['Phone'];

                        //-----Career
                        $employee->Position = $row['Position'];
                        $employee->StartDate = $row['StartDate'];
                        $employee->Salary = $row['Salary'];

                        //-----Passport
                        $employee->Pass_Name = $row['Name'];
                        $employee->Pass_LastName = $row['LastName'];
                        $employee->Pass_Number = $row['Number'];
                        $employee->Pass_Expired = $row['Valid'];

                        //-----Children
                        $employee->ChildName = $row['ChildName'];
                        $employee->ChildLastName = $row['ChildLastName'];
                        $employee->ChildBirthday = $row['Birth'];

                        //-----G17
                        $employee->G17_email = $row['G17_E-Mail'];
						$employee->G17_initials = $row['G17_initials'];
						
						//-----H17
						$employee->HHM_email = $row['HHM_E-Mail'];
						$employee->HHM_initials = $row['HHM_Initials'];

                        $empArray[] = $employee;*/
                    
                    }
                }
            }
        