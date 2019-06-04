<?php
session_start();

include "application/models/Employee.php";
include "application/models/Child.php";
include "application/models/SwissVisit.php";

class Controller_Main extends Controller
{
    public function action_index()
    {
        ($_SESSION['employeePhotoSrc'] = null);
        require_once "config.php";
        $empArray = array();
        $childArray = array();
        $visitArray = array();

        if (isset($_SESSION['loggedin'])) {

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

            $sqlSwissVisit = "SELECT * FROM SwissVisit";
            if ($querySwissVisit = $pdo->prepare($sqlSwissVisit)){
                if ($querySwissVisit->execute()){
                    while($rowVisit=$querySwissVisit->fetch()){
                        $visit = new SwissVisit;
                        $visit->idEmployee = $rowVisit['idEmployee'];
                        $visit->StartDate = $rowVisit['StartDate'];
                        $visit->EndDate = $rowVisit['EndDate'];
                        $visit->Location = $rowVisit['Location'];
                        $visit->Accommodation = $rowVisit['Accommodation'];
                        $visit->Goal = $rowVisit['Goal'];
                        $visit->Group = $rowVisit['Group'];

                        $visitArray[] = $visit;
                    }
                }
            }

            $sql = "SELECT * FROM Employee             
            LEFT JOIN PersonalData ON Employee.id = PersonalData.idEmployee
			LEFT JOIN Career ON Employee.id = Career.idEmployee
			LEFT JOIN ForeignPassport ON Employee.id = ForeignPassport.idEmployee			
			LEFT JOIN G17 ON Employee.id = G17.idEmployee
            LEFT JOIN HHM ON Employee.id = HHM.idEmployee
            LEFT JOIN SwissVisit ON Employee.id = SwissVisit.idEmployee" ;

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
                        $employee->Comment = $row['Comment'];
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

                        foreach($visitArray as $visit){
                            if ($row['idEmployee'] == $visit->idEmployee){
                                $employee->SwissVisit[] = $visit;
                            }
                        }

                        $empArray[] = $employee;
                    }
                }
            }

            $this->view->list = $empArray;

            $this->view->generate('main_view.php', 'template_view.php');
        } else {
            header('Location: /HR/login');
        }
    
    }
}
