<?php


function getPdoConnect(){
    require('connect.php');
    
    return $pdo;
}

if(!isset($_SESSION['user'])) {
    header('Location: ../../index.php');
    exit;
}

function getLimitWines() {
    try {
        $pdo = getPdoConnect(); 
        // on récupère le numéro de la page courante, s'il n'y en a pas ou si = 0 on affecte 1 
        $page = $_GET['page'] ?? 1;

        // pour le référencement, on redirige la page 1 vers l'url natif index .html
        // http response code signifie "de façon prmanente"
        if ($page === '1') {
            http_response_code(301);
            header('Location: ./admin.php');
            exit;
        }
        $currentPage = (int)($_GET['page'] ?? 1);
        if($currentPage <= 0) {
            throw New Exception('Numéro de page invalide');
        }
        // on récuère le nombre d'articles dans la base de données
        $count = (int)$pdo->query("SELECT COUNT(id) FROM wines")->fetch(PDO::FETCH_NUM)[0];
        $countAll = (int)$pdo->query("SELECT SUM(quantity) FROM wines")->fetch(PDO::FETCH_NUM)[0];
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

        return array($posts, $currentPage, $pages, $countAll);

    } catch (\PDOException $th) {
        return false;
    }
}