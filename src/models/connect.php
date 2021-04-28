<?php

try {

    $pdo = new PDO(
        'mysql:host=localhost;dbname=my_cave;charset=utf8',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );
    
  

} catch (\PDOException $th) {

    echo $th->getMessage();
}
