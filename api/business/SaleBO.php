<?php

interface SaleBO{

    public function insertSale($saleId, $name, $address, $contact, $dateOfSale, $total, $employeeId, $saleItems);

    public function getAllSale();

    public function getSale($saleId);

    public function getSaleItems($saleId);

    public function getSaleReport();

    public function getDayProfitReport();
}