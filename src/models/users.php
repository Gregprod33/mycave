<?php

function getPdoConnect(){
    require('connect.php');
    
    return $pdo;
}

function getUserFromLogin($mail, $password){
    $pdo = getPdoConnect();

    $stmt = $pdo->prepare('SELECT id, name, mail FROM users WHERE mail = :mail AND password = :password');
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':password', $password);
    $res = $stmt->execute();
    if($res){
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}