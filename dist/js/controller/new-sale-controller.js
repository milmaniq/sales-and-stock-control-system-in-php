//defining a variable to store the weight of a selected item
var weight = 0.0;

//getting the next sale id when the document loads
$(document).ready(getNextSaleId);

//loading all the employee ids of employees to the employee id datalist
$(document).ready(function () {
    var ajaxConfig = {
        method: "GET",
        url: "api/employees.php",
        data: {
            action: "getAll"
        },
        async: true
    }

    $.ajax(ajaxConfig).done(function (response) {
        response.forEach(function (employee) {
            $("#dlEmployeeId").append("<option>" + employee.employeeId + "</option>");
        })
    })
});

//loading all the item ids of the available items to the item id datalist
$(document).ready(function () {
    var ajaxConfig = {
        method: "GET",
        url: "api/stocks.php",
        data: {
            action: "getAllAvailable"
        },
        async: true
    }

    $.ajax(ajaxConfig).done(function (response) {
        response.forEach(function (item) {
            $("#dlItemId").append("<option>" + item.itemId + "</option>");
        })
    })
});

//adding a new item to the saleItem table
$("#btnAdd").on("click", function () {
    validateSaleItemInputs();

    setTimeout(function () {
        if (($("#nbrPrice").css("border-color") === "rgb(255, 0, 0)") | ($("#txtDescription").css("border-color") === "rgb(255, 0, 0)") | ($("#txtItemId").css("border-color") === "rgb(255, 0, 0)")) {
            return;
        }

        var ajaxConfig = {
            method: "GET",
            url: "api/stocks.php",
            data: {
                action: "get",
                itemId: $("#txtItemId").val()
            },
            async: true
        }

        $.ajax(ajaxConfig).done(function (response) {
            weight = response.weight;
        });

        setTimeout(function () {
            $("#tblSaleItem tbody").append("<tr><td>" + $("#txtItemId").val() + "</td><td>" + $("#txtDescription").val()
                + "</td><td>" + weight + "</td><td>" + $("#nbrPrice").val() + "</td><td><i class='fas fa-trash'></i></td></tr>");


            for (var a = 0; a < $("#dlItemId option").length; a++) {
                if ($($("#dlItemId option")[a]).text() == $("#txtItemId").val()) {
                    $($("#dlItemId option")[a]).remove();
                }
            }

            if ($("#tblSaleItem tbody tr").length > 0){
                $("#tblSaleItem tfoot tr").css("display", "none");
            }

            calculateTotal();
            clearSaleItemFields();
        }, 200);

    }, 200);

});


//removing an item from the sale item table by clicking on the trash icon
$(document).on("click", "#tblSaleItem tbody tr td:last-child", function () {
    var itemId = $($(this).parent().children("td")[0]).text();

    $("#dlItemId").append("<option>" + itemId + "</option>");

    $(this).parent().remove();

    calculateTotal();

    if ($("#tblSaleItem tbody tr").length == 0){
        $("#tblSaleItem tfoot tr").css("display", "table-row");
    }
});


//inserting a sale record to the database by clicking on the make sale button
$("#btnMakeSale").on("click", function () {
    validateSaleInputs();

    setTimeout(function () {
        for (var a=2; a<5; a++){
            if (($($("input[type='text']")[a]).css("border-color") === "rgb(255, 0, 0)")) {
                return;
            }
        }

        if (($($("input[type='number']")[0]).css("border-color") === "rgb(255, 0, 0)")) {
            return;
        }

        var arrSaleItem = [];

        for (var a=0; a<$("#tblSaleItem tbody tr").length; a++){
            var objSaleItem = {
                itemId: $($($("#tblSaleItem tbody tr")[a]).children("td")[0]).text(),
                description: $($($("#tblSaleItem tbody tr")[a]).children("td")[1]).text(),
                weight: $($($("#tblSaleItem tbody tr")[a]).children("td")[2]).text(),
                price: $($($("#tblSaleItem tbody tr")[a]).children("td")[3]).text()
            }

            arrSaleItem.push(objSaleItem);
        }

        var ajaxConfig = {
            method: "POST",
            url: "api/sales.php",
            //http://localhost/customers.php?courses[]=c001&courses[]=c002
            //$_GET[courses]
            data: $("#frmSale").serialize() + "&tblSaleItem=" + JSON.stringify(arrSaleItem),
            async: true
        }

        $.ajax(ajaxConfig).done(function (response) {
            console.log(response);
        });

        setTimeout(function () {
            clearSaleFields();
            clearSaleItemFields();
            $("#tblSaleItem tbody tr td:last-child").trigger("click");
            getNextSaleId();
        }, 200);
    }, 200);
})


//defining a function to get the next sale id
function getNextSaleId() {

    var ajaxConfig = {
        method: "GET",
        url: "api/sales.php",
        data: {
            action: "getAll"
        },
        async: true
    }

    $.ajax(ajaxConfig).done(function (response) {

        $("#txtSalesId").val("S" + (response.length + 1));
    })
}


//defining a function to calculate the total
function calculateTotal() {
    var total=0.0;
    for (var a=0; a<$("#tblSaleItem tbody tr").length; a++){
        total += Number($($($("#tblSaleItem tbody tr")[a]).children("td")[3]).text());
    }
    $("#nbrTotal").val(total);
}


//defining a function to clear all the feilds in the sale item area
function clearSaleItemFields() {
    $("#txtItemId").val("");
    $("#txtDescription").val("");
    $("#nbrPrice").val("");
}

function clearSaleFields(){
    $("#txtEmployeeId").val("");
    $("#txtName").val("");
    $("#txtContact").val("");
    $("#dateSale").val("");
    $("#txtAddress").val("");
}


//defining a function to validate the fields in the sale item area
function validateSaleItemInputs() {
    if ($("#nbrPrice").val().length == 0) {
        $("#nbrPrice").css("border-color", "red");
        $("#nbrPrice").select();
    }
    else {
        $("#nbrPrice").css("border-color", "rgb(206, 212, 218)");
    }

    if ($("#txtDescription").val().length == 0) {
        $("#txtDescription").css("border-color", "red");
        $("#txtDescription").focus();

    }
    else {
        $("#txtDescription").css("border-color", "rgb(206, 212, 218)");
    }

    for (var a = 0; a < $("#dlItemId option").length; a++) {
        if ($($("#dlItemId option")[a]).text() != $("#txtItemId").val()) {
            $("#txtItemId").css("border-color", "red");
            $("#txtItemId").focus();
        } else {
            $("#txtItemId").css("border-color", "rgb(206, 212, 218)");
            $("#txtItemId").blur();
            break;
        }
    }
}

function validateSaleInputs() {
    if ($("#tblSaleItem tbody tr").length == 0){
        $("#txtItemId").css("border-color", "red");
        $("#txtDescription").css("border-color", "red");
        $("#nbrPrice").css("border-color", "red");
    }
    else{
        $("#txtItemId").css("border-color", "rgb(206, 212, 218)");
        $("#txtDescription").css("border-color", "rgb(206, 212, 218)");
        $("#nbrPrice").css("border-color", "rgb(206, 212, 218)");
    }

    if ($("#txtAddress").val().length == 0){
        $("#txtAddress").css("border-color", "red");
        $("#txtAddress").select();
    }
    else {
        $("#txtAddress").css("border-color", "rgb(206, 212, 218)");
    }

    if ($("#dateSale").val().length == 0){
        $("#dateSale").css("border-color", "red");
        $("#dateSale").select();
    }
    else {
        $("#dateSale").css("border-color", "rgb(206, 212, 218)");
    }

    if ($("#txtContact").val().length == 0){
        $("#txtContact").css("border-color", "red");
        $("#txtContact").select();
    }
    else {
        $("#txtContact").css("border-color", "rgb(206, 212, 218)");
    }

    if ($("#txtName").val().length == 0){
        $("#txtName").css("border-color", "red");
        $("#txtName").select();
    }
    else {
        $("#txtName").css("border-color", "rgb(206, 212, 218)");
    }

    if ($("#txtEmployeeId").val().length == 0){
        $("#txtEmployeeId").css("border-color", "red");
        $("#txtEmployeeId").select();
    }
    else {
        $("#txtEmployeeId").css("border-color", "rgb(206, 212, 218)");
    }
}