<?php

function getPdoConnect(){
    require('connect.php');
    
    return $pdo;
}

function getWines() {
    try {
        $pdo = getPdoConnect();
        return $pdo->query("SELECT id, image, description, domain, year, grape, region, country, quantity FROM wines ORDER BY create_time DESC");

    } catch (\PDOException $th) {
        return false;
    }
}


function addWine($winesValues) {
    $pdo = getPdoConnect();

    $stmt = $pdo->prepare("INSERT INTO wines (domain, year, grape, region, country, description, image, quantity) VALUES (:domain, :year, :grape, :region, :country, :description, :image, :quantity)");
    $stmt->bindParam(':domain', $winesValues['domain']);
    $stmt->bindParam(':year', $winesValues['year']);
    $stmt->bindParam(':grape', $winesValues['grape']);
    $stmt->bindParam(':region', $winesValues['region']);
    $stmt->bindParam(':country', $winesValues['country']);
    $stmt->bindParam(':description', $winesValues['description']);
    $stmt->bindParam(':image', $winesValues['image']);
    $stmt->bindParam(':quantity', $winesValues['quantity']);

    return $stmt->execute();
}


function deleteWine($id) {
    $pdo = getPdoConnect();

    $stmt = $pdo->prepare("DELETE FROM wines WHERE id = :id");
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
}