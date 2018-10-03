<?php

require_once "/../SaleBO.php";
require_once "/../../db/DBConnection.php";
require_once "/../../repository/impl/SaleRepositoryImpl.php";
require_once "/../../repository/impl/SaleItemRepositoryImpl.php";

class SaleBOImpl implements SaleBO{

    private $saleRepository;
    private $saleItemRepository;

    public function __construct(){
        $this->saleRepository = new SaleRepositoryImpl();
        $this->saleItemRepository = new SaleItemRepositoryImpl();
    }


    public function insertSale($saleId, $name, $address, $contact, $dateOfSale, $total, $employeeId, $saleItems)
    {
        $connection = (new DBConnection())->getConnection();
        $this->saleRepository->setConnection($connection);
        $connection->autocommit(false);
        $t1 = $this->saleRepository->insertSale($saleId, $name, $address, $contact, $dateOfSale, $total, $employeeId);

        if (!$t1){
            $connection->rollback();
            $connection->autocommit(true);
            mysqli_close($connection);
            return $t1;
        }

        //set the same connection variable to the saleItemRepository too
        $this->saleItemRepository->setConnection($connection);
        foreach ($saleItems as $item){
            $t2 = $this->saleItemRepository->insertSaleItem($item->itemId,$item->description, $item->price, $saleId);

            if (!$t2){
                $connection->rollback();
                $connection->autocommit(true);
                mysqli_close($connection);
                return $t2;
            }
        }

        $connection->commit();
        $connection->autocommit(true);
        mysqli_close($connection);
        return ($t1 && $t2);

    }

    public function getAllSale()
    {
        $connection = (new DBConnection())->getConnection();

        $this->saleRepository->setConnection($connection);

        $sale = $this->saleRepository->getAllSale();

        mysqli_close($connection);

        return $sale;
    }

    public function getSale($saleId)
    {
        $connection = (new DBConnection())->getConnection();

        $this->saleRepository->setConnection($connection);

        $sale = $this->saleRepository->getSale($saleId);

        mysqli_close($connection);

        return $sale;
    }

    public function getSaleItems($saleId)
    {
        $connection = (new DBConnection())->getConnection();

        $this->saleItemRepository->setConnection($connection);

        $saleItems = $this->saleItemRepository->getSaleItem($saleId);

        mysqli_close($connection);

        return $saleItems;
    }

    public function getSaleReport()
    {
        $connection = (new DBConnection())->getConnection();

        $this->saleRepository->setConnection($connection);

        $saleReport = $this->saleRepository->getSaleReport();

        mysqli_close($connection);

        return $saleReport;
    }

    public function getDayProfitReport()
    {
        $connection = (new DBConnection())->getConnection();

        $this->saleRepository->setConnection($connection);

        $dayProfit = $this->saleRepository->getDayProfitReport();

        mysqli_close($connection);

        return $dayProfit;
    }
}