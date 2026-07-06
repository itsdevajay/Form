<?php

require_once __DIR__."/../models/WorkflowModel.php";

class WorkflowController{
    public function addHistory($formId,$actionBy,$oldStatus,$newStatus,$remarks){
        $model=new WorkflowModel();

        return $model->addHistory(
            $formId,
            $actionBy,
            $oldStatus,
            $newStatus,
            $remarks
        );
    }

    public function getHistory($formId){
        $model = new WorkflowModel();

        return $model->getHistory($formId);
    }



}
