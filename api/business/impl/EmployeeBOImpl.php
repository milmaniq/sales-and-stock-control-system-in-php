<?php

require_once "/../EmployeeBO.php";
require_once "/../../db/DBConnection.php";
require_once "/../../repository/impl/EmployeeRepositoryImpl.php";

class EmployeeBOImpl implements EmployeeBO{

    private $employeeRepository;

    public function __construct()
    {
        $this->employeeRepository =new EmployeeRepositoryImpl();
    }

    public function getAllEmployee()
    {
        $connection = (new DBConnection())->getConnection();

        $this->employeeRepository->setConnection($connection);

        $employees = $this->employeeRepository->getAllEmployee();

        mysqli_close($connection);

        return $employees;
    }

    public function deleteEmployee($employeeId)
    {
        $connection = (new DBConnection())->getConnection();

        $this->employeeRepository->setConnection($connection);

        $employees = $this->employeeRepository->deleteEmployee($employeeId);

        mysqli_close($connection);

        return $employees;
    }

    public function insertEmployee($employeeId, $name, $contact, $address)
    {
        $connection = (new DBConnection())->getConnection();

        $this->employeeRepository->setConnection($connection);

        $employees = $this->employeeRepository->insertEmployee($employeeId, $name, $contact, $address);

        mysqli_close($connection);

        return $employees;
    }

    public function updateEmployee($employeeId, $name, $contact, $address)
    {
        $connection = (new DBConnection())->getConnection();

        $this->employeeRepository->setConnection($connection);

        $employees = $this->employeeRepository->updateEmployee($employeeId, $name, $contact, $address);

        mysqli_close($connection);

        return $employees;
    }
}