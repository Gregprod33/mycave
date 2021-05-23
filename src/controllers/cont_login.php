<?php

/**
 * On démarre la session
 */
session_start();

/**
 * Si l'index de session utilisateur est définit alors 
 * il y a déjà une connexion.
 */
if (isset($_SESSION['user'])) {
    header('Location: ./index.php');
    exit;
}


$errors = array(
    1 => 'wrong mail format please enter a valid email',
    2 => 'Wrong password, try again'
);


if (isset($_POST['login'])) {
    require_once('src/models/users.php');

    $password = getPassword($_POST['mail']); // je récupère le password hashé de la bdd qui correspond au mail entré
    $email = $_POST['mail'];

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) //Je verifie le bon format mail
    {
        $_GET['err'] = $errors[1];
        header('Location: ./login.php?err=' . $_GET['err']);
        exit;
    } elseif (empty($_POST['password']) || password_verify($_POST['password'], $password) == false) // Je verifie le password
    {
        $_GET['err'] = $errors[2];
        header('Location: ./login.php?err=' . $_GET['err']);
        exit;
    } else {
        $user = getUserFromLogin(htmlspecialchars($_POST['mail']), $password); // Si tout est bon je me connecte
        $_SESSION['user'] = $user;
        header('Location: ./admin.php');
        exit;
    }
}
