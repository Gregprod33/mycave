<?php

function getPdoConnect(){
    require('connect.php');
    
    return $pdo;
}

function getWines() {
    try {
        $pdo = getPdoConnect(); 
        // on récupère le numéro de la page courante, s'il n'y en a pas ou si = 0 on affecte 1 
        $page = $_GET['page'] ?? 1;

        // pour le référencement, on redirige la page 1 vers l'url natif index .html
        // http response code signifie "de façon prmanente"
        if ($page === '1') {
            http_response_code(301);
            header('Location: ./index.html');
            exit;
        }
        $currentPage = (int)($_GET['page'] ?? 1);
        if($currentPage <= 0) {
            throw New Exception('Numéro de page invalide');
        }
        // on récuère le nombre d'articles dans la base de données
        $count = (int)$pdo->query("SELECT COUNT(id) FROM wines LIMIT 1")->fetch(PDO::FETCH_NUM)[0];
        // on calcule le nombre de pages totales à afficher : nbre articles / limite = 6 ici
        // et on arrondi au chiffre supérieur
        $perPage = 6;
        $pages = ceil($count / $perPage);
        if($currentPage > $pages) {
            throw New Exception('Cette page n\'existe pas');
        }
        $offset = $perPage * ($currentPage - 1);
        $query = $pdo->query("SELECT id, image, description, domain, year, grape, region, country, quantity FROM wines ORDER BY create_time DESC LIMIT $perPage OFFSET $offset");
        $posts=$query->fetchAll(PDO::FETCH_ASSOC);

        return array($posts, $currentPage, $pages);

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


function getWineDetail($id) {
    $pdo = getPdoConnect();

    $stmt = $pdo->prepare("SELECT id, image, description, domain, year, grape, region, country, quantity FROM wines WHERE id = :id");

    $stmt->bindParam(':id', $id);

    $res = $stmt->execute();

    if($res){
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}


function updateWine($id, $wineValues) {

    $pdo = getPdoConnect();

    $stmt = $pdo->prepare("UPDATE wines w SET domain = :domain, description = :description, year = :year, grape = :grape, region = :region, country = :country, quantity = :quantity, image = :image WHERE id = :id");

    $stmt->bindParam(':domain', $wineValues['domain']);
    $stmt->bindParam(':description', $wineValues['description']);
    $stmt->bindParam(':grape', $wineValues['grape']);
    $stmt->bindParam(':region', $wineValues['region']);
    $stmt->bindParam(':year', $wineValues['year']);
    $stmt->bindParam(':country', $wineValues['country']);
    $stmt->bindParam(':quantity', $wineValues['quantity']);
    $stmt->bindParam(':image', $wineValues['image']);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();

}
