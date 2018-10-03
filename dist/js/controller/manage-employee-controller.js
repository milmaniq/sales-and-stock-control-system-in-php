//loading all the employees and the next employee id when the page loads
$(document).ready(function () {
    getEmployeeAndNextEmployeeId();
});

//deleting an employee
$(document).on("click", "#tblEmployee tbody tr td i", function () {
    var employeeId = $($(this).parents("tr").children("td")[0]).text();
    if (confirm("Are you sure you want to delete " + employeeId)) {
        var ajaxConfig = {
            method: "DELETE",
            url: "api/employees.php?employeeId=" + employeeId,
            async: true
        }

        $.ajax(ajaxConfig).done(function (response) {
            $("#btnClear").trigger("click");
        });
    }
});

//adding an employee
$("#btnAdd").on("click", function () {
    validateEmployeeInputs();

    setTimeout(function () {
        for (var a=1; a<4; a++){
            if ($($("#frmEmployee input[type='text']")[a]).css("border-color") === "rgb(255, 0, 0)") {
                return;
            }
        }


        if ($("#btnAdd").text() == "Save") {
            $("#frmEmployee input[type='hidden']").val("update");
        }
        else{
            $("#frmEmployee input[type='hidden']").val("insert");
        }

        var ajaxConfig = {
            method: "POST",
            url: "api/employees.php",
            data: $("#frmEmployee").serialize(),
            async: true
        }

        $.ajax(ajaxConfig).done(function (response) {
            $("#btnClear").trigger("click");
        })
    }, 200)
});

//selecting a row and taking the values in the table row to the text fields
$(document).on("click", "#tblEmployee tbody tr", function () {
    $("#txtEmployeeId").val($($(this).children("td")[0]).text());
    $("#txtName").val($($(this).children("td")[1]).text());
    $("#txtContact").val($($(this).children("td")[2]).text());
    $("#txtAddress").val($($(this).children("td")[3]).text());

    $("#btnAdd").text("Save");

    $("#tblEmployee tbody tr").removeClass("highlightTableRow");
    $(this).addClass("highlightTableRow")
});

//clearing all the fields in order to add a new item
$("#btnClear").on("click", function () {
    $("#txtName").val("");
    $("#txtContact").val("");
    $("#txtAddress").val("");

    $("#btnAdd").text("Add");

    $("#tblEmployee tbody tr").removeClass("highlightTableRow");

    getEmployeeAndNextEmployeeId();

});

function validateEmployeeInputs() {
    if ($("#txtAddress").val().length == 0) {
        $("#txtAddress").css("border-color", "red");
        $("#txtAddress").select();
    }
    else {
        $("#txtAddress").css("border-color", "rgb(206, 212, 218)");
    }

    if ($("#txtContact").val().length == 0) {
        $("#txtContact").css("border-color", "red");
        $("#txtContact").select();
    }
    else {
        $("#txtContact").css("border-color", "rgb(206, 212, 218)");
    }

    if ($("#txtName").val().length == 0) {
        $("#txtName").css("border-color", "red");
        $("#txtName").select();
    }
    else {
        $("#txtName").css("border-color", "rgb(206, 212, 218)");
    }
}

function getEmployeeAndNextEmployeeId() {
    var ajaxConfig = {
        method: "GET",
        url: "api/employees.php",
        data: {
            action: "getAll"
        },
        async: true
    }

    $.ajax(ajaxConfig).done(function (response) {

        $("#tblEmployee tbody tr").remove();

        response.forEach(function (employee) {

            $("#tblEmployee tbody").append("<tr><td>" + employee.employeeId + "</td><td>" + employee.name
                + "</td><td>" + employee.contact + "</td><td>" + employee.address
                + "</td><td><i class='fas fa-trash'></i></td></tr>");

        });


        if ($("#tblEmployee tbody tr").length > 0) {
            var lastEmployeeId = $($("#tblEmployee tbody tr").last().children("td")[0]).text();
            var numOfLastEmployeeId = parseInt(lastEmployeeId.match(/\d+/)[0]);
            var newEmployeeId = "E" + (numOfLastEmployeeId + 1);
            $("#txtEmployeeId").val(newEmployeeId);

            $("#tblEmployee tfoot tr").css("display", "none");

        }
        else {
            var newEmployeeId = "E1";
            $("#txtEmployeeId").val(newEmployeeId);

            $("#tblEmployee tfoot tr").css("display", "table-row");
        }


    });
}