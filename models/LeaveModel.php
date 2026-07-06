<?php

require_once "BaseModel.php";

class LeaveModel extends BaseModel
{
    public function saveLeave($data)
    {
        try {

            $this->conn->beginTransaction();

            // Insert into forms
            $sql = "INSERT INTO forms
                    (form_name, created_by, manager_id, status_id)
                    VALUES
                    (:form_name, :created_by, :manager_id, :status_id)
                    RETURNING id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':form_name'  => 'Leave',
                ':created_by' => $data['created_by'],
                ':manager_id' => $data['manager_id'],
                ':status_id'  => 1
            ]);

            $formId = $stmt->fetchColumn();

            // Insert into leave_form
            $sql = "INSERT INTO leave_form
                    (form_id, leave_from, leave_to, reason)
                    VALUES
                    (:form_id, :leave_from, :leave_to, :reason)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':form_id'    => $formId,
                ':leave_from' => $data['leave_from'],
                ':leave_to'   => $data['leave_to'],
                ':reason'     => $data['reason']
            ]);

            $this->conn->commit();

            return true;

        } catch (Exception $e) {

            $this->conn->rollBack();

            return false;
        }
    }
}
