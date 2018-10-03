$(document).ready(function () {
    var ajaxConfig = {
        method: "GET",
        url: "api/sales.php",
        data:{
            action:"getAll"
        },
        async: true
    }

    $.ajax(ajaxConfig).done(function (response) {
        $("#tblSale tbody tr").remove();

        response.forEach(function (sale) {
            $("#tblSale tbody").append("<tr><td>"+sale.saleId+"</td><td>"+sale.name+"</td><td>"+sale.contact
                +"</td><td>"+sale.address+"</td><td>"+sale.dateOfSale+"</td><td>"+sale.total
                +"</td><td>"+sale.employeeId
                +"</td><td><i class='fa fa-info' data-toggle='modal' data-target='#moreInfo'></i></td></tr>")
        });

    });

});

$(document).on("click", "#tblSale tbody tr td i", function () {
    $("#tblSaleItem tbody tr").remove();
    var saleId = $($(this).parents("tr").children("td")[0]).text();

   var ajaxConfig = {
       method:"GET",
       url: "api/sales.php",
       data: {
           action: "getAllItems",
           saleId: saleId
       },
       async: true
   }

   $.ajax(ajaxConfig).done(function (response) {
        response.forEach(function (saleItem) {

            var itemId = saleItem.itemId;

            var ajaxConfig = {
                method:"GET",
                url: "api/stocks.php",
                data: {
                    action: "get",
                    itemId: itemId
                },
                async: true
            }

            $.ajax(ajaxConfig).done(function (response) {
                var weight = response.weight;

                $("#tblSaleItem tbody").append("<tr><td>"+saleItem.itemId+"</td><td>"+saleItem.description
                    +"</td><td>"+weight+"</td><td>"+saleItem.price+"</td></tr>");

            });

        });
   });

});