<?php
session_start();

include "application/models/Employee.php";
include "application/models/Child.php";
include "application/models/SwissVisit.php";
include "application/models/employee_model.php";

class Controller_Pdf extends Controller
{
      public function action_index()
      {
            if (isset($_SESSION['loggedin'])) {


                  /*
                  echo ('<pre>');
                  print_r($empArray);
                  echo ('<pre>');*/

                  $this->model = new Employee_Model;

                  $this->view->list = $this->model->getAllEmployee();
                  $this->view->generate('pdf_selection_view.php', 'template_view.php');
            } else {
                  header('Location: /HR/login');
            }
      }

      public function action_print()
      {
            /*
            echo ('<pre>');
            print_r($_POST);
            echo ('<pre>');*/
            
            $this->model = new Employee_Model;            
            $ListEmployee = array();

            if (count($_POST['Id']) > 0) {
                  foreach ($_POST['Id'] as $idEmployee) {
                       $ListEmployee[] = $this->model->getEmployee($idEmployee);
                  }
            }

            echo ('<pre>');
            print_r($ListEmployee);
            echo ('<pre>');

            
            
            foreach ($_POST as $key => $value) {
                  //echo "Field " . htmlspecialchars($key) . " is " . htmlspecialchars($value) . "<br>";

                  if (!strpos($key, "Id")) {
                        switch ($key) {
                              case 'PersonalData':
                                    echo ("PersonalData");
                                    break;

                              case 'Career':
                                    echo ("Career");
                                    break;

                              case 'ForeignPassport':
                                    echo ("ForeignPassport");
                                    break;

                              case 'Children':
                                    echo ("Children");
                                    break;

                              case 'SwissVisit':
                                    echo ("SwissVisit");
                                    break;

                              default:
                                    # code...
                                    break;
                        }
                  }
            }
      }

      private function getData($sql)
      {
            ($_SESSION['employeePhotoSrc'] = null);
            //require_once "config.php";
            $empArray = array();
            $childArray = array();
            $visitArray = array();

            if (isset($_SESSION['loggedin'])) {


                  $sqlChildren = "SELECT * FROM Children";
                  if ($queryChildren = $pdo->prepare($sqlChildren)) {
                        if ($queryChildren->execute()) {
                              while ($rowChild = $queryChildren->fetch()) {
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
                  if ($querySwissVisit = $pdo->prepare($sqlSwissVisit)) {
                        if ($querySwissVisit->execute()) {
                              while ($rowVisit = $querySwissVisit->fetch()) {
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

                  if ($query = $pdo->prepare($sql)) {

                        if ($query->execute()) {
                              while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    $employee = new Employee;
                                    $employee->Id = $row['id'];
                                    $employee->Name = $row['Name'];
                                    $employee->LastName = $row['LastName'];
                                    $employee->Photo = strlen($row['Photo']) == 0 ? "/images/user.png" : "/HR/" . $row['Photo'];
                                    /*
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
                                          if ($row['id'] == $child->idParent && $child->ChildName != "") {
                                                $employee->Children[] = $child;
                                          }
                                    }

                                    //-----G17
                                    $employee->G17_email = $row['G17_E-Mail'];
                                    $employee->G17_initials = $row['G17_initials'];

                                    //-----H17
                                    $employee->HHM_email = $row['HHM_E-Mail'];
                                    $employee->HHM_initials = $row['HHM_Initials'];

                                    foreach ($visitArray as $visit) {
                                          if ($row['idEmployee'] == $visit->idEmployee) {
                                                $employee->SwissVisit[] = $visit;
                                          }
                                    }
                                    */
                                    $empArray[] = $employee;
                              }
                        }
                  }
                  //echo('<pre>');print_r($empArray);echo('<pre>');

            }
            return $empArray;
      }
}
