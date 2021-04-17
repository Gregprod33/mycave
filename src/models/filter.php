<?php

function getPdoConnect(){
    require('connect.php');
    
    return $pdo;
}

function getSearchWines() {
    try {
        $pdo = getPdoConnect(); 
        $stmt = $pdo->query("SELECT id, image, description, domain, year, grape, region, country, quantity FROM wines ORDER BY create_time DESC");
        $posts=$stmt->fetchAll(PDO::FETCH_ASSOC);

        return $posts;

    } catch (\PDOException $th) {
        return false;
    }
}