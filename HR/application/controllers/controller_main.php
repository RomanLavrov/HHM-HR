<?php
session_start();

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

    public $CareerStart;
    public $Position;
    public $Salary;

    public $Pass_Name;
    public $Pass_LastName;
    public $Pass_Number;
    public $Pass_Expired;

    public $Children = array();

    public $ChildName;
    public $ChildLastName;
    public $ChildBirthday;

    public $G17_email;
    public $G17_initials;

    public $HHM_email;
    public $HHM_initials;
}

class Child{
    public $idParent;
    public $ChildName;
    public $ChildLastName;
    public $ChildBirthday;
}

class Controller_Main extends Controller
{
    public function action_index()
    {
        ($_SESSION['employeePhotoSrc'] = null);
        require_once "config.php";
        $empArray = array();
        $childArray = array();

       // if (isset($_SESSION['loggedin'])) {

            $sqlChildren = "SELECT * FROM Children";
            if($queryChildren = $pdo->prepare($sqlChildren)){
                if ($queryChildren->execute()){
                    while($rowChild=$queryChildren->fetch()){
                        $child = new Child;
                        $child->idParent = $rowChild['idEmployee'];
                        $child->ChildName = $rowChild['ChildName'];
                        $child->ChildLastName = $rowChild['ChildLastName'];
                        $child->ChildBirthday = $rowChild['Birth'];                       
                        $childArray[] = $child;
                    }
                }
            }

            $sql = "SELECT * FROM Employee             
            LEFT JOIN PersonalData ON Employee.id = PersonalData.idEmployee
			Left JOIN Career ON Employee.id = Career.idEmployee
			LEFT JOIN ForeignPassport ON Employee.id = ForeignPassport.idEmployee
			
			LEFT JOIN G17 ON Employee.id = G17.idEmployee
            LEFT JOIN HHM ON Employee.id = HHM.idEmployee" ;

            if ($query = $pdo->prepare($sql)) {

                if ($query->execute()) {
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $employee = new Employee;
                        $employee->Id = $row['id'];
                        $employee->Name = $row['Name'];
                        $employee->LastName = $row['LastName'];
                        $employee->Photo = strlen($row['Photo'])==0 ? "/images/user.png" : $row['Photo'];

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
                        $employee->Pass_Name = $row['PassName'];
                        $employee->Pass_LastName = $row['PassLastName'];
                        $employee->Pass_Number = $row['Number'];
                        $employee->Pass_Expired = $row['Valid'];

                        //-----Children
                        /*
                        $employee->ChildName = $row['ChildName'];
                        $employee->ChildLastName = $row['ChildLastName'];
                        $employee->ChildBirthday = $row['Birth'];*/
                        foreach($childArray as $child){
                            if($row['id'] == $child->idParent && $child->ChildName!=""){                               
                                $employee->Children[] = $child;
                            }                            
                        }      

                        //-----G17
                        $employee->G17_email = $row['G17_E-Mail'];
						$employee->G17_initials = $row['G17_initials'];
						
						//-----H17
						$employee->HHM_email = $row['HHM_E-Mail'];
                        $employee->HHM_initials = $row['HHM_Initials'];

                        $empArray[] = $employee;
                    }
                }
            }

            $this->view->list = $empArray;

            $this->view->generate('main_view.php', 'template_view.php');
        /*} else {
            header('Location: /HR/login');
        }*/
    }
}
