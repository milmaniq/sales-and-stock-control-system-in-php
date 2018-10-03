<?php

interface StockBO{
    public function getAllAvailableStock();

    public function getStock($itemId);

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

    public function deleteStock($itemId);

    public function insertStock($itemId, $weight, $rate, $dateAdded, $details);

    public function updateStock($itemId, $weight, $rate, $dateAdded, $details);

}