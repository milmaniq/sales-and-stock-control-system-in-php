<?php

require_once "/../SaleRepository.php";

class SaleRepositoryImpl implements SaleRepository
{

    private $connection;

    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function insertSale($saleId, $name, $address, $contact, $dateOfSale, $total, $employeeId)
    {
        $result = $this->connection->query("INSERT INTO Sale VALUES('$saleId', '$name', '$address', '$contact', '$dateOfSale', '$total', '$employeeId')");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function updateSale($saleId, $name, $address, $contact, $dateOfSale, $total, $employeeId)
    {
        $result = $this->connection->query("UPDATE Sale SET name='$name', address='$address', contact='$contact', dateOfSale='$dateOfSale', total='$total', employeeId='$employeeId' WHERE saleId='$saleId'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function deleteSale($saleId)
    {
        $result = $this->connection->query("DELETE FROM Sale WHERE saleId='$saleId'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function getSale($saleId)
    {
        $resultset = $this->connection->query("SELECT * FROM Sale WHERE saleId='$saleId'");
        return $resultset->fetch_assoc();
    }

    public function getAllSale()
    {
        $resultset = $this->connection->query("SELECT * FROM Sale
                                                ORDER BY convert(substring(saleId,2),signed integer) ASC");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function getSaleReport()
    {
        $resultset = $this->connection->query("SELECT s.saleId, s.dateOfSale, si.itemId, si.price AS priceSold, 
                                                ((st.rate/8)*st.weight) AS priceBought, 
                                                (si.price - ((st.rate/8)*st.weight)) AS itemProfit
                                                FROM sale s, saleitem si, stock st 
                                                WHERE (s.saleid = si.saleid) 
                                                AND (si.itemid = st.itemid)
                                                ORDER BY convert(substring(s.saleId,2),signed integer) ASC");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function getDayProfitReport()
    {
        $resultset = $this->connection->query("SELECT s.dateOfSale, 
                                                SUM(si.price - ((st.rate/8)*st.weight)) AS totalDayProfit
                                                FROM sale s, saleitem si, stock st 
                                                WHERE (s.saleid = si.saleid) 
                                                AND (si.itemid = st.itemid) 
                                                GROUP BY s.dateOfSale");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }
}