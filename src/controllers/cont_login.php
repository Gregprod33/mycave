<?php
/**
 * On démarre la session
 */
session_start();

/**
 * Si l'index de session utilisateur est définit alors 
 * il y a déjà une connexion.
 */
if(isset($_SESSION['user'])){
    header('Location: ./index.php');
        exit;
}

if(isset($_POST['login'])){
    require_once('src/models/users.php');

    $user = getUserFromLogin(htmlspecialchars($_POST['mail']), htmlspecialchars($_POST['password']));

    if($user == false){
        echo 'Wrong password, try again';
    }else{
        $_SESSION['user'] = $user;
        header('Location: ./admin.php');
        exit;
    }
}