<?php

require_once __DIR__ . "/../models/LeaveModel.php";
require_once __DIR__ . "/../models/UserModel.php";

class LeaveController
{
    public function save($postData, $sessionUser)
    {
        $userModel = new UserModel();

        // Logged-in user ki complete details nikalo
        $user = $userModel->getUserById($sessionUser['id']);

        if (!$user) {
            return [
                "success" => false,
                "message" => "User not found."
            ];
        }

        $data = [
            "created_by" => $user['id'],
            "manager_id" => $user['manager_id'],
            "leave_from" => $postData['leave_from'],
            "leave_to"   => $postData['leave_to'],
            "reason"     => $postData['reason']
        ];

        $leaveModel = new LeaveModel();

        if ($leaveModel->saveLeave($data)) {
            return [
                "success" => true,
                "message" => "Leave form submitted successfully."
            ];
        }

        return [
            "success" => false,
            "message" => "Unable to save leave form."
        ];
    }
}
