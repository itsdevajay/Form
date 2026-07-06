let formTable;

$(document).ready(function () {

    let activeTab = $(".nav-link.active").data("tab");

    switch (activeTab) {

        case "my_forms":
            loadMyForms();
            break;

        case "team_approval":
            loadTeamForms();
            break;

        case "admin_approval":
            loadAdminForms();
            break;
    }

});


$(".nav-link").click(function (e) {

    e.preventDefault();

    $(".nav-link").removeClass("active");

    $(this).addClass("active");

    let tab = $(this).data("tab");

    switch (tab) {

        case "my_forms":
            loadMyForms();
            break;

        case "team_approval":
            loadTeamForms();
            break;

        case "admin_approval":
            loadAdminForms();
            break;
    }

});


function loadTable(headers, columns, ajaxUrl)
{

    $("#tableHead").html(headers);

    if ($.fn.DataTable.isDataTable("#formTable")) {

        formTable.destroy();

    }

    $("#formTable tbody").empty();

    formTable = $("#formTable").DataTable({

        destroy: true,

        ajax: {

            url: ajaxUrl,

            dataSrc: "data"

        },

        columns: columns,

        pageLength: 10,

        responsive: true

    });

}


function loadMyForms()
{

    loadTable(

        `
        <tr>
            <th>ID</th>
            <th>Form</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        `,

        [

            { data: "id" },
            { data: "form_name" },
            { data: "status_name" },
            { data: "created_at" },
            { data: "action" }

        ],

        "ajax/load_forms.php"

    );

}


function loadTeamForms()
{

    loadTable(

        `
        <tr>
            <th>ID</th>
            <th>Form</th>
            <th>Employee</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        `,

        [

            { data: "id" },
            { data: "form_name" },
            { data: "full_name" },
            { data: "status_name" },
            { data: "created_at" },
            { data: "action" }

        ],

        "ajax/load_team_forms.php"

    );

}


function loadAdminForms()
{

    loadTable(

        `
        <tr>
            <th>ID</th>
            <th>Form</th>
            <th>Employee</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        `,

        [

            { data: "id" },
            { data: "form_name" },
            { data: "full_name" },
            { data: "status_name" },
            { data: "created_at" },
            { data: "action" }

        ],

        "ajax/load_admin_forms.php"

    );

}
