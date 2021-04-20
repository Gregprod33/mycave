<?php

function getPdoConnect(){
    require('connect.php');
    
    return $pdo;
}


function getSearchWines($userSearch) {

        $pdo = getPdoConnect();
        $userSearch = htmlspecialchars($userSearch);
        $stmt = $pdo->prepare("SELECT id, domain, description, image, grape, region, country, year FROM wines WHERE domain LIKE (concat('%', :search, '%')) OR year LIKE (concat('%', :year, '%')) OR grape LIKE (concat('%', :search, '%')) OR country LIKE (concat('%', :search, '%')) OR region LIKE (concat('%', :search, '%')) LIMIT 6");
        $stmt->bindParam(':search', $userSearch);
        $stmt->bindParam(':year', $userSearch);

        $stmt->execute();
        while($domains = $stmt->fetch(PDO::FETCH_ASSOC)) {
           
                $image = 'assets/img/src/png/' . $domains['image'];
                echo '<div class="wine-card">';
                echo '<div class="wine-body">';
                echo '<img class="wine-img" src='. $image . ' alt="wine">';
                echo '<div class="wine-infos">';
                echo'<h2 class="wine-name">' . $domains['domain'] . '</h2>';
                echo '<h3 class="wine-year">' . $domains['year'] . '</h3>';
                echo '<p class="wine-grape">' . $domains['grape'] . '</p>';
                echo '<p class="wine-region">' . $domains['region'] . '</p>';
                echo '<p class="wine-country">' . $domains['country'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '<a href="wine_detail.html?id=' . $domains['id'] . '?>" class="wine-btn">+ d\'infos</a>';
                echo '<div class="more-infos">';
                echo '<p class="wine-description">' . $domains['description'] . '</p>';
                echo '</div>';
                echo '</div>';         
        }
            
}
 getSearchWines($_GET['txt']);

