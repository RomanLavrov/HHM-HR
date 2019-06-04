<?php
include "application/models/Child.php";
include "application/models/SwissVisit.php";

class Controller_Update extends Controller
{
    public function action_index()
    {
        require_once "config.php";
        $user_photo = "image/user.png";       

        if (isset($_POST['Name'])) {
            $id= $_POST['id'];
            $Name = $_POST['Name'];
            $LastName = $_POST["LastName"];
            $Photo = $_POST["Photo"];

            $BirthDate = $_POST["BirthDate"];
            $CivilState = $_POST["CivilState"];
            $Address = $_POST["Address"];
            $PLZ = $_POST["PLZ"];
            $Place = $_POST["Place"];
            $Phone = $_POST["Phone"];

            $Pass_Name = $_POST["Pass_Name"];
            $Pass_LastName = $_POST["Pass_LastName"];
            $Pass_Number = $_POST["Pass_Number"];
            $Pass_Expired = $_POST["Pass_Expired"];

            $CareerStart = $_POST["CareerStart"];
            $Position = $_POST["Position"];
            $Comment = $_POST["Comment"];
            $Salary = $_POST["Salary"];

            $G17_email = $_POST["G17_email"];
            $G17_initials = $_POST["G17_initials"];

            $HHM_email = $_POST["HHM_email"];
            $HHM_initials = $_POST["HHM_initials"];

            $ChildName1 = $_POST["ChildName1"];
            $ChildLastName1 = $_POST["ChildLastName1"];
            $ChildBirthday1 = $_POST["ChildBirthday1"];

            $ChildName2 = $_POST["ChildName2"];
            $ChildLastName2 = $_POST["ChildLastName2"];
            $ChildBirthday2 = $_POST["ChildBirthday2"];

            $ChildName3 = $_POST["ChildName3"];
            $ChildLastName3 = $_POST["ChildLastName3"];
            $ChildBirthday3 = $_POST["ChildBirthday3"];

            $VisitStart = $_POST["VisitStart"];
            $VisitEnd = $_POST["VisitEnd"];
            $VisitLocation = $_POST["VisitLocation"];
            $VisitAccommodation = $_POST["VisitAccommodation"];
            $VisitGoal = $_POST["VisitGoal"];
            $VisitGroup = $_POST["VisitGroup"];
        }

        $childArray = array();


        $sqlChildren = "SELECT * FROM Children where Children.idEmployee = $id";
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

        $visitArray = array();

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

        $sql = "START TRANSACTION;
        UPDATE `hhmeweme_HR`.`Employee` SET `Name`= :Name, `LastName` = :LastName, `Photo`=:Photo WHERE `id` =:id;
        UPDATE `hhmeweme_HR`.`PersonalData` SET `BirthDate`= :BirthDate, `CivilState`=:CivilState , `Address`=:Address , `PLZ`= :PLZ, `Place` = :Place, `Phone`= :Phone WHERE `idEmployee` =:id ;
        UPDATE `hhmeweme_HR`.`Career` SET `Position`=:Position, `Comment`=:Comment, `StartDate` = :CareerStart, `Salary` = :Salary WHERE `idEmployee` =:id;
        UPDATE `hhmeweme_HR`.`ForeignPassport` SET `PassName`=:Pass_Name, `PassLastName` = :Pass_LastName, `Number`=:Pass_Number, `Valid`=:Pass_Expired WHERE `idEmployee`=:id;
        UPDATE `hhmeweme_HR`.`G17` SET `G17_E-Mail`=:G17_email, `G17_initials`=:G17_initials WHERE `idEmployee`=:id;
        UPDATE `hhmeweme_HR`.`HHM` SET `HHM_E-Mail`=:HHM_email,  `HHM_initials`=:HHM_initials WHERE `idEmployee`=:id;
        UPDATE `hhmeweme_HR`.`Children` SET `ChildName`=:ChildName1, `ChildLastName`=:ChildLastName1, `Birth`=:ChildBirthday1 WHERE `idEmployee`=:id and `idChildren`=:idChild1;
        UPDATE `hhmeweme_HR`.`Children` SET `ChildName`=:ChildName2, `ChildLastName`=:ChildLastName2, `Birth`=:ChildBirthday2 WHERE `idEmployee`=:id and `idChildren`=:idChild2;
        UPDATE `hhmeweme_HR`.`Children` SET `ChildName`=:ChildName3, `ChildLastName`=:ChildLastName3, `Birth`=:ChildBirthday3 WHERE `idEmployee`=:id and `idChildren`=:idChild3;
        UPDATE `hhmeweme_HR`.`SwissVisit` SET `StartDate`=:StartDate, `EndDate`=:EndDate, `Location`=:Location, `Accommodation`=:Accommodation, `Goal`=:Goal, `Group`=:Group;
        COMMIT;";

        $query = $pdo->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_STR);
        $query->bindParam(":Name", $Name, PDO::PARAM_STR);
        $query->bindParam(":LastName", $LastName, PDO::PARAM_STR);
        $query->bindParam(":Photo", $Photo, PDO::PARAM_STR);

        //$query->bindParam(":idEmployeePersonal", $id, PDO::PARAM_STR);
        $query->bindParam(":BirthDate", $BirthDate, PDO::PARAM_STR);
        $query->bindParam(":CivilState", $CivilState, PDO::PARAM_STR);
        $query->bindParam(":Address", $Address, PDO::PARAM_STR);
        $query->bindParam(":PLZ", $PLZ, PDO::PARAM_STR);
        $query->bindParam(":Place", $Place, PDO::PARAM_STR);
        $query->bindParam(":Phone", $Phone, PDO::PARAM_STR);

        $query->bindParam(":Position", $Position, PDO::PARAM_STR);
        $query->bindParam(":Comment", $Comment, PDO::PARAM_STR);
        $query->bindParam(":CareerStart", $CareerStart, PDO::PARAM_STR);
        $query->bindParam(":Salary", $Salary, PDO::PARAM_STR);

        $query->bindParam(":Pass_Name", $Pass_Name, PDO::PARAM_STR);
        $query->bindParam(":Pass_LastName", $Pass_LastName, PDO::PARAM_STR);
        $query->bindParam(":Pass_Number", $Pass_Number, PDO::PARAM_STR);
        $query->bindParam(":Pass_Expired", $Pass_Expired, PDO::PARAM_STR);

        $query->bindParam(":G17_email", $G17_email, PDO::PARAM_STR);
        $query->bindParam(":G17_initials", $G17_initials, PDO::PARAM_STR);

        $query->bindParam(":HHM_email", $HHM_email, PDO::PARAM_STR);
        $query->bindParam(":HHM_initials", $HHM_initials, PDO::PARAM_STR);

        
        $query->bindParam(":ChildName1", $ChildName1, PDO::PARAM_STR);
        $query->bindParam(":ChildLastName1", $ChildLastName1, PDO::PARAM_STR);
        $query->bindParam(":ChildBirthday1", $ChildBirthday1, PDO::PARAM_STR);
        $query->bindParam(":idChild1", $childArray[0]->idChild, PDO::PARAM_STR);

        $query->bindParam(":ChildName2", $ChildName2, PDO::PARAM_STR);
        $query->bindParam(":ChildLastName2", $ChildLastName2, PDO::PARAM_STR);
        $query->bindParam(":ChildBirthday2", $ChildBirthday2, PDO::PARAM_STR);
        $query->bindParam(":idChild2", $childArray[1]->idChild, PDO::PARAM_STR);

        $query->bindParam(":ChildName3", $ChildName3, PDO::PARAM_STR);
        $query->bindParam(":ChildLastName3", $ChildLastName3, PDO::PARAM_STR);
        $query->bindParam(":ChildBirthday3", $ChildBirthday3, PDO::PARAM_STR);
        $query->bindParam(":idChild3", $childArray[2]->idChild, PDO::PARAM_STR);

        $query->bindParam(":idVisit", $id, PDO::PARAM_STR);            
        $query->bindParam(":StartDate", $VisitStart, PDO::PARAM_STR);
        $query->bindParam(":EndDate", $VisitEnd, PDO::PARAM_STR);
        $query->bindParam(":Location", $VisitLocation, PDO::PARAM_STR);
        $query->bindParam(":Accommodation", $VisitAccommodation, PDO::PARAM_STR);
        $query->bindParam(":Goal", $VisitGoal, PDO::PARAM_STR);
        $query->bindParam(":Group", $VisitGroup, PDO::PARAM_STR);
        

        if ($query->execute()) {
           echo($id);
           echo($Name);
           echo($Photo);
            header('location: /HR/main');
        } else {
            echo ("Error");
        }
    }
}
