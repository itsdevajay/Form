<?php

session_start();

if(!isset($_SESSION['user']))
{
    header("Location:index.php");
    exit;
}

$user=$_SESSION['user'];

?>
<!DOCTYPE html>

<html>

<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
</head>

<body>

<div class="container mt-4">

    <h2>Welcome <?= $user['full_name']; ?></h2>

    <h5>Role : <?= $user['role_name']; ?></h5>

    <a href="logout.php" class="btn btn-danger mb-3">
        Logout
    </a>

    <hr>

    <ul class="nav nav-tabs">

    <?php if($user['role_name']=="Employee"){ ?>

        <li class="nav-item">
            <a class="nav-link active"
               href="#"
               data-tab="my_forms">
                My Forms
            </a>
        </li>

    <?php } ?>


    <?php if($user['role_name']=="Manager"){ ?>

        <li class="nav-item">
            <a class="nav-link active"
               href="#"
               data-tab="my_forms">
                My Forms
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link"
               href="#"
               data-tab="team_approval">
                Team Approval
            </a>
        </li>

    <?php } ?>


    <?php if($user['role_name']=="Admin"){ ?>

        <li class="nav-item">
            <a class="nav-link active"
               href="#"
               data-tab="admin_approval">
                Pending Approval
            </a>
        </li>

    <?php } ?>

    </ul>
    <div class="d-flex justify-content-between mb-3">

    <h4>My Forms</h4>

    <button
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#leaveModal">

        + New Leave Form

    </button>

    </div>
        <table id="formTable" class="table table-bordered table-striped" width="100%">

            <thead id="tableHead">

                <tr>

                    <th>ID</th>
                    <th>Form</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

            </tbody>

        </table>
    </div>
</div>
<div class="modal fade" id="leaveModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Leave Form</h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <form id="leaveForm">

                    <div class="mb-3">

                        <label>Leave From</label>

                        <input
                            type="date"
                            class="form-control"
                            name="leave_from"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Leave To</label>

                        <input
                            type="date"
                            class="form-control"
                            name="leave_to"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Reason</label>

                        <textarea
                            class="form-control"
                            name="reason"
                            rows="3"
                            required></textarea>

                    </div>

                </form>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Close

                </button>

                <button
                    class="btn btn-success"
                    id="saveLeave">

                    Save

                </button>

            </div>

        </div>

    </div>

</div>


<div class="modal fade" id="viewModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Leave Details</h5>

                <button class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <table class="table table-bordered">

                    <tr>
                        <th>Form</th>
                        <td id="v_form_name"></td>
                    </tr>

                    <tr>
                        <th>Leave From</th>
                        <td id="v_leave_from"></td>
                    </tr>

                    <tr>
                        <th>Leave To</th>
                        <td id="v_leave_to"></td>
                    </tr>

                    <tr>
                        <th>Reason</th>
                        <td id="v_reason"></td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td id="v_status"></td>
                    </tr>

                    <tr>
                        <th>Remarks</th>
                        <td id="v_remarks"></td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="rejectModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Reject Form</h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <input type="hidden" id="rejectFormId">

                <label>Remark</label>

                <textarea class="form-control"
                          id="rejectRemark"
                          rows="4"
                          placeholder="Enter rejection remark"></textarea>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <button class="btn btn-danger"
                        id="confirmReject">
                    Reject
                </button>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="viewFormModal" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Leave Form Details</h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <table class="table table-bordered">

                    <tr>
                        <th width="30%">Employee</th>
                        <td id="vEmployee"></td>
                    </tr>

                    <tr>
                        <th>Form</th>
                        <td id="vForm"></td>
                    </tr>

                    <tr>
                        <th>Leave From</th>
                        <td id="vFrom"></td>
                    </tr>

                    <tr>
                        <th>Leave To</th>
                        <td id="vTo"></td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td id="vStatus"></td>
                    </tr>

                    <tr>
                        <th>Reason</th>
                        <td id="vReason"></td>
                    </tr>

                    <tr>
                        <th>Remarks</th>
                        <td id="vRemarks"></td>
                    </tr>

                    <tr>
                        <th>Created At</th>
                        <td id="vCreated"></td>
                    </tr>

                </table>
                <hr>

                <h5>Workflow History</h5>

                <table class="table table-bordered" id="historyTable">

                    <thead>

                        <tr>

                            <th>User</th>
                            <th>From Status</th>
                            <th>To Status</th>
                            <th>Remarks</th>
                            <th>Date</th>

                        </tr>

                    </thead>

                    <tbody>

                    </tbody>

                </table>
            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    Close

                </button>

            </div>

        </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

<script src="assets/js/dashboard.js"></script>

<script src="assets/js/leave.js"></script>

<script src="assets/js/teamApproval.js"></script>

<script src="assets/js/viewForm.js"></script>

<script src="assets/js/submitForm.js"></script>

<script src="assets/js/adminApproval.js"></script>
</body>

</html>
