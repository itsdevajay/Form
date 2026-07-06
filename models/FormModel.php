<?php

require_once "BaseModel.php";

require_once "WorkflowModel.php";

class FormModel extends BaseModel
{
    public function getMyForms($userId)
    {
        $sql = "SELECT
                    f.id,
                    f.form_name,
                    s.status_name,
                    f.created_at
                FROM forms f
                JOIN status s
                    ON s.id = f.status_id
                WHERE f.created_by = :user_id
                ORDER BY f.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFormById($formId){
        $sql = "SELECT

                    f.id,
                    f.form_name,
                    f.created_at,
                    s.status_name,

                    u.full_name,

                    l.leave_from,
                    l.leave_to,
                    l.reason,

                    f.remarks

                FROM forms f

                JOIN users u
                    ON u.id = f.created_by

                JOIN leave_form l
                    ON l.form_id = f.id

                JOIN status s
                    ON s.id = f.status_id

                WHERE f.id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":id", $formId, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
        public function getTeamForms($managerId){
        $sql = "SELECT

                    f.id,
                    f.form_name,
                    u.full_name,
                    s.status_name,
                    f.created_at

                FROM forms f

                JOIN users u
                    ON u.id = f.created_by

                JOIN status s
                    ON s.id = f.status_id

                WHERE

                    f.manager_id = :manager_id

                    AND f.status_id = 2

                ORDER BY f.created_at DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":manager_id", $managerId, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function submitForm($formId, $roleId){
        // Employee -> Manager Pending
        if ($roleId == 1)
        {
            $status = 2;
        }
        // Manager -> Admin Pending
        else if ($roleId == 2)
        {
            $status = 3;
        }
        else
        {
            return false;
        }

        $sql = "UPDATE forms
                SET status_id = :status,
                    updated_at = NOW()
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":status", $status, PDO::PARAM_INT);
        $stmt->bindValue(":id", $formId, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function approveByManager($formId){
        $sql = "UPDATE forms
                SET status_id = 3,
                    updated_at = NOW()
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":id", $formId, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function rejectByManager($formId, $remark){
        $sql = "UPDATE forms
                SET status_id = 5,
                    remarks = :remark,
                    updated_at = NOW()
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":id", $formId, PDO::PARAM_INT);
        $stmt->bindValue(":remark", $remark);

        return $stmt->execute();
    }
    public function getStatusId($formId){
        $sql="SELECT status_id
              FROM forms
              WHERE id=:id";

        $stmt=$this->conn->prepare($sql);

        $stmt->bindValue(":id",$formId,PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn();
    }
    public function getAdminForms()
    {
        $sql = "SELECT

                    f.id,
                    f.form_name,
                    u.full_name,
                    s.status_name,
                    f.created_at

                FROM forms f

                JOIN users u
                    ON u.id = f.created_by

                JOIN status s
                    ON s.id = f.status_id

                WHERE f.status_id = 3

                ORDER BY f.created_at DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function changeStatus($formId, $newStatus, $actionBy, $remark = ""){
        try
        {
            $this->conn->beginTransaction();

            // Current Status
            $oldStatus = $this->getStatusId($formId);

            // Update Forms Table
            $sql = "UPDATE forms
                    SET status_id = :status,
                        remarks = :remark,
                        updated_at = NOW()
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(":status", $newStatus, PDO::PARAM_INT);
            $stmt->bindValue(":remark", $remark);
            $stmt->bindValue(":id", $formId, PDO::PARAM_INT);

            $stmt->execute();

            // Workflow History
            $workflow = new WorkflowModel();

            $workflow->addHistory(
                $formId,
                $actionBy,
                $oldStatus,
                $newStatus,
                $remark
            );

            $this->conn->commit();

            return true;
        }
        catch(Exception $e)
        {
            $this->conn->rollBack();

            return false;
        }
    }




}
