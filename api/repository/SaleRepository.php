<?php

Interface SaleRepository{

    public function setConnection(mysqli $connection);

    public function insertSale($saleId, $name, $address, $contact, $dateOfSale, $total, $employeeId);

    public function updateSale($saleId, $name, $address, $contact, $dateOfSale, $total, $employeeId);

    public function deleteSale($saleId);

    public function getSale($saleId);

    public function getAllSale();

    public function getSaleReport();

    public function getDayProfitReport();
}