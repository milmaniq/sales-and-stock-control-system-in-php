<?php

require_once "/../StockRepository.php";

class StockRepositoryImpl implements StockRepository
{

    private $connection;

    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function insertStock($itemId, $details, $weight, $rate, $dateAdded)
    {
        $result = $this->connection->query("INSERT INTO Stock VALUES('$itemId', '$details', '$weight', '$rate', '$dateAdded')");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function updateStock($itemId, $details, $weight, $rate, $dateAdded)
    {
        $result = $this->connection->query("UPDATE Stock SET details='$details', weight='$weight', rate='$rate', dateAdded='$dateAdded' WHERE itemId='$itemId'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function deleteStock($itemId)
    {
        $result = $this->connection->query("DELETE FROM Stock WHERE itemId='$itemId'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function getStock($itemId)
    {
        $resultset = $this->connection->query("SELECT * FROM Stock WHERE itemId='$itemId'");
        return $resultset->fetch_assoc();
    }

    public function getAllStock()
    {
        $resultset = $this->connection->query("SELECT * FROM Stock");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllAvailableStock()
    {


        $resultset = $this->connection->query("SELECT s.itemId FROM saleitem si
                                                RIGHT JOIN stock s
                                                ON s.itemid = si.itemid
                                                WHERE si.itemid is NULL
                                                ORDER BY s.itemid ASC");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllBangle()
    {
        $resultset = $this->connection->query("SELECT s.itemId, s.details, s.weight, s.rate, s.dateAdded, si.description, si.price, si.saleId
                                                FROM stock s LEFT JOIN saleitem si ON s.itemId = si.itemId 
                                                WHERE s.itemId REGEXP '^[B][1-9]+'
                                                ORDER BY convert(substring(s.itemId,2),signed integer) ASC");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllBracelet()
    {
        $resultset = $this->connection->query("SELECT s.itemId, s.details, s.weight, s.rate, s.dateAdded, si.description, si.price, si.saleId
                                                FROM stock s LEFT JOIN saleitem si ON s.itemId = si.itemId 
                                                WHERE s.itemId REGEXP '^[B][L][1-9]+'
                                                ORDER BY convert(substring(s.itemId,2),signed integer) ASC");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllBabyRing()
    {
        $resultset = $this->connection->query("SELECT s.itemId, s.details, s.weight, s.rate, s.dateAdded, si.description, si.price, si.saleId
                                                FROM stock s LEFT JOIN saleitem si ON s.itemId = si.itemId 
                                                WHERE s.itemId REGEXP '^[B][R][1-9]+'
                                                ORDER BY convert(substring(s.itemId,2),signed integer) ASC");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllChain()
    {
        $resultset = $this->connection->query("SELECT s.itemId, s.details, s.weight, s.rate, s.dateAdded, si.description, si.price, si.saleId
                                                FROM stock s LEFT JOIN saleitem si ON s.itemId = si.itemId 
                                                WHERE s.itemId REGEXP '^[C][1-9]+'
                                                ORDER BY convert(substring(s.itemId,2),signed integer) ASC");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllEaring()
    {
        $resultset = $this->connection->query("SELECT s.itemId, s.details, s.weight, s.rate, s.dateAdded, si.description, si.price, si.saleId
                                                FROM stock s LEFT JOIN saleitem si ON s.itemId = si.itemId 
                                                WHERE s.itemId REGEXP '^[E][R][1-9]+'
                                                ORDER BY convert(substring(s.itemId,2),signed integer) ASC");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllJipsy()
    {
        $resultset = $this->connection->query("SELECT s.itemId, s.details, s.weight, s.rate, s.dateAdded, si.description, si.price, si.saleId
                                                FROM stock s LEFT JOIN saleitem si ON s.itemId = si.itemId 
                                                WHERE s.itemId REGEXP '^[J][1-9]+'
                                                ORDER BY convert(substring(s.itemId,2),signed integer) ASC");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllNecklace()
    {
        $resultset = $this->connection->query("SELECT s.itemId, s.details, s.weight, s.rate, s.dateAdded, si.description, si.price, si.saleId
                                                FROM stock s LEFT JOIN saleitem si ON s.itemId = si.itemId 
                                                WHERE s.itemId REGEXP '^[N][1-9]+'
                                                ORDER BY convert(substring(s.itemId,2),signed integer) ASC");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllPendant()
    {
        $resultset = $this->connection->query("SELECT s.itemId, s.details, s.weight, s.rate, s.dateAdded, si.description, si.price, si.saleId
                                                FROM stock s LEFT JOIN saleitem si ON s.itemId = si.itemId 
                                                WHERE s.itemId REGEXP '^[P][T][1-9]+'
                                                ORDER BY convert(substring(s.itemId,2),signed integer) ASC");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllPanchayutha()
    {
        $resultset = $this->connection->query("SELECT s.itemId, s.details, s.weight, s.rate, s.dateAdded, si.description, si.price, si.saleId
                                                FROM stock s LEFT JOIN saleitem si ON s.itemId = si.itemId 
                                                WHERE s.itemId REGEXP '^[P][U][1-9]+'
                                                ORDER BY convert(substring(s.itemId,2),signed integer) ASC");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllRing()
    {
        $resultset = $this->connection->query("SELECT s.itemId, s.details, s.weight, s.rate, s.dateAdded, si.description, si.price, si.saleId
                                                FROM stock s LEFT JOIN saleitem si ON s.itemId = si.itemId 
                                                WHERE s.itemId REGEXP '^[R][1-9]+'
                                                ORDER BY convert(substring(s.itemId,2),signed integer) ASC");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllTussel()
    {
        $resultset = $this->connection->query("SELECT s.itemId, s.details, s.weight, s.rate, s.dateAdded, si.description, si.price, si.saleId
                                                FROM stock s LEFT JOIN saleitem si ON s.itemId = si.itemId 
                                                WHERE s.itemId REGEXP '^[T][1-9]+'
                                                ORDER BY convert(substring(s.itemId,2),signed integer) ASC");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }
}