<?php

interface EmployeeRepository{

    public function setConnection(mysqli $connection);

    public function insertEmployee($employeeId, $name, $contact, $address);

    public function updateEmployee($employeeId, $name, $contact, $address);

    public function deleteEmployee($employeeId);

    public function getEmployee($employeeId);

    public function getAllEmployee();

}