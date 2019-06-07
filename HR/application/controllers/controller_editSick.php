<?php
include "application\models\model_sicklist.php";

class Controller_EditSick extends Controller
{
    public function action_index()
    {
        //print_r(array_chunk($_POST, 2, true));
        $dataArray  = (array_chunk($_POST, 2, true));
        $idEmployee = $_POST['Id'];
        $TableName  = "`SickList`";

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
                $StartDate = (new DateTime($start))->format("Y-m-d");
                $EndDate   = (new DateTime($end))->format("Y-m-d");

                $this->model->Insert($idEmployee, $StartDate, $EndDate, $TableName);
                //echo ("<br>inserted");
            }
        }

        header('location: /HR/sicklist');
    }
}
