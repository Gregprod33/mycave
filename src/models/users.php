<?php

function getPdoConnect()
{
    require('connect.php');

    return $pdo;
}


function getUserFromLogin($mail, $password)
{
    $pdo = getPdoConnect();

    $stmt = $pdo->prepare('SELECT
        u.id,
        u.password AS password,
        u.name AS name,
        u.mail,
        u.id_role,
        r.weight,
        r.name AS role
    FROM
        users u
    JOIN roles r ON r.id = u.id_role
    WHERE
    mail = :mail AND password = :password');
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':password', $password);
    $res = $stmt->execute();
    if ($res) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}


function getPassword($mail)
{
    $pdo = getPdoConnect();

    $stmt = $pdo->prepare('SELECT password FROM users WHERE mail = :mail');
    $stmt->bindParam(':mail', $mail);
    $res = $stmt->execute();
    if ($res) {
        while ($val = $stmt->fetch()) {
            return $val['password'];
        }
    } else {
        return false;
    }
}



function addUser($userValues)
{
    $pdo = getPdoConnect();
    $stmt = $pdo->prepare('INSERT INTO users (id_role, name, mail, password) VALUES (:role, :name, :mail, :password)');
    $stmt->bindParam(':role', $userValues['id_role']);
    $stmt->bindParam(':name', $userValues['name']);
    $stmt->bindParam(':mail', $userValues['mail']);
    $stmt->bindParam(':password', $userValues['password']);

    return $stmt->execute();
}
