$(document).ready(function () {
    var ajaxConfig = {
        method: "GET",
        url: "api/stocks.php?action=getAllBangle",
        async: true
    }

    $.ajax(ajaxConfig).done(function (response) {
        count = 0;
        response.forEach(function (bangle) {
            if (bangle.saleId == null) {
                count += 1;
            }
        });
        $("#countBangle").text(count);
    });

    var ajaxConfig2 = {
        method: "GET",
        url: "api/stocks.php?action=getAllBracelet",
        async: true
    }

    $.ajax(ajaxConfig2).done(function (response) {
        count = 0;
        response.forEach(function (bracelet) {
            if (bracelet.saleId == null) {
                count += 1;
            }
        });
        $("#countBracelet").text(count);
    });

    var ajaxConfig3 = {
        method: "GET",
        url: "api/stocks.php?action=getAllBabyRing",
        async: true
    }

    $.ajax(ajaxConfig3).done(function (response) {
        count = 0;
        response.forEach(function (babyRing) {
            if (babyRing.saleId == null) {
                count += 1;
            }
        });
        $("#countBabyRing").text(count);
    });

    var ajaxConfig4 = {
        method: "GET",
        url: "api/stocks.php?action=getAllChain",
        async: true
    }

    $.ajax(ajaxConfig4).done(function (response) {
        count = 0;
        response.forEach(function (chain) {
            if (chain.saleId == null) {
                count += 1;
            }
        });
        $("#countChain").text(count);
    });

    var ajaxConfig5 = {
        method: "GET",
        url: "api/stocks.php?action=getAllEaring",
        async: true
    }

    $.ajax(ajaxConfig5).done(function (response) {
        count = 0;
        response.forEach(function (earing) {
            if (earing.saleId == null) {
                count += 1;
            }
        });
        $("#countEaring").text(count);
    });

    var ajaxConfig6 = {
        method: "GET",
        url: "api/stocks.php?action=getAllJipsy",
        async: true
    }

    $.ajax(ajaxConfig6).done(function (response) {
        count = 0;
        response.forEach(function (jipsy) {
            if (jipsy.saleId == null) {
                count += 1;
            }
        });
        $("#countJipsy").text(count);
    });

    var ajaxConfig7 = {
        method: "GET",
        url: "api/stocks.php?action=getAllNecklace",
        async: true
    }

    $.ajax(ajaxConfig7).done(function (response) {
        count = 0;
        response.forEach(function (necklace) {
            if (necklace.saleId == null) {
                count += 1;
            }
        });
        $("#countNecklace").text(count);
    });

    var ajaxConfig8 = {
        method: "GET",
        url: "api/stocks.php?action=getAllPendant",
        async: true
    }

    $.ajax(ajaxConfig8).done(function (response) {
        count = 0;
        response.forEach(function (pendant) {
            if (pendant.saleId == null) {
                count += 1;
            }
        });
        $("#countPendant").text(count);
    });

    var ajaxConfig9 = {
        method: "GET",
        url: "api/stocks.php?action=getAllPanchayutha",
        async: true
    }

    $.ajax(ajaxConfig9).done(function (response) {
        count = 0;
        response.forEach(function (panchayutha) {
            if (panchayutha.saleId == null) {
                count += 1;
            }
        });
        $("#countPanchayutha").text(count);
    });

    var ajaxConfig10 = {
        method: "GET",
        url: "api/stocks.php?action=getAllRing",
        async: true
    }

    $.ajax(ajaxConfig10).done(function (response) {
        count = 0;
        response.forEach(function (ring) {
            if (ring.saleId == null) {
                count += 1;
            }
        });
        $("#countRing").text(count);
    });

    var ajaxConfig11 = {
        method: "GET",
        url: "api/stocks.php?action=getAllTussel",
        async: true
    }

    $.ajax(ajaxConfig11).done(function (response) {
        count = 0;
        response.forEach(function (tussel) {
            if (tussel.saleId == null) {
                count += 1;
            }
        });
        $("#countTussel").text(count);
    });

    var ajaxConfig12 = {
        method: "GET",
        url: "api/stocks.php?action=getAllAvailable",
        async: true
    }

    $.ajax(ajaxConfig12).done(function (response) {
        $("#countAllAvailable").text(response.length);
    });

    var ajaxConfig13 = {
        method: "GET",
        url: "api/sales.php?action=getSaleReport",
        async: true
    }

    $.ajax(ajaxConfig13).done(function (response) {

        var todayDate = new Date().toISOString().slice(0, 10);
        var count = 0;
        var todaySale = 0;
        var todayProfit = 0;
        response.forEach(function (sale) {
            if (sale.dateOfSale == todayDate) {
                count += 1;
                todaySale += Number(sale.priceSold);
                todayProfit += Number(sale.itemProfit);
            }
        });
        $("#countSale").text(count);
        $("#sumSale").text(todaySale);
        $("#sumProfit").text(todayProfit);
    })

});

$(document).ready(function () {

    var arrXAxisDate = [];
    var arrYAxisSale = [];
    var arrYAxisProfit = [];

    for (var a = 0; a < 10; a++) {
        arrXAxisDate[9 - a] = moment().subtract(a, 'days').format("YYYY-MM-DD");

    }

    var ajaxConfig = {
        method: "GET",
        url: "api/sales.php?action=getSaleReport",
        async: true
    }

    $.ajax(ajaxConfig).done(function (response) {
        arrXAxisDate.forEach(function (date) {
            var daySale = 0;
            var dayProfit = 0;
            response.forEach(function (item) {
                if (item.dateOfSale == date) {
                    daySale += Number(item.priceSold);
                    dayProfit += Number(item.itemProfit);
                }

            });
            arrYAxisSale.push(daySale);
            arrYAxisProfit.push(dayProfit);
        });

        var salesChart = new Chart($("#chartSales"), {
            type: 'line',
            data: {
                labels: arrXAxisDate,
                datasets: [{
                    label: 'Sales for the last 10 days',
                    data: arrYAxisSale,
                    backgroundColor: [
                        'rgba(255, 128, 128, 0.8)',
                    ],
                    borderColor: [
                        'rgba(255,0,0,1)',
                    ],

                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var profitChart = new Chart($("#chartProfit"), {
            type: 'line',
            data: {
                labels: arrXAxisDate,
                datasets: [{
                    label: 'Profit for the last 10 days',
                    data: arrYAxisProfit,
                    backgroundColor: [
                        'rgba(255, 128, 128, 0.8)',
                    ],
                    borderColor: [
                        'rgba(255,0,0,1)',
                    ],

                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });


    });

});

