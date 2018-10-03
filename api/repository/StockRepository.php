<?php

interface StockRepository{

    public function setConnection(mysqli $connection);

    public function insertStock($itemId, $details, $weight, $rate, $dateAdded);

    public function updateStock($itemId, $details, $weight, $rate, $dateAdded);

    public function deleteStock($itemId);

    public function getStock($itemId);

    public function getAllStock();

    public function getAllAvailableStock();

    public function getAllBangle();

    public function getAllBracelet();

    public function getAllBabyRing();

    public function getAllChain();

    public function getAllEaring();

    public function getAllJipsy();

    public function getAllNecklace();

    public function getAllPendant();

    public function getAllPanchayutha();

    public function getAllRing();

    public function getAllTussel();

}