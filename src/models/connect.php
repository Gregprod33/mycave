<?php

try {

    $pdo = new PDO(
        'mysql:host=localhost;dbname=id16675071_gboescellar;charset=utf8',
        'id16675071_gboes',
        'u^mV&)3u5t&s7o*?',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );
    
  

} catch (\PDOException $th) {

    echo $th->getMessage();
}
