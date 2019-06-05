<?php
include "application/models/Employee.php";
include "application/models/Child.php";
include "application/models/SwissVisit.php";

class Controller_Edit extends Controller
{
    public function action_index()
    {
        session_start();
        require_once "config.php";
        //echo($_SESSION['employeePhotoSrc']);

        $userPhoto = "HR/images/user.png";
        if (isset($_POST['idEmployee'])){
            $id = $_POST['idEmployee'];                    
        }
        else{
            $id = $_SESSION['employeePhoto'];  
            $userPhoto = isset($_SESSION['employeePhotoSrc']) ? $_SESSION['employeePhotoSrc'] : "HR/images/user.png";    
        }

        $childArray = array();
        $visitArray = array();

        $sqlChildren = "SELECT * FROM Children where Children.idEmployee = :id";
        if ($queryChildren = $pdo->prepare($sqlChildren)) {
            $queryChildren->bindParam(":id", $id, PDO::PARAM_STR);

            if ($queryChildren->execute()) {
                while ($rowChild = $queryChildren->fetch()) {
                    $child = new Child;
                    $child->idChild = $rowChild['idChildren'];
                    $child->idParent = $rowChild['idEmployee'];
                    $child->ChildName = $rowChild['ChildName'];
                    $child->ChildLastName = $rowChild['ChildLastName'];
                    $child->ChildBirthday = $rowChild['Birth'];

                    $childArray[] = $child;
                }
            }
        }

        $sqlVisit = "SELECT * FROM SwissVisit where SwissVisit.idEmployee = :id";
        if ($queryVisit = $pdo->prepare($sqlVisit)){
            $queryVisit->bindParam(":id", $id, PDO::PARAM_STR);

            if ($queryVisit->execute()){
                while ($rowVisit = $queryVisit->fetch()){
                    $visit = new SwissVisit();
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
			Left JOIN Career ON Employee.id = Career.idEmployee
			LEFT JOIN ForeignPassport ON Employee.id = ForeignPassport.idEmployee

			LEFT JOIN G17 ON Employee.id = G17.idEmployee
            LEFT JOIN HHM ON Employee.id = HHM.idEmployee
            LEFT JOIN SwissVisit ON Employee.id = SwissVisit.idEmployee
            WHERE Employee.id = :id";

        if ($query = $pdo->prepare($sql)) {
            $query->bindParam(":id", $id, PDO::PARAM_STR);
            if ($query->execute()) {
                while ($row = $query->fetch()) {
                    $employee = new Employee;
                    $employee->Id = $row['id'];
                    $employee->Name = $row['Name'];
                    $employee->LastName = $row['LastName'];
                    $employee->Photo = isset($_SESSION['employeePhotoSrc']) ? $_SESSION['employeePhotoSrc'] : $row['Photo'];

                    //-----Personal Data
                    $employee->BirthDate = $row['BirthDate'];
                    $employee->CivilState = $row['CivilState'];
                    $employee->Address = $row['Address'];
                    $employee->PLZ = $row['PLZ'];
                    $employee->Place = $row['Place'];
                    $employee->Phone = $row['Phone'];

                    //-----Career                    
                    $employee->Position = $row['Position'];
                    $employee->StartDate = $row['CareerStart'];
                    $employee->Comment = $row['Comment'];                   
                    $employee->Salary = $row['Salary'];
                    $employee->Status = $row['Status'];

                    //-----Passport
                    $employee->Pass_Name = $row['PassName'];
                    $employee->Pass_LastName = $row['PassLastName'];
                    $employee->Pass_Number = $row['Number'];
                    $employee->Pass_Expired = $row['Valid'];
                   
                    foreach ($childArray as $child) {
                        if ($row['id'] == $child->idParent) {
                            $employee->Children[] = $child;
                        }
                    }

                    //-----G17
                    $employee->G17_email = $row['G17_E-Mail'];
                    $employee->G17_initials = $row['G17_initials'];

                    //-----H17
                    $employee->HHM_email = $row['HHM_E-Mail'];
                    $employee->HHM_initials = $row['HHM_Initials'];

                    foreach ($visitArray as $visit){
                        if ($row['id'] == $visit->idEmployee){
                            $employee->SwissVisit[] = $visit;
                        }
                    }
                    $this->view->employee = $employee;
                }
            }
        }

        $this->view->upload_err = "";              
        //$this->view->user_photo = ""  ;     
        $this->view->generate('edit_view.php', 'template_view.php');
    }
}
