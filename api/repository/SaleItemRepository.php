<?php

interface SaleItemRepository{

    public function setConnection(mysqli $connection);

    public function insertSaleItem($itemId, $description, $price, $saleId);

    public function updateSaleItem($itemId, $description, $price, $saleId);

    public function deleteSaleItem($saleId);

    public function getSaleItem($saleId);

    public function getAllSaleItem();

}