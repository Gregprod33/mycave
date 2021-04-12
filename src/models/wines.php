<?php

function getPdoConnect(){
    require('connect.php');
    
    return $pdo;
}

function getWines() {
    try {
        $pdo = getPdoConnect();
        return $pdo->query("SELECT d.name AS domain, c.name AS country, g.name AS grape, r.name AS region, w.year, w.description, w.image FROM wines w JOIN domains d ON w.id_domain = d.id JOIN grapes g ON w.id_grape = g.id JOIN regions r ON w.id_region = r.id JOIN countries c ON w.id_country = c.id ORDER BY w.create_time DESC");

    } catch (\PDOException $th) {
        return false;
    }
}