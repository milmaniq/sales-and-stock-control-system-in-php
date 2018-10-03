<?php

require_once "business/impl/EmployeeBOImpl.php";

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

$employeeBO = new EmployeeBOImpl();

switch ($method) {
    case "GET":
        $action = $_GET["action"];

        switch ($action) {
            case "getAll":
                echo json_encode($employeeBO->getAllEmployee());
                break;
        }

        break;

    case "DELETE":

        $queryString = $_SERVER["QUERY_STRING"];
        $queryArray = preg_split("/=/", $queryString);
        $employeeId = $queryArray[1];
        echo json_encode($employeeBO->deleteEmployee($employeeId));

        break;

    case "POST":

        $action = $_POST["action"];

        switch ($action){
            case "insert":

                $employeeId = $_POST["txtEmployeeId"];
                $name = $_POST["txtName"];
                $contact = $_POST["txtContact"];
                $address = $_POST["txtAddress"];

                echo json_encode($employeeBO->insertEmployee($employeeId, $name, $contact, $address));

                break;

            case "update":

                $employeeId = $_POST["txtEmployeeId"];
                $name = $_POST["txtName"];
                $contact = $_POST["txtContact"];
                $address = $_POST["txtAddress"];

                echo json_encode($employeeBO->updateEmployee($employeeId, $name, $contact, $address));

                break;
        }

        break;
}