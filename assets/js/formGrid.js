$(document).ready(function(){

    $("#formGrid").jqGrid({

        datatype: "local",

        data: [],

        colModel: [

            {
                name: "id",
                label: "ID",
                width: 60
            },

            {
                name: "form_name",
                label: "Form",
                width: 150
            },

            {
                name: "status",
                label: "Status",
                width: 120
            }

        ],

        viewrecords: true,

        width: 900,

        height: 350,

        rowNum: 10,

        pager: "#formPager"

    });

});
