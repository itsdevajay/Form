$(document).ready(function () {

    $("#saveLeave").click(function () {

        $.ajax({

            url: "ajax/save_leave.php",
            type: "POST",
            data: $("#leaveForm").serialize(),
            dataType: "json",

            success: function (response) {

                if (response.success) {

                    alert(response.message);

                    $("#leaveForm")[0].reset();

                    const modal = bootstrap.Modal.getInstance(
                        document.getElementById("leaveModal")
                    );

                    if (modal) {
                        modal.hide();
                    }

                    formTable.ajax.reload(null, false);

                } else {

                    alert(response.message);

                }

            },

            error: function () {

                alert("Server Error");

            }

        });

    });

});
