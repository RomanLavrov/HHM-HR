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
            $sickArray = $dataArray[$i];

            if (isset($sickArray['Start' . ($i + 2)])) {
                $StartDate = $sickArray['Start' . ($i + 2)];
                $EndDate   = $sickArray['End' . ($i + 2)];

                $this->model->Insert($idEmployee, $StartDate, $EndDate, $TableName);
            }
        }

        header('location: /HR/sicklist');
    }
}
