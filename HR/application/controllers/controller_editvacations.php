<?php
include "application\models\model_sicklist.php";

class Controller_Editvacations extends Controller
{
    public function action_index()
    {
        //print_r (array_chunk($_POST, 3, true));
        $dataArray = (array_chunk($_POST, 2, true));
        $idEmployee = $_POST['Id'];
        $TableName = "`Vacations`";

        $this->model = new SickList_Model;
        $this->model->Delete($idEmployee, $TableName);

        for ($i = 0; $i < sizeof($dataArray); $i++) {
            //print_r($dataArray[$i]);
            $vacArray = $dataArray[$i];

            if (isset($vacArray['Start' . ($i + 2)])) {
                $StartDate = $vacArray['Start' . ($i + 2)];
                $EndDate   = $vacArray['End' . ($i + 2)];

                $this->model->Insert($idEmployee, $StartDate, $EndDate, $TableName);
            }            
        }

        header('location: /HR/vacations');
    }
}
