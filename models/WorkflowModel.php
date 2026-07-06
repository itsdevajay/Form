<?php

require_once "BaseModel.php";

class WorkflowModel extends BaseModel
{
    public function addHistory($formId, $actionBy, $oldStatus, $newStatus, $remarks)
    {
        $sql = "INSERT INTO workflow_history
                (
                    form_id,
                    action_by,
                    old_status,
                    new_status,
                    remarks
                )
                VALUES
                (
                    :form_id,
                    :action_by,
                    :old_status,
                    :new_status,
                    :remarks
                )";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":form_id", $formId, PDO::PARAM_INT);
        $stmt->bindValue(":action_by", $actionBy, PDO::PARAM_INT);
        $stmt->bindValue(":old_status", $oldStatus, PDO::PARAM_INT);
        $stmt->bindValue(":new_status", $newStatus, PDO::PARAM_INT);
        $stmt->bindValue(":remarks", $remarks);

        return $stmt->execute();
    }

    public function getHistory($formId){
        $sql = "SELECT

                    wh.id,
                    u.full_name,
                    s1.status_name AS old_status,
                    s2.status_name AS new_status,
                    wh.remarks,
                    wh.action_date

                FROM workflow_history wh

                JOIN users u
                    ON u.id = wh.action_by

                JOIN status s1
                    ON s1.id = wh.old_status

                JOIN status s2
                    ON s2.id = wh.new_status

                WHERE wh.form_id = :form_id

                ORDER BY wh.action_date ASC";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":form_id", $formId, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
