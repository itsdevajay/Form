$(document).on("click", ".adminApprove", function () {

    if (!confirm("Approve this form?")) {
        return;
    }

    let id = $(this).data("id");

    $.ajax({

        url: "ajax/admin_approve.php",

        type: "POST",

        data: {
            id: id
        },

        dataType: "json",

        success: function (response) {

            alert(response.message);

            if (response.success) {
                formTable.ajax.reload(null, false);
            }

        },

        error: function () {

            alert("Server Error");

        }

    });

});
