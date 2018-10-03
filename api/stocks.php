<?php

require_once "business/impl/StockBOImpl.php";

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

$stockBO = new StockBOImpl();

switch ($method) {
    case "GET":
        $action = $_GET["action"];

        switch ($action) {
            case "getAllAvailable":
                echo json_encode($stockBO->getAllAvailableStock());
                break;

            case "get":
                $itemId = $_GET["itemId"];
                echo json_encode($stockBO->getStock($itemId));
                break;

            case "getAllBangle":
                echo json_encode($stockBO->getAllBangle());
                break;

            case "getAllBracelet":
                echo json_encode($stockBO->getAllBracelet());
                break;

            case "getAllBabyRing":
                echo json_encode($stockBO->getAllBabyRing());
                break;

            case "getAllChain":
                echo json_encode($stockBO->getAllChain());
                break;

            case "getAllEaring":
                echo json_encode($stockBO->getAllEaring());
                break;

            case "getAllJipsy":
                echo json_encode($stockBO->getAllJipsy());
                break;

            case "getAllNecklace":
                echo json_encode($stockBO->getAllNecklace());
                break;

            case "getAllPendant":
                echo json_encode($stockBO->getAllPendant());
                break;

            case "getAllPanchayutha":
                echo json_encode($stockBO->getAllPanchayutha());
                break;

            case "getAllRing":
                echo json_encode($stockBO->getAllRing());
                break;

            case "getAllTussel":
                echo json_encode($stockBO->getAllTussel());
                break;

        }

        break;

    case "DELETE":
        $queryString = $_SERVER["QUERY_STRING"];
        $queryArray = preg_split("/=/", $queryString);
        if (count($queryArray) === 2) {
            $itemId = $queryArray[1];
            echo json_encode($stockBO->deleteStock($itemId));
        }
        break;


    case "POST":

        $action = $_POST["action"];
        switch ($action){
            case "insert":
                $itemId = $_POST["txtItemId"];
                $weight = $_POST["nbrWeight"];
                $rate = $_POST["nbrRate"];
                $dateAdded = $_POST["dateAdded"];
                $details = $_POST["txtDetails"];
                echo json_encode($stockBO->insertStock($itemId, $weight, $rate, $dateAdded, $details));
                break;

            case "update":
                $itemId = $_POST["txtItemId"];
                $weight = $_POST["nbrWeight"];
                $rate = $_POST["nbrRate"];
                $dateAdded = $_POST["dateAdded"];
                $details = $_POST["txtDetails"];
                echo json_encode($stockBO->updateStock($itemId, $weight, $rate, $dateAdded, $details));
                break;
        }
        break;
}