<?php

require_once "/../StockBO.php";
require_once "/../../db/DBConnection.php";
require_once "/../../repository/impl/StockRepositoryImpl.php";

class StockBOImpl implements StockBO{

    private $stockRepository;

    public function __construct()
    {
        $this->stockRepository = new StockRepositoryImpl();
    }

    public function getAllAvailableStock()
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $employees = $this->stockRepository->getAllAvailableStock();

        mysqli_close($connection);

        return $employees;
    }

    public function getAllStock()
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->getAllStock();

        mysqli_close($connection);

        return $stock;
    }

    public function getStock($itemId)
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->getStock($itemId);

        mysqli_close($connection);

        return $stock;
    }

    public function getAllBangle()
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->getAllBangle();

        mysqli_close($connection);

        return $stock;
    }

    public function getAllBracelet()
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->getAllBracelet();

        mysqli_close($connection);

        return $stock;
    }

    public function getAllBabyRing()
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->getAllBabyRing();

        mysqli_close($connection);

        return $stock;
    }

    public function getAllChain()
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->getAllChain();

        mysqli_close($connection);

        return $stock;
    }

    public function getAllEaring()
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->getAllEaring();

        mysqli_close($connection);

        return $stock;
    }

    public function getAllJipsy()
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->getAllJipsy();

        mysqli_close($connection);

        return $stock;
    }

    public function getAllNecklace()
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->getAllNecklace();

        mysqli_close($connection);

        return $stock;
    }

    public function getAllPendant()
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->getAllPendant();

        mysqli_close($connection);

        return $stock;
    }

    public function getAllPanchayutha()
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->getAllPanchayutha();

        mysqli_close($connection);

        return $stock;
    }

    public function getAllRing()
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->getAllRing();

        mysqli_close($connection);

        return $stock;
    }

    public function getAllTussel()
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->getAllTussel();

        mysqli_close($connection);

        return $stock;
    }

    public function deleteStock($itemId)
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->deleteStock($itemId);

        mysqli_close($connection);

        return $stock;
    }

    public function insertStock($itemId, $weight, $rate, $dateAdded, $details)
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->insertStock($itemId, $details, $weight, $rate, $dateAdded);

        mysqli_close($connection);

        return $stock;
    }

    public function updateStock($itemId, $weight, $rate, $dateAdded, $details)
    {
        $connection = (new DBConnection())->getConnection();

        $this->stockRepository->setConnection($connection);

        $stock = $this->stockRepository->updateStock($itemId, $details, $weight, $rate, $dateAdded);

        mysqli_close($connection);

        return $stock;
    }
}