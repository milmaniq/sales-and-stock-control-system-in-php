<?php

require_once "business/impl/SaleBOImpl.php";

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

$saleBO = new SaleBOImpl();

switch ($method){
    case "GET":
        $action = $_GET["action"];

        switch ($action){
            case "getAll":

                echo json_encode($saleBO->getAllSale());
                break;

            case "get":
                $saleId = $_GET["saleId"];

                echo json_encode($saleBO->getSale($saleId));
                break;

            case "getAllItems":
                $saleId = $_GET["saleId"];

                echo json_encode($saleBO->getSaleItems($saleId));

                break;

            case "getSaleReport":
                echo json_encode($saleBO->getSaleReport());
                break;

            case "getDayProfitReport":
                echo json_encode($saleBO->getDayProfitReport());
                break;
        }

        break;

    case "POST":
        $action = $_POST["action"];

        switch ($action){
            case "insert":
                $saleId = $_POST["txtSalesId"];
                $employeeId = $_POST["txtEmployeeId"];
                $name = $_POST["txtName"];
                $contact = $_POST["txtContact"];
                $dateOfSale = $_POST["dateSale"];
                $address = $_POST["txtAddress"];
                $total = $_POST["nbrTotal"];
                $saleItem = $_POST["tblSaleItem"];
                $saleItems = json_decode($saleItem);
                echo json_encode($saleBO->insertSale($saleId, $name, $address, $contact, $dateOfSale,
                    $total, $employeeId, $saleItems));
                break;
        }
        break;
}