<?php
session_start();
function getPdoConnect(){
    require('connect.php');
    
    return $pdo;
}


function getSearchWines($userSearch) {

        $pdo = getPdoConnect();
        $userSearch = htmlspecialchars($userSearch);
        $stmt = $pdo->prepare("SELECT id, domain, description, image, grape, region, country, year, quantity FROM wines WHERE domain LIKE (concat('%', :search, '%')) OR year LIKE (concat('%', :year, '%')) OR grape LIKE (concat('%', :search, '%')) OR quantity LIKE (concat('%', :search, '%')) OR country LIKE (concat('%', :search, '%')) OR region LIKE (concat('%', :search, '%')) ORDER BY create_time DESC LIMIT 6");
        $stmt->bindParam(':search', $userSearch);
        $stmt->bindParam(':year', $userSearch);
        $stmt->execute();
        while($domains = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $domain = $domains['domain'];
            $anchor_one = 'wine_update.php?id=' . $domains['id'];
            $anchor_two = 'wine_detail_admin.php?id=' . $domains['id'];
            $image = 'assets/img/src/png/' . $domains['image'];
            echo '<tbody>';
            echo '<td class="cell-img"><img class="stock-img" src=' . $image . '  alt="wine"></td>';
            echo '<td>' . $domains['domain'] . '</td>';
            echo '<td>' . $domains['year'] . '</td>';
            echo '<td>' . $domains['grape'] . '</td>';
            echo '<td class="cell-region">'. $domains['region'] . '</td>';
            echo '<td class="cell-country">'. $domains['country'] . '</td>';
            echo '<td class="cell-description">'. $domains['description'] . '</td>';
            echo '<td class="cell-quantity">'. $domains['quantity'] . '</td>';
            echo '<td class="cell-icons">';
            echo '<div class="flex-icons">';
            echo '<a href=' . $anchor_one . '><i class="fas fa-edit edit"></i></a>';
            echo '<i id="btn" data-id=' . $domains['id'] . ' data-domain="' . $domain . '" class="fas fa-trash-alt myBtn"></i>'; 
            echo '</div>';
            echo '</td>';
            echo '<td class="cell-respond-edit"><a href=' . $anchor_two . '><i class="fas fa-arrow-circle-right fa-2x"></i></a></td>';
            echo '</tbody>';
                    
   }
  
}
 getSearchWines($_GET['txt']);

