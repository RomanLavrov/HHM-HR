<?php
session_start();

include "application/models/Employee.php";
include $_SERVER['DOCUMENT_ROOT'].'/HR/Twilio/twilio-php-master/src/Twilio/autoload.php';
use Twilio\Rest\Client;
class Controller_Main extends Controller
{
    
    

    public function action_index()
    
    {        
        
        unset($_SESSION['employeeID']);
        ($_SESSION['employeePhotoSrc'] = null);      
            
        if (isset($_SESSION['loggedin'])) {
            $_SESSION['cityID'] = null;

           $sql = "SELECT * FROM Employee             
            LEFT JOIN PersonalData      ON Employee.id = PersonalData.idEmployee
            LEFT JOIN Career            ON Employee.id = Career.idEmployee
            LEFT JOIN ForeignPassport   ON Employee.id = ForeignPassport.idEmployee			
            LEFT JOIN G17               ON Employee.id = G17.idEmployee
            LEFT JOIN HHM               ON Employee.id = HHM.idEmployee
            LEFT JOIN Cities ON Cities.idCity = PersonalData.idCity
            LEFT JOIN Role ON Role.idRole = Employee.idRole"; 

            $res = $this->getData($sql);
           
            $this->view->list = $res->emp;
            $this->view->cities = $res->cities;
          
            $birth_string = '';
            /* if(isset($res->birthday[0])){
                foreach($res->birthday as $birth){
                    $birth_string = $birth_string . " " . $birth->Name . " " . $birth->LastName . ";";
                }
                $account_sid = 'AC482c5a6a8403b82345ad633fdebf05bb';
                $auth_token = '928b8c3561ff5232af7aaea2dadfc18e';

                // In production, these should be environment variables. E.g.:
                //$auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
                // A Twilio number you own with SMS capabilities

                $twilio_number = "+19525294410";
                $client = new Client($account_sid, $auth_token);
                $client->messages->create(

                    // Where to send a text message (your cell phone?)
                    '+41792119207"',
                    array(
                        'from' => $twilio_number,
                        'body' => 'They are birthday today:' . " " .  $birth_string
                    )
                ); 
            } 
            */
            $this->view->generate('main_view.php', 'template_view.php');
        } else {
            header('Location: /HR/login');
        }
    }

    


    public function action_work()
    {
        ($_SESSION['employeePhotoSrc'] = null);      
            
        if (isset($_SESSION['loggedin'])) {

            if($_SESSION['cityID']!=null){

                $id = $_SESSION['cityID'];

                $sql = "SELECT * FROM Employee             
                JOIN PersonalData      ON Employee.id = PersonalData.idEmployee AND PersonalData.idCity = $id
                JOIN Career            ON Employee.id = Career.idEmployee AND Career.Status='Arbeitet'
                LEFT JOIN ForeignPassport   ON Employee.id = ForeignPassport.idEmployee			
                LEFT JOIN G17               ON Employee.id = G17.idEmployee
                LEFT JOIN HHM               ON Employee.id = HHM.idEmployee
                LEFT JOIN Cities ON Cities.idCity = PersonalData.idCity
                LEFT JOIN Role ON Role.idRole = Employee.idRole";
            }
            else{
                $sql = "SELECT * FROM Employee             
                LEFT JOIN PersonalData      ON Employee.id = PersonalData.idEmployee
                JOIN Career            ON Employee.id = Career.idEmployee AND Career.Status='Arbeitet'
                LEFT JOIN ForeignPassport   ON Employee.id = ForeignPassport.idEmployee			
                LEFT JOIN G17               ON Employee.id = G17.idEmployee
                LEFT JOIN HHM               ON Employee.id = HHM.idEmployee
                LEFT JOIN Cities ON Cities.idCity = PersonalData.idCity
                LEFT JOIN Role ON Role.idRole = Employee.idRole";            }
            


            $res = $this->getData($sql);
            
            $this->view->list = $res->emp;
            $this->view->cities = $res->cities;
            $this->view->generate('main_view.php', 'template_view.php');
        } else {
            header('Location: /HR/login');
        }
    }

    public function action_retired()
    {
        ($_SESSION['employeePhotoSrc'] = null);      
            
        if (isset($_SESSION['loggedin'])) {

            if($_SESSION['cityID']!=null){

                $id = $_SESSION['cityID'];


                $sql = "SELECT * FROM Employee             
                JOIN PersonalData      ON Employee.id = PersonalData.idEmployee AND PersonalData.idCity = $id
                JOIN Career            ON Employee.id = Career.idEmployee AND Career.Status='Ausgetreten'
                LEFT JOIN ForeignPassport   ON Employee.id = ForeignPassport.idEmployee			
                LEFT JOIN G17               ON Employee.id = G17.idEmployee
                LEFT JOIN HHM               ON Employee.id = HHM.idEmployee
                LEFT JOIN Cities ON Cities.idCity = PersonalData.idCity
                LEFT JOIN Role ON Role.idRole = Employee.idRole";
            }
            else{
                $sql = "SELECT * FROM Employee             
                LEFT JOIN PersonalData      ON Employee.id = PersonalData.idEmployee
                JOIN Career            ON Employee.id = Career.idEmployee AND Career.Status='Ausgetreten'
                LEFT JOIN ForeignPassport   ON Employee.id = ForeignPassport.idEmployee			
                LEFT JOIN G17               ON Employee.id = G17.idEmployee
                LEFT JOIN HHM               ON Employee.id = HHM.idEmployee
                LEFT JOIN Cities ON Cities.idCity = PersonalData.idCity
                LEFT JOIN Role ON Role.idRole = Employee.idRole";
            }

            $res = $this->getData($sql);
                        
            $this->view->list = $res->emp;
            $this->view->cities = $res->cities;
            $this->view->generate('main_view.php', 'template_view.php');
        } else {
            header('Location: /HR/login');
        }
    }

    public function action_maternity()
    {
        ($_SESSION['employeePhotoSrc'] = null);      
            
        if (isset($_SESSION['loggedin'])) {


            if($_SESSION['cityID']!=null){

                $id = $_SESSION['cityID'];

                $sql = "SELECT * FROM Employee             
                JOIN PersonalData      ON Employee.id = PersonalData.idEmployee AND PersonalData.idCity = $id
                JOIN Career            ON Employee.id = Career.idEmployee AND Career.Status='Mutterschlafsurlaub'
                LEFT JOIN ForeignPassport   ON Employee.id = ForeignPassport.idEmployee			
                LEFT JOIN G17               ON Employee.id = G17.idEmployee
                LEFT JOIN HHM               ON Employee.id = HHM.idEmployee
                LEFT JOIN Cities ON Cities.idCity = PersonalData.idCity
                LEFT JOIN Role ON Role.idRole = Employee.idRole";
            }
            else{
                $sql = "SELECT * FROM Employee             
                LEFT JOIN PersonalData      ON Employee.id = PersonalData.idEmployee
                JOIN Career            ON Employee.id = Career.idEmployee AND Career.Status='Mutterschlafsurlaub'
                LEFT JOIN ForeignPassport   ON Employee.id = ForeignPassport.idEmployee			
                LEFT JOIN G17               ON Employee.id = G17.idEmployee
                LEFT JOIN HHM               ON Employee.id = HHM.idEmployee
                LEFT JOIN Cities ON Cities.idCity = PersonalData.idCity
                LEFT JOIN Role ON Role.idRole = Employee.idRole";
            }

            $res = $this->getData($sql);
                        
            $this->view->list = $res->emp;
            $this->view->cities = $res->cities;
            $this->view->generate('main_view.php', 'template_view.php');
        } else {
            header('Location: /HR/login');
        }

    }

    public function action_all()
    {
        ($_SESSION['employeePhotoSrc'] = null);      
            
        if (isset($_SESSION['loggedin'])) {


            if($_SESSION['cityID']!=null){

                $id = $_SESSION['cityID'];

                $sql = "SELECT * FROM Employee             
                JOIN PersonalData      ON Employee.id = PersonalData.idEmployee AND PersonalData.idCity = $id
                LEFT JOIN Career            ON Employee.id = Career.idEmployee
                LEFT JOIN ForeignPassport   ON Employee.id = ForeignPassport.idEmployee			
                LEFT JOIN G17               ON Employee.id = G17.idEmployee
                LEFT JOIN HHM               ON Employee.id = HHM.idEmployee
                LEFT JOIN Cities ON Cities.idCity = PersonalData.idCity
                LEFT JOIN Role ON Role.idRole = Employee.idRole";
            }
            else{
                $sql = "SELECT * FROM Employee             
                LEFT JOIN PersonalData      ON Employee.id = PersonalData.idEmployee
                JOIN Career            ON Employee.id = Career.idEmployee AND Career.Status='Mutterschlafsurlaub'
                LEFT JOIN ForeignPassport   ON Employee.id = ForeignPassport.idEmployee			
                LEFT JOIN G17               ON Employee.id = G17.idEmployee
                LEFT JOIN HHM               ON Employee.id = HHM.idEmployee
                LEFT JOIN Cities ON Cities.idCity = PersonalData.idCity
                LEFT JOIN Role ON Role.idRole = Employee.idRole";
            }

            $res = $this->getData($sql);
                        
            $this->view->list = $res->emp;
            $this->view->cities = $res->cities;
            $this->view->generate('main_view.php', 'template_view.php');
        } else {
            header('Location: /HR/login');
        }

    }
    public function action_city()
    {
        ($_SESSION['employeePhotoSrc'] = null);      
        
        if (isset($_SESSION['loggedin'])) {
           /* echo ("<pre>");
        var_dump($_POST);
        echo ("<pre>");  */
            if(isset($_POST['cityID'])){

                $id = $_POST['cityID'];
                $_SESSION['cityID'] = $id;

                $sql = "SELECT * FROM Employee             
                JOIN PersonalData      ON Employee.id = PersonalData.idEmployee AND PersonalData.idCity = $id
                LEFT JOIN Career                 ON Employee.id = Career.idEmployee
                LEFT JOIN ForeignPassport   ON Employee.id = ForeignPassport.idEmployee			
                LEFT JOIN G17               ON Employee.id = G17.idEmployee
                LEFT JOIN HHM               ON Employee.id = HHM.idEmployee
                LEFT JOIN Cities ON Cities.idCity = PersonalData.idCity
                LEFT JOIN Role ON Role.idRole = Employee.idRole";
    
                $res = $this->getData($sql);
                            
                $this->view->list = $res->emp;
                $this->view->cities = $res->cities;
                $this->view->generate('main_view.php', 'template_view.php');
            }

            
        } else {
            header('Location: /HR/login');
        }

    }
    private function getData($sql){
        ($_SESSION['employeePhotoSrc'] = null);
        require_once "config.php";
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
            $cites = array();

            $sqlCity = "SELECT * FROM Cities";
            if($queryCites = $pdo->prepare($sqlCity)){
                if ($queryCites->execute()) {
                    while ($rowCity = $queryCites->fetch()) {
                        $city = new City;
                        $city->idCity = $rowCity['idCity'];
                        $city->titleCity = $rowCity['cityTitle'];
    
                        $cites[] = $city;
                    }
                }
    
            }

            if ($query = $pdo->prepare($sql)) {
                if ($query->execute()) {
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        /* echo("<pre>");
                        print_r ($row);
                        echo("</pre>"); */ 
                        $employee = new Employee;
                        $employee->Id = $row['id'];
                        $employee->Name = $row['Name'];
                        $employee->LastName = $row['LastName'];
                        $employee->Photo = strlen($row['Photo']) == 0 ? "/images/user.png" : "/HR/employeePhoto/employee_60/".$row['Photo'];
                        $employee->Role = $row['RoleTitle'];
                        //-----Personal Data
                        $employee->BirthDate = $row['BirthDate'];
                        $employee->CivilState = $row['CivilState'];
                        $employee->Address = $row['Address'];
                        $employee->PLZ = $row['PLZ'];
                        $employee->Place = $row['cityTitle'];
                        /* $PlaceID = $row['Place'];

                        foreach($cites as $city){
                            if($city->idCity == $PlaceID){
                                $employee->Place = $city->titleCity;
                                break;
                            }
                            else{
                                $employee->Place = "";
                            }
                        }
 */
                        $employee->Phone = $row['Phone'];

                        //-----Career
                        $employee->Position = $row['Position'];
                        $employee->StartDate = $row['CareerStart'];
                        $employee->Comment1 = $row['Comment1'];
                        $employee->Comment2 = $row['Comment2'];
                        $employee->Comment3 = $row['Comment3'];
                        $employee->Salary = $row['Salary'];
                        $employee->Status = $row['Status'];
                        $employee->Diplom_Photo = $row['PhotoDiplom'];
                        $employee->Productive = $row['Productive'];
                        $employee->OverTime = $row['OverTime'];
                        $employee->W_End = $row['W_End'];

                        //-----Passport
                        $employee->Pass_Name = $row['PassName'];
                        $employee->Pass_LastName = $row['PassLastName'];
                        $employee->Pass_Number = $row['Number'];
                        $employee->Pass_Expired = $row['Valid'];
                        $employee->Pass_Photo = $row['PhotoPassport'];

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
                        $empArray[] = $employee;
                    }
                }
            }
            //echo('<pre>');print_r($empArray);echo('<pre>');

        }

        $today_day = date("d");
        $today_month = date("m");
        
        $birth_emp = array();

        foreach($empArray as $emp){
            $birth_day = (explode("-", $emp->BirthDate))[2];
            $birth_month = (explode("-", $emp->BirthDate))[1];

            if($birth_day == $today_day && $birth_month == $today_month){
                $birth_emp[] = $emp;
            }
        }
//var_dump($birth_emp);

        $obj = new stdClass();
        $obj->emp = $empArray;
        $obj->cities = $cites;
        $obj->birthday = $birth_emp;
        return $obj;
    }

   
}
