<?php

require_once "../models/FormModel.php";

class FormController{

    public function getMyForms($userId){
        $model = new FormModel();
        return $model->getMyForms($userId);
    }
    public function getTeamForms($managerId){
        $model=new FormModel();

        return $model->getTeamForms($managerId);
    }

    public function getFormById($id){
        $model = new FormModel();

        return $model->getFormById($id);
    }
    public function submitForm($id, $roleId){
        $model = new FormModel();

        return $model->submitForm($id, $roleId);
    }

    public function approveByManager($id){
        $model = new FormModel();

        return $model->approveByManager($id);
    }
    public function rejectByManager($id, $remark){
        $model = new FormModel();

        return $model->rejectByManager($id, $remark);
    }
    public function getAdminForms(){
        $model = new FormModel();

        return $model->getAdminForms();
    }
    public function changeStatus($formId, $newStatus, $actionBy, $remark = ""){
        $model = new FormModel();

        return $model->changeStatus(
            $formId,
            $newStatus,
            $actionBy,
            $remark
        );
    }


}
