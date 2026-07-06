$(document).on("click", ".viewForm", function () {

    let id = $(this).data("id");

    $.ajax({

        url: "ajax/get_form.php",

        type: "GET",

        data: {
            id: id
        },

        dataType: "json",

        success: function (data) {

            $("#vEmployee").text(data.full_name);
            $("#vForm").text(data.form_name);
            $("#vFrom").text(data.leave_from);
            $("#vTo").text(data.leave_to);
            $("#vStatus").text(data.status_name);
            $("#vReason").text(data.reason);
            $("#vRemarks").text(data.remarks);
            $("#vCreated").text(data.created_at);



    $.ajax({

        url: "ajax/get_history.php",

        type: "GET",

        data: {
            id: id
        },

        dataType: "json",

        success: function(history){

            let rows = "";

            history.forEach(function(item){

                rows += `
                    <tr>

                        <td>${item.full_name}</td>

                        <td>${item.old_status}</td>

                        <td>${item.new_status}</td>

                        <td>${item.remarks}</td>

                        <td>${item.action_date}</td>

                    </tr>
                `;

            });

            $("#historyTable tbody").html(rows);

        }

    });

            let modal = new bootstrap.Modal(
                document.getElementById("viewFormModal")
            );


            modal.show();

        },

        error: function () {

            alert("Unable to load form.");

        }

    });

});
