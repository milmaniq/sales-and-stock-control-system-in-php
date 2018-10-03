<?php

require_once "/../SaleItemRepository.php";

class SaleItemRepositoryImpl implements SaleItemRepository{

    private $connection;

    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function insertSaleItem($itemId, $description, $price, $saleId)
    {
        $result = $this->connection->query("INSERT INTO SaleItem VALUES('$itemId', '$description', '$price', '$saleId')");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function updateSaleItem($itemId, $description, $price, $saleId)
    {
        $result = $this->connection->query("UPDATE SaleItem SET description='$description', price='$price', saleId='$saleId' WHERE itemId='$itemId'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function deleteSaleItem($saleId)
    {
        $result = $this->connection->query("DELETE FROM SaleItem WHERE saleId='$saleId'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function getSaleItem($saleId)
    {
        $resultset = $this->connection->query("SELECT * FROM SaleItem WHERE saleId='$saleId'");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllSaleItem()
    {
        $resultset = $this->connection->query("SELECT * FROM SaleItem");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }
}