$(document).on("click", ".submitForm", function () {

    let id = $(this).data("id");

    if (!confirm("Submit this form?")) {
        return;
    }

    $.ajax({

        url: "ajax/submit_form.php",

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
