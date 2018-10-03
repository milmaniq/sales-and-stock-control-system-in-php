//getting the sale report and the day profit report on page load
$(document).ready(function () {
    var ajaxConfig = {
        method: "GET",
        url: "api/sales.php",
        data:{
            action: "getSaleReport"
        },
        async: true
    }

    $.ajax(ajaxConfig).done(function (response) {

        response.forEach(function (saleReport) {
            $("#tblSaleReport tbody").append("<tr><td>"+saleReport.saleId+"</td><td>"+saleReport.dateOfSale
                +"</td><td>"+saleReport.itemId+"</td><td>"+saleReport.priceSold+"</td><td>"+saleReport.priceBought
                +"</td><td>"+saleReport.itemProfit+"</td></tr>");
        });

    });

    var ajaxConfig = {
        method: "GET",
        url: "api/sales.php",
        data:{
            action: "getDayProfitReport"
        },
        async: true
    }

    $.ajax(ajaxConfig).done(function (response) {

        response.forEach(function (dayProfitReport) {
            $("#tblDayProfitReport tbody").append("<tr><td>"+dayProfitReport.dateOfSale
                +"</td><td>"+dayProfitReport.totalDayProfit +"</td></tr>");
        });

    });

});
