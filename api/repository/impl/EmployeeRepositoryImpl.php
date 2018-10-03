<?php

require_once "/../EmployeeRepository.php";

class EmployeeRepositoryImpl implements EmployeeRepository{

    private $connection;

    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function insertEmployee($employeeId, $name, $contact, $address)
    {
        $result = $this->connection->query("INSERT INTO Employee VALUES('$employeeId', '$name', '$contact', '$address')");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function updateEmployee($employeeId, $name, $contact, $address)
    {
        $result = $this->connection->query("UPDATE Employee SET name='$name', contact='$contact', address='$address' WHERE employeeId='$employeeId'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function deleteEmployee($employeeId)
    {
        $result = $this->connection->query("DELETE FROM Employee WHERE employeeId='$employeeId'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function getEmployee($employeeId)
    {
        $resultset = $this->connection->query("SELECT * FROM Employee WHERE employeeId='$employeeId'");
        return $resultset->fetch_assoc();
    }

    public function getAllEmployee()
    {
        $resultset = $this->connection->query("SELECT * FROM Employee
                                                ORDER BY convert(substring(employeeId,2),signed integer) ASC");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }


}