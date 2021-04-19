<?php

function getPdoConnect(){
    require('connect.php');
    
    return $pdo;
}


function getSearchWines($userSearch) {

        $pdo = getPdoConnect();
        $userSearch = htmlspecialchars($userSearch);
        $stmt = $pdo->prepare("SELECT id, domain, description, image, grape, region, country, year, quantity FROM wines WHERE domain LIKE (concat('%', :domain, '%')) OR year LIKE (concat('%', :year, '%')) OR grape LIKE (concat('%', :grape, '%')) OR quantity LIKE (concat('%', :quantity, '%')) OR country LIKE (concat('%', :country, '%')) OR region LIKE (concat('%', :region, '%')) ORDER BY create_time DESC LIMIT 6");
        $stmt->bindParam(':domain', $userSearch);
        $stmt->bindParam(':year', $userSearch);
        $stmt->bindParam(':grape', $userSearch);
        $stmt->bindParam(':country', $userSearch);
        $stmt->bindParam(':region', $userSearch);
        $stmt->bindParam(':quantity', $userSearch);
        $stmt->execute();
        while($domains = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $anchor_one = 'wine_update.html?id=' . $domains['id'];
            $anchor_two = 'wine_detail_admin.html?id=' . $domains['id'];
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
            echo '<td class="cell-icons"><a href=' . $anchor_one . '><i class="fas fa-edit edit"></i></a><i id="btn" data-id=' . $domains['id'] . 'data-domain=' . $domains['domain'] . 'class="fas fa-trash-alt myBtn"></i></td>';
            echo '<td class="cell-respond-edit"><a href=' . $anchor_two . '><i class="fas fa-arrow-circle-right fa-2x"></i></a></td>';
            echo '</tbody>';
            
               
   }
  
}
 getSearchWines($_GET['txt']);

