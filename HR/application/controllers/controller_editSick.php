<?php
include "application\models\model_sicklist.php";

class Controller_EditSick extends Controller
{

    public function action_index()
    {
        $this->model = new SickList_Model;
        $this->model->model_test();
    }
}
