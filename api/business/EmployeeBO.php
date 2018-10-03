<?php

interface EmployeeBO{

    public function getAllEmployee();

    public function deleteEmployee($employeeId);

    public function insertEmployee($employeeId, $name, $contact, $address);

    public function updateEmployee($employeeId, $name, $contact, $address);
}