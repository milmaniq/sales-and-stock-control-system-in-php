//highlighting the first option from the vertical menu and assigning it to the heading text
$(document).ready(function () {
    $($(".vertical-menu a")[1]).addClass("active");
    $("#margin_top_bottom_head > div").text($(".vertical-menu a.active").text());

    getItemsAndNextItemId();
});

//highlighting the selected option and removing all the other highlighted options
//assigning the selected option to the heading text
$(".vertical-menu a+a").on("click", function () {
    $(".vertical-menu a").removeClass("active");
    $(this).addClass("active");
    $("#margin_top_bottom_head > div").text($(".vertical-menu a.active").text());

    getItemsAndNextItemId();

});

//getting the items details with respect to the selected option
//getting the item sale details of the items
//getting the item id of the next item that is to be added
function getItemsAndNextItemId() {
    var ajaxConfig = {
        method: "GET",
        url: "api/stocks.php",
        data: {
            action: "getAll" + $(".vertical-menu a.active").text(),
        },
        async: true
    }


    $.ajax(ajaxConfig).done(function (response) {

        $("#tblItem tbody tr").remove();


        response.forEach(function (item) {

            var dateSold = "";
            if (item.saleId != null) {
                var ajaxConfig = {
                    method: "GET",
                    url: "api/sales.php",
                    data: {
                        action: "get",
                        saleId: item.saleId,
                    },
                    async: true
                }


                $.ajax(ajaxConfig).done(function (response) {
                    dateSold = response.dateOfSale;
                });
            }
            else{
                dateSold = "";
            }

            console.log("final value of date sold in the row: "+ dateSold);
            setTimeout(function () {
                if (item.saleId == null) {
                    item.saleId = "";
                }

                if (item.price == null) {
                    item.price = "";
                }

                if (item.details == null) {
                    item.details = "";
                }


                $("#tblItem tbody").append("<tr><td>" + item.itemId + "</td><td>" + item.details + "</td><td>" + item.weight
                    + "</td><td>" + item.rate + "</td><td>" + item.dateAdded + "</td><td>" + dateSold
                    + "</td><td>" + item.price + "</td><td>" + item.saleId + "</td><td><i class='fas fa-trash'></i></td></tr>");


            }, 200);

        });

        setTimeout(function () {
            var itemIdPrefix;

            switch ($(".vertical-menu a.active").text()) {
                case "Bangle":
                    itemIdPrefix = "B";
                    break;
                case "Bracelet":
                    itemIdPrefix = "BL";
                    break;
                case "BabyRing":
                    itemIdPrefix = "BR";
                    break;
                case "Chain":
                    itemIdPrefix = "C";
                    break;
                case "Earing":
                    itemIdPrefix = "ER";
                    break;
                case "Jipsy":
                    itemIdPrefix = "J";
                    break;
                case "Necklace":
                    itemIdPrefix = "N";
                    break;
                case "Pendant":
                    itemIdPrefix = "PT";
                    break;
                case "Panchayutha":
                    itemIdPrefix = "PU";
                    break;
                case "Ring":
                    itemIdPrefix = "R";
                    break;
                case "Tussel":
                    itemIdPrefix = "T";
                    break;
            }

            if ($("#tblItem tbody tr").length !== 0) {
                var lastOrderId = $($("#tblItem tbody tr").last().children("td")[0]).text();
                var numOfLastOrderId = parseInt(lastOrderId.match(/\d+/)[0]);
                var newOrderId = itemIdPrefix + (numOfLastOrderId + 1);
                $("#txtItemId").val(newOrderId);
            }
            else {
                var newOrderId = itemIdPrefix + "1";
                $("#txtItemId").val(newOrderId);
            }

            if ($("#tblItem tbody tr").length == 0) {
                $("#tblItem tfoot tr").css("display", "table-row");
            }
            else {
                $("#tblItem tfoot tr").css("display", "none");
            }
        }, 200);

    });


}

//deleting an item from the stock
$(document).on("click", "#tblItem tbody tr td i", function () {
    var itemId = $($(this).parents("tr").children("td")[0]).text();
    if (confirm("Are you sure you want to delete " + itemId)){
        var ajaxConfig = {
            method: "DELETE",
            url: "api/stocks.php?itemId=" + itemId,
            async: true
        }

        $.ajax(ajaxConfig).done(function (response) {
            $("#btnClear").trigger("click");
        });
    }

});

//adding an item to the stock
$("#btnAdd").on("click", function () {
    validateStockInputs();

    setTimeout(function () {
        for (var a=1; a<4; a++){
            if (($($("#frmStock input")[a]).css("border-color") === "rgb(255, 0, 0)")) {
                return;
            }
        }


        if ($("#btnAdd").text() == "Save"){
            $("#frmStock input[type='hidden']").val("update");
        }
        else{
            $("#frmStock input[type='hidden']").val("insert");
        }

        var ajaxConfig = {
            method: "POST",
            url: "api/stocks.php",
            data: $("#frmStock").serialize(),
            async: true
        }

        $.ajax(ajaxConfig).done(function (response) {
            $("#btnClear").trigger("click");
        })

    },200);
});

//selecting a row and taking the values in the table row to the text fields
$(document).on("click", "#tblItem tbody tr", function () {
    $("#txtItemId").val($($(this).children("td")[0]).text());
    $("#nbrWeight").val($($(this).children("td")[2]).text());
    $("#nbrRate").val($($(this).children("td")[3]).text());
    $("#dateAdded").val($($(this).children("td")[4]).text());
    $("#txtDetails").val($($(this).children("td")[1]).text());
    $("#btnAdd").text("Save");

    $("#tblItem tbody tr").removeClass("highlightTableRow");
    $(this).addClass("highlightTableRow")
});


//clearing all the fields in order to add a new item
$("#btnClear").on("click", function () {
    $("#nbrWeight").val("");
    $("#nbrRate").val("");
    $("#dateAdded").val("");
    $("#txtDetails").val("");

    $("#btnAdd").text("Add");
    $("#tblItem tbody tr").removeClass("highlightTableRow");

    getItemsAndNextItemId();

});

//validating the input fields
function validateStockInputs(){
    if ($("#dateAdded").val().length == 0) {
        $("#dateAdded").css("border-color", "red");
        $("#dateAdded").focus();
    }
    else {
        $("#dateAdded").css("border-color", "rgb(206, 212, 218)");
    }

    if ($("#nbrRate").val().length == 0) {
        $("#nbrRate").css("border-color", "red");
        $("#nbrRate").focus();
    }
    else {
        $("#nbrRate").css("border-color", "rgb(206, 212, 218)");
    }

    if ($("#nbrWeight").val().length == 0) {
        $("#nbrWeight").css("border-color", "red");
        $("#nbrWeight").select();
    }
    else {
        $("#nbrWeight").css("border-color", "rgb(206, 212, 218)");
    }
}

