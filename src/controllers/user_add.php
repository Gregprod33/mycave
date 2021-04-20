<?php
require_once('src/models/users.php');

if(!isset($_SESSION['user'])) {
    header('Location: ./index.html');
    exit;
}

if(isset($_POST['addUser'])) {
    if($_POST['radio'] == 'admin') {
        $role = 1;
    } elseif ($_POST['radio'] == 'editor') {
        $role = 2;
    }
    $userValues = [
        'id_role' => $role,
        'name' => strtolower($_POST['name']),
        'mail' => strtolower($_POST['mail']),
        'password' => $_POST['password']
    ];
    $res = addUser($userValues);

    if($res) {
        header('Location: ./admin.html');
        exit;
    }
}