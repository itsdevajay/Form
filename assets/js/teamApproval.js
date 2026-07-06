$(document).on("click", ".approveForm", function () {

    let id = $(this).data("id");

    if (!confirm("Approve this form?")) {
        return;
    }

    $.ajax({

        url: "ajax/approve_form.php",

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


$(document).on("click",".rejectForm",function(){

    let id=$(this).data("id");

    $("#rejectFormId").val(id);

    $("#rejectRemark").val("");

    let modal=new bootstrap.Modal(
        document.getElementById("rejectModal")
    );

    modal.show();

});

$("#confirmReject").click(function () {

    let id = $("#rejectFormId").val();

    let remark = $("#rejectRemark").val().trim();

    if (remark == "") {
        alert("Please enter a remark.");
        return;
    }

    $.ajax({

        url: "ajax/reject_form.php",

        type: "POST",

        data: {
            id: id,
            remark: remark
        },

        dataType: "json",

        success: function (response) {

            alert(response.message);

            if (response.success) {

                bootstrap.Modal.getInstance(
                    document.getElementById("rejectModal")
                ).hide();

                formTable.ajax.reload(null, false);

            }

        },

        error: function () {

            alert("Server Error");

        }

    });

});
