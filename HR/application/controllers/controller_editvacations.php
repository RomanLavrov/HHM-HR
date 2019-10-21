<?php
include "application/models/model_sicklist.php";

class Controller_Editvacations extends Controller
{
    public function action_index()
    {
        echo("<pre>");
        print_r (array_chunk($_POST, 2, true));
        echo("</pre>");

        $dataArray  = (array_chunk($_POST, 2, true));
        $idEmployee = $_POST['Id'];
        $duration = $_POST['Duration'];
        $TableName  = "`Vacations`";

        $this->model = new SickList_Model;
        $this->model->Delete($idEmployee, $TableName);

        for ($i = 0; $i < sizeof($dataArray); $i++) {
            //print_r($dataArray[$i]);
            $vacArray = $dataArray[$i];

            if (sizeof($vacArray) == 2) {

                $start = $end = null;
                foreach ($vacArray as $key => $value) {
                    //echo($key);
                    if (strpos($key, 'Start')!==false) {
                        $start = $value;
                    }
                    if (strpos($key, "End")!==false) {
                        $end = $value;
                    }

                }
                if (isset($start) && isset($end)){
                    $StartDate = (new DateTime($start))->format("Y-m-d");
                    $EndDate   = (new DateTime($end))->format("Y-m-d");
                }
                else{
                    $StartDate = NULL;
                    $EndDate = NULL;
                }
               
                $Duration=$duration;

                $this->model->Insert($idEmployee, $StartDate, $EndDate, $Duration, $TableName);
                //echo ("<br>inserted");
            }
        }
        
        //header('location: /HR/vacations');             
    }
}
